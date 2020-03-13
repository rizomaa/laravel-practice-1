<template>
    <div class="d-flex flex-column vote-controls">
        <a :title="title('up')" 
           class="vote-up"
           :class="classes"
           @click.prevent="voteUp">
           <i class="fas fa-caret-up fa-3x"></i>
           <span class="votes-count">{{ count }}</span>
        </a>
        
        <a  :title="title('down')" 
            class="vote-down"
            :class="classes"
            @click.prevent="voteDown">
            <i class="fas fa-caret-down fa-3x"></i>
        </a>
        
        <favorite v-if="name === 'question'" :question="model"></favorite>
        <accept v-if="name === 'answer'" :answer="model"></accept>

    </div>
</template>
<script>
    
      //<form id="up-vote-{{ $formId }}" action="{{ $formAction }}" method="POST" style="display:none">
        //    @csrf
        //    <input type="hidden" name="vote" value="1">
        //</form>    
    //onClick="event.preventDefault(); document.getElem entById('up-vote-{{ $formId }}').submit();"
    //onClick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit();"
    
    import Favorite from './Favorite.vue';
    import Accept from './Accept.vue';
    
    
    export default {
        props: ['name', 'model'],
        
        computed: {
            classes () {
                return this.signedIn ? '' : 'off';
            },
            
            endpoint() {
                return `/${this.name}s/${this.id}/vote`;
            },
        },
        
        components: {
            //first Favorite is a name (!) of component, Vuejs will trabsform in from camel case ot kebab case
            //name (!) we use as <favorite>, if we call NameComponent, we use <name-component>
         //   Favorite: Favorite,
        //    Accept: Accept,
            //Simplify
            Favorite,
            Accept
        },
        
        data() {
            return {
                count: this.model.votes_count || 0,
                id: this.model.id,
            }
        },
        
        
        methods: {
            title (voteType) {
            /*    let titles = {
                    up: `This ${this.name} is useful +1`,
                    down: `This ${this.name} is useless -1`,
                };
                return titles[voteType];                */
                return (voteType === 'up') ? `This ${this.name} is useful +1` : `This ${this.name} is useless -1`;
            },
            
            voteUp() {
                this._vote(1);
            },

            voteDown() {
                this._vote(-1);            
            },
            
            _vote(vote) {
                
                if (!this.signedIn) {
                    this.$toast.warning(`Please log in to ${this.name}`, "Warning", {
                        timeout: 3000,
                        position: 'bottomLeft'
                    });
                    return;
                }
                
                axios.post(this.endpoint, { vote })
                .then(res => {
                    this.$toast.success(res.data.message, "Voted!", {
                        timeout: 2000, 
                        position: 'topCenter'
                    });
                    this.count = res.data.votesCount;
                });
            }
            
        }
        
        
    }
</script>