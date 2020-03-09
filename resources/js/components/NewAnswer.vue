<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">                
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your answer</h3>
                        <hr>
                    </div>                
                    <form @submit.prevent="create">
                        <div class="form-group">
                            <textarea class="form-control"                                     
                                      rows="7" 
                                      name="body" 
                                      required
                                      v-model="body"></textarea>                        
                        </div>                        
                        <div class="form-group">
                            <button type="submit" 
                                    class="btn btn-lg btn-outline-primary"
                                    :disabled="isInvalid">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
</template>

<script>
    export default {        
        props: ['questionId'],        
        methods: {            
            create () {                
                //action="{{ route('questions.answers.store', $question->id) }}" method="post"
                axios.post(`/questions/${this.questionId}/answers`, {
                    body: this.body
                })
                    .then(({data}) => {
                        this.$toast.success(data.message, 'Success!');
                        this.body = '';
                        this.$emit('created', data.answer);
                })
                    .catch(error => {
                        this.$toast.error(error.response.data.message, 'Error!!!');
                });
            },
        },
        data() {
            return {
                body: ''
            }
        },
        computed: {
            
            isInvalid() {
                return !this.signedIn || this.body.length < 10;
             
            },
            
            classes() {
              //{{ $errors->has('body') ? 'is-invalid' : '' }}    
            },           
                      
        },
    }
    
</script>