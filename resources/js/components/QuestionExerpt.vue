<template>
    <div class="media post">
        <div>
            <div class="d-flex flex-column counters">
                <div class="vote">
                    <strong>{{ question.votes_count }}</strong> {{ str_plural('vote', question.votes_count) }}
                </div>
            </div>
            <div class="d-flex flex-column counters">
                <div :class="statusClasses">
                    <strong>{{ question.answers_count }}</strong> {{ str_plural('answer', question.answers_count) }}
                </div>
            </div>
            <div class="d-flex flex-column counters">
                <div class="view">
                    {{ question.views + " " + str_plural('view', question.views) }}
                </div>
            </div>
        </div>
        <div class="media-body">
            <div class="d-flex align-items-center">

                <h3 class="mt-0">                    
                    <router-link :to="{ name: 'questions.show', params: { slug: question.slug } }">
                        {{question.title}}
                    </router-link>
                </h3>
                <div class="ml-auto">
                    <router-link :to="{ name: 'questions.edit', params: { id: question.id }}" 
                                 v-if="authorize('modify', question)" 
                                 class="btn btn-secondary btn-sm text-light">
                        Edit
                    </router-link>                                    
                    <button type="button" 
                            v-if="authorize('deleteQuestion', question)" 
                            class="btn btn-danger btn-sm" 
                            @click="destroy">
                        Delete
                    </button>
                </div>

            </div>
            <p class="lead">
                Asked by <a href="#">{{ question.user.name }}</a>
            </p>
            <small class="text-muted">{{ question.created_date }}</small>

            <div class="exerpt">{{ question.exerpt }}</div>
        </div>
    </div>
                  
</template>
<script>
    import destroy from '../mixins/destroy'
    
    export default {
        mixins: [destroy],
        
        props: [
          'question'  
        ],
        
        methods: {
            str_plural(str, count) {
                return str + (count > 1 ? 's' : '');
            },
            
            delete() {
                axios.delete("/questions/" + this.question.id)
                    .then(( {data}) => {
                            this.$toast.success(data.message, "Success", { timeout: 2000});
                            this.$emit('deleted');
                        })
                    .catch();
            }
        },
        computed: {
            statusClasses() {
                return [
                    'status',
                    this.question.status                    
                ]    
            }
        }
    }
</script>