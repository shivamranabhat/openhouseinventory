<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="form-group mb-4">
        <label for="title">Title</label>
        <input type="text" class="form-control" wire:model="title" placeholder="Title">
        @error('title')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="type">Type</label>
        <select class="form-select" wire:model='type' wire:change='changeType($event.target.value)'>
            <option value="">Select a type</option>
            <option class="Business Feature">Business Feature</option>
            <option class="Software Feature">Software Feature</option>
        </select>
        @error('type')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    @if($type == 'Business Feature')
    <div class="form-group mb-4">
        <label for="icon">Icon</label>
        <div x-data="fileUpload()">
            <label for="fileInput">
                <svg xmlns="http://www.w3.org/2000/svg" role="button" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-camera">
                    <path
                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                    </path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
            </label>
            <input type="file" class="d-none" id="fileInput" wire:model='icon'
                @change="showPreview">
            <!-- Image preview -->
            <template x-if="imageUrl">
                <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                    style="max-width: 200px;margin-left:1rem">
            </template>
            @error('icon')
            <div class="feedback text-danger">
                Please provide a valid icon
            </div>
            @enderror
        </div>
    </div>
    @endif
    <div class="form-group mb-4">
        <label for="description">Description</label>
        <textarea class="form-control" wire:model="description"></textarea>
        @error('description')
        <div class="feedback text-danger">
            Please provide a description.
        </div>
        @enderror
    </div>
 
    <div class="col-12">
        @if($type == 'Business Feature' && $icon == null)
        <div class="col-12">
            <button class="btn btn-primary _effect--ripple waves-effect waves-light"
                disabled>Submit
            </button>
        </div>
        @else
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
        @endif
    </div>
    <script>
        function fileUpload() {
            return {
                imageUrl: '',
                showPreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.imageUrl = URL.createObjectURL(file);
                    }
                },
            };
        }
    </script>
</form>