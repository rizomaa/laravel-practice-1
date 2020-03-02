<div class="media post">
    <div>
        <div class="d-flex flex-column counters">
            <div class="vote">
                <strong>{{ $question->votes_count }}</strong> {{ Str::plural('vote', $question->votes_count) }}
            </div>
        </div>
        <div class="d-flex flex-column counters">
            <div class="status {{ $question->status }}">
                <strong>{{ $question->answers_count }}</strong> {{ Str::plural('answer', $question->answers_count) }}
            </div>
        </div>
        <div class="d-flex flex-column counters">
            <div class="view">
                {{ $question->views . " " . Str::plural('view', $question->views) }}
            </div>
        </div>
    </div>
    <div class="media-body">
        <div class="d-flex align-items-center">

            <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>           <div class="ml-auto">
    {{--    @if (Auth::user()->can('update-question', $question))   --}}

                @can ('update', $question)
                    <a href="{{ route('questions.edit', $question->id)}}" class="btn btn-secondary btn-sm text-light">
                        Edit
                    </a>
                @endcan

            {{--    @if (Auth::user()->can('delete-question', $question)) --}}
                @can ('delete', $question)
                    <form class="form-delete" action="{{ route('questions.destroy', $question->id) }}" method="post">
                        @csrf   
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>                                        
                @endcan
            </div>

        </div>
        <p class="lead">
            Asked by <a href="/{{ $question->user->url }}">{{ $question->user->name }}</a>
        </p>
        <small class="text-muted">{{ $question->created_date }}</small>

        <div class="exerpt">{{ $question->exerpt(300) }}</div>
    </div>
</div>
                  