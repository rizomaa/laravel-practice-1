<template>
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
                    
                    <answer v-for="answer in answers" :answer="answer" :key="answer.id"></answer>
                    
                    <div class="text-center mt-3">
                        <button class="btn btn-outline-secondary" 
                                v-if="nextUrl"
                                @click.prevent="fetch(nextUrl)">Load more answers</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Answer from './Answer.vue';
    
    export default {
        //props: ['answers', 'count'],
        props: ['question'],
        
        data() {
            return {
                questionId: this.question.id,
                count: this.question.answers_count,
                answers: [],
                nextUrl: null,
            }  
        },
        
        created() {
            this.fetch(`/questions/${this.questionId}/answers`);
        },
        
        methods: {
            fetch(endpoint) {
                axios.get(endpoint).then(({data}) => {
                    this.answers.push(...data.data);
                    //this.nextUrl = data.next_page_url ? (this.nextUrl = data.next_page_url) : null ;
                    this.nextUrl = data.next_page_url;
                //    console.log(data);
                });
            }
        },
                
        components: {
            Answer,
        },
        
        computed: {
            title() {
                
                return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer');
                //{{ $answerCount . " " . Str::plural('answer', $answerCount) }}
                
            },
            
        },
    }
</script>