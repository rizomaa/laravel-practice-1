<template>
    <div>
        <div class="row mt-4" v-cloak v-if="count > 0">
            <div class="md-col-12">
                <div class="card">                
                    <div class="card-body">
                        <div class="card-title">
                            <h2>
                                {{ title }}
                            </h2>
                            <hr>
                        </div>

                        <answer v-on:deleted="remove(index)" v-for="(answer, index) in answers" :answer="answer" :key="answer.id"></answer>

                        <div class="text-center mt-3">
                            <button class="btn btn-outline-secondary" 
                                    v-if="nextUrl"
                                    @click.prevent="fetch(nextUrl)">Load more answers</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <new-answer @created="add" :question-id="question.id"></new-answer>
    </div>
</template>

<script>
    import Answer from './Answer.vue';
    import NewAnswer from './NewAnswer.vue';
    import highlight from '../mixins/highlight';
    
    export default {
        //props: ['answers', 'count'],
        props: ['question'],
        
        mixins: [highlight],
        
        data() {
            return {
                questionId: this.question.id,
                count: this.question.answers_count,
                answers: [],
                answerIds: [],
                nexgit tUrl: null,
            }  
        },
        
        created() {
            this.fetch(`/questions/${this.questionId}/answers`);
        },
        
        methods: {
            
            add(answer) {
                this.answers.push(answer);
                this.count++;
                this.$nextTick(()=> {
                    this.highlight(`answer-${answer.id}`);      
                });
            },
            
            remove(index) {
                // the first argument (index) is number for removing item and the second argument is a number for removing in splice function
                this.answers.splice(index, 1);
                this.count--;
                
                this.$toast.error(res.data.message, "Success", {timeout: 3000, position: 'bottomLeft'});
            },
            
            fetch(endpoint) {
                
                this.answerIds = [];
                
                axios.get(endpoint)
                    .then(({data}) => {
                    
                    this.answerIds = data.data.map(a => a.id);
                    this.answers.push(...data.data);
                    //this.nextUrl = data.next_page_url ? (this.nextUrl = data.next_page_url) : null ;
                    this.nextUrl = data.next_page_url;
                    //    console.log(data);
                    })
                    .then(()=> {
                        this.answerIds.forEach(id => {
                            this.highlight(`answer-${id}`);
                        });
                    });
            }
        },
                
        components: {
            Answer, NewAnswer
        },
        
        computed: {
            title() {                
                return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer');
                //{{ $answerCount . " " . Str::plural('answer', $answerCount) }}
                
            },
            
        },
    }
</script>