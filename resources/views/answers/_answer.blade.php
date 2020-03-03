<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">

        @include ('shared._vote', [
            'model' => $answer
        ])

        <div class="media-body">
            <form v-if="editing === true" @submit.prevent="update">
                <div class="form-group">
                    <textarea class="form-control" rows="10" v-model="body" required></textarea>
                </div>
                Edit answer form
                <button class="btn btn-outline-primary" type="submit" :disabled="isInvalid">Edit answer</button>
                <button class="btn btn-outline-secondary" @click="cancel" type="Button">Cancel</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="row">
                    <div class="col-4">
                        <div class="ml-auto">
                             @can ('update', $answer)
                                <a @click.prevent="edit" class="btn btn-secondary btn-sm text-light">
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
                        <user-info v-bind:model="{{ $answer }}" label="Answered"></user-info>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</answer>

