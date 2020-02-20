
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">                
            <div class="card-body">
                @include ('layouts._messages')
                <div class="card-title">
                    <h3>
                        Your answer
                    </h3>
                    <hr>
                </div>                
                <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="7" name="body"></textarea>                        
                    </div>
                    @if ($errors->has('body')) 
                        <div class="invalid-feedback">
                            <strong>
                                {{ $errors->first('body') }}
                            </strong>
                        </div>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>