<template>
    <div>
        <a v-if="canAccept" title="Mark this answer as a best answer" 
           :class="classes"
           @click.prevent="create">
            <i class="fas fa-check fa-2x we"></i>
        </a>
        <a v-if="accepted" title="This answer is the best answer" 
           :class="classes">
            <i class="fas fa-check fa-2x te"></i>
        </a>
    </div>
</template>

<script>
    
    import EventBus from '../event-bus';
    
    export default {
        props: ['answer'],
        
        data() {
            return {
                isBest: this.answer.is_best,
                id: this.answer.id,
            }
        },
        
        created () {
            EventBus.$on('accepted', id => {
                this.isBest = (id === this.id);
            })
        },  
        
        methods: {
            
            destroy() {
                axios.delete(this.endpoint)
                    .then(res => {
                        
                        
                        this.$toast.warning(res.data.message, 'title', {timeout: 2000, position: 'bottomCenter'});
                }); 
            },
            
            create() {                
                axios.post(this.endpoint)
                    .then(res => {
                        this.$toast.success(res.data.message, 'title', {timeout: 2000, position: 'bottomCenter'});
                });
                this.isBest = true;
                
                EventBus.$emit('accepted', this.id);
            }
        },   
        
        computed: {
            
            classes () {
                return [
                    'mt3',
                    this.isBest ? 'vote-accepted' : '',
                ]
            },
            canAccept() {
                return this.authorize('accept', this.answer);
            },
            
            accepted() {
                return !this.canAccept && this.isBest;
            },
            
            endpoint() {
                return `/answers/${this.id}/accept`;
            },
            
            signedIn () {
                return window.Auth.signedIn;
            }
        }
        
    }
</script>