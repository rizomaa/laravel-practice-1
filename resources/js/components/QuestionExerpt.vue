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

                <h3 class="mt-0"><a href="#">{{ question.title }}</a></h3>
                <div class="ml-auto">
                    <router-link :to="{ name: 'questions.edit', params: { id: question.id }}" 
                                 v-if="authorize('modify', question)" 
                                 class="btn btn-secondary btn-sm text-light">
                        Edit
                    </router-link>
                    <form v-if="authorize('deleteQuestion', question)" class="form-delete" action="#" method="post">                        
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
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
    export default {
        props: [
          'question'  
        ],
        methods: {
            str_plural(str, count) {
                return str + (count > 1 ? 'c' : '');
            },            
            exerpt() {
            
            },
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