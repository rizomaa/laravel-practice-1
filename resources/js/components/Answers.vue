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
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Answer from './Answer.vue';
    
    export default {
        props: ['answers', 'count'],
                
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