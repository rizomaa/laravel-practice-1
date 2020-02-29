<div class="media post">

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
                @include ('shared._author', [
                    'model' => $answer,
                    'label' => 'answered'
                ])
            </div>

        </div>

    </div>
</div>
