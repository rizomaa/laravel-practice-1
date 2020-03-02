@if ($answerCount > 0)
<div class="row mt-4">
    <div class="md-col-12">
        <div class="card">                
            <div class="card-body">
                <div class="card-title">
                    <h2>
                        {{ $answerCount . " " . Str::plural('answer', $answerCount) }}
                    </h2>
                    <hr>
                </div>                
                @include ('layouts._messages')
                
                @foreach ($answers as $answer)
<<<<<<< HEAD:resources/views/answers/_answer.blade.php
                    <div class="media">

                        @include ('shared._vote', [
                            'model' => $answer
                        ])
                        
                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    
                                    <div class="ml-auto">
                                         @can ('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$answer->id, $answer->id])}}" class="btn btn-secondary btn-sm text-light">
                                                Edit
                                            </a>
                                        @endcan
                                        @can ('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$answer->id, $answer->id]) }}" method="post">
                                                @csrf   
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>                                        
                                        @endcan
                                    </div>
                                    
                                </div>
                                <div class="col-4">
                                    
                                </div>
                                
                                <div class="col-4">
                                    <user-info :model="{{ $answer }}" label="answered"></user-info>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    <hr>
=======
                    @include('answers._answer')
>>>>>>> lesson27:resources/views/answers/_index.blade.php
                @endforeach                
            </div>
        </div>
    </div>
</div>
@endif