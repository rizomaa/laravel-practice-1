<answer :answer="{{ $answer }}" inline-template>
    <div class="media post">

        <vote :model="{{ $answer }}" name="answer"></vote>

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
                                <button @click="destroy" class="btn btn-danger btn-sm">Delete</button>
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

