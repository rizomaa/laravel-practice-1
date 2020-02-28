@can ('accept', $model)
    <a title="Mark this answer as a best answer" 
       class="{{ $model->status }} mt-3"
       onClick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();">
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form id="accept-answer-{{ $model->id }}" action="{{ route('answers.accept', $model->id) }}" method="POST" style="display:none">
        @csrf
    </form>
@else
    @if ($model->is_best)
        <a title="This answer is the best answer" class="{{ $model->status }} mt-3">
            <i class="fas fa-check fa-2x"></i>
        </a>
    @endif
@endcan