<template>
    <a title="Click to mark as favorite question (Click again to undo)" 
       :class="classes"
       @click.prevent = "toggle"
       >
        <i class="fas fa-star fa-2x"></i>
        <span class="favorites-count">{{ count }}</span>
    </a>
</template>

<script>
    export default {
        
        props: ['question'],
        
        data() {
            return {
                isFavorited: this.question.is_favorited,
                count: this.question.favorites_count,
            //    signedIn: window.Auth.signedIn,
                id: this.question.id,
            }
        },
        
        computed: {
            classes () {
                return [
                    'favorite', 'mt-2',
                    !this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : ''),
                ];
                //onClick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
            },
            
            endpoint () {
                return `/questions/${this.id}/favorites`;
            },
            
          signedIn () {
              return  window.Auth.signedIn;
           }
        },
        
        methods: {
            toggle () {
                if (! this.signedIn) {
                    this.$toast.warning(`Please login before (Authentication ${window.Auth.signedIn} )`, "Login issue",  {timeout: 2000, position: 'bottomCenter'});
                    return; //to stop script execution
                } else {
                    this.isFavorited ? this.destroy() : this.create() ;    
                }
            },
            
            destroy() {
                axios.delete(this.endpoint)
                    .then(res => {
                        this.count--;
                        this.isFavorited = false;
                    });
            },
        
            create() {
                axios.post(this.endpoint)
                    .then(res => {
                        this.count++;
                        this.isFavorited = true;
                        this.$toast.success(`Thanks for voting in favour of the question (Authentication ${window.Auth.signedIn} )`, "Success", {timeout: 2000, position: 'topCenter'});
                    });
            }
    
        }
        
    }
    
</script>