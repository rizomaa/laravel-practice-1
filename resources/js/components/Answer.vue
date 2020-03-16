<template>
    <div class="media post">

        <vote :model="answer" name="answer"></vote>

        <div class="media-body">
            <form v-if="editing === true" @submit.prevent="update">
                <div class="form-group">
                    <textarea class="form-control" rows="10" v-model="body" required></textarea>
                </div>
                Edit answer form
                <button class="btn btn-outline-primary" type="submit" :disabled="isInvalid">Edit answer</button>
                <button class="btn btn-outline-secondary" @click="cancel" type="Button">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">                            
                                <a v-if="authorize('modify', answer)" @click.prevent="edit" class="btn btn-secondary btn-sm text-light">Edit</a>                            
                                <button  v-if="authorize('modify', answer)" @click="destroy" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                    <div class="col-4">
                    </div>
                    <div class="col-4">
                        <user-info v-bind:model="answer" label="Answered"></user-info>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</template>

<script>

    import Vote from './Vote.vue';
    import UserInfo from './UserInfo.vue';
    import modification from '../mixins/modification';
    
export default {    
        
    props: ['answer'],
    
    mixins: [modification],
    
    components: {
        Vote, UserInfo
    },
    
    data() {
        return {
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null,
        }
    },
    
    methods: {
        
        setEditCache() {
            this.beforeEditCache = this.body;            
        },
        
        restoreFromCache() {
            this.body = this.beforeEditCache;
        },
        
        payLoad() {       
            return {
                body: this.body
            }
        },
        
        delete() {
            axios.delete(this.endpoint)
            .then(res => {                
                this.$toast.success(res.data.message, "Successful deleting", {timeout: 2000, position: 'bottomLeft'});

                //create custom event
                this.$emit('deleted');
            });     
        }
        
    },
    
    computed: {
        
        isInvalid() {
            return this.body.length < 10;
        },
        
        endpoint() {
            return `/questions/${this.questionId}/answers/${this.id}`;
        }
        
    }   
    
    
}
</script>