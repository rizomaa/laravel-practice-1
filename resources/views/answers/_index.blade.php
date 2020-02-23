
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
                    <div class="media">

                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful." class="vote-up off">
                               <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="votes-count">1236</span>
                            <a title="This answer is useless." class="vote-down">
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            
                            @can ('accept', $answer)
                                <a title="Mark this answer as a best answer" 
                                   class="{{ $answer->status }} mt-3"
                                   onClick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                <form id="accept-answer-{{ $answer->id }}" action="{{ route('answers.accept', $answer->id) }}" method="POST" style="display:none">
                                    @csrf
                                </form>
                            @else
                                @if ($answer->is_best)
                                    <a title="This answer is the best answer" class="{{ $answer->status }} mt-3">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                            
                        </div>



                        <div class="media-body">
                            {!! $answer->body_html !!}
                            <div class="row">
                                <div class="col-4">
                                    
                                    <div class="ml-auto">
                                         @can ('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id])}}" class="btn btn-secondary btn-sm text-light">
                                                Edit
                                            </a>
                                        @endcan
                                        @can ('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post">
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
                                    <span class="text-muted">
                                        Answered {{ $answer->created_date }} 
                                    </span>
                                    <div class="media mt-2">
                                        <a href="{{ $answer->user->url}} " class="pr-2">
                                            <img src="{{ $answer->user->avatar }}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>