<template>
    <div class="container" v-if="question.id">
        <question :question="question"></question>    
        <answers :question="question"></answers>
    </div>
</template>

<script>    
    import Question from '../components/Question.vue';
    import Answers from '../components/Answers.vue';
    export default {        
        components: { Question, Answers },
        
        props: ['slug'],
        
        data() {
            return {
                question: {
                    title: '',
                    body: '',
                    id: ''
                }
            }
        },
        
        mounted() {
            this.fetchQuestion();
        },
        
        methods: {
            fetchQuestion() {
                
           //     console.log(this.slug)
                axios.get(`/question/${this.slug}`)
                    .then(({ data }) => {
                    this.question = data.data
                })
                    .catch(error => console.log(error));
            }
        }
    }
</script>