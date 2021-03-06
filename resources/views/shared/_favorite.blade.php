<a title="Click to mark as favorite question (Click again to undo)" 
   class="favorite mt-3 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }}"
   onClick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
   >
    <i class="fas fa-star fa-2x"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
</a>

<form id="favorite-question-{{ $model->id }}" action="/questions/{{ $model->id }}/favorites" method="POST" style="display:none">
    @csrf
    @if ($model->is_favorited) 
        {{ method_field('DELETE') }}                                
    @endif
</form>