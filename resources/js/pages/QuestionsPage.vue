<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-item-center">
                            <h2>All questions</h2>
                            <div class="ml-auto">
                                <router-link :to="{ name: 'questions.create' }" class="btn btn-outline-secondary">Ask Question</router-link>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div v-if="questions.length">
                            <question-exerpt 
                                             v-for="(question, index) in questions" 
                                             :question="question"
                                             :key="question.id"                                             @deleted="remove(index)"></question-exerpt>
                        </div>
                        <div v-else class="alert alert-warning">
                            Please add your first question
                        </div>
<!--                        questions.links-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import QuestionExerpt from '../components/QuestionExerpt'
    export default {
        components: { QuestionExerpt },
        
        data() {
            return {
                questions: [],
            }
        },
        mounted() {
            this.fetchQuestions();
        },
        methods: {
            fetchQuestions() {
                axios.get('/questions')
                    .then(({ data }) => {
                        this.questions = data.data
                })
            },
            
            remove(index) {
                this.questions.splice(index, 1)
                this.count--
            }
        }
    }
</script>







