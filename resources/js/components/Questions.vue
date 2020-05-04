<template>
<div>
    <div class="card-body">
        <spinner v-if="$root.loading"></spinner>
        <div v-else-if="questions.length">
            <question-exerpt 
                             v-for="(question, index) in questions" 
                             :question="question"
                             :key="question.id"                                             @deleted="remove(index)"></question-exerpt>
        </div>
        <div v-else class="alert alert-warning">
            Please add your first question
        </div>        
    </div>
    <div class="card-footer">
        <pagination :meta="meta" :links="links"></pagination>
    </div>    
</div>
</template>
<script>
import QuestionExerpt from './QuestionExerpt.vue'
import Pagination from './Pagination.vue'
    
export default {
    components: { QuestionExerpt, Pagination },

    data() {
        return {
            questions: [],
            meta: {},
            links: {}
        }
    },
    mounted() {
        this.fetchQuestions();
    },
    methods: {
        fetchQuestions() {
            axios.get('/questions', { params: this.$route.query })
                .then(({ data }) => {
                    this.questions = data.data;
                    this.links = data.links;
                    this.meta = data.meta;
            })
        },

        remove(index) {
            this.questions.splice(index, 1)
            this.count--
        }
    },
    
    watch: {
        "$route": 'fetchQuestions'
    },
    
}
</script>