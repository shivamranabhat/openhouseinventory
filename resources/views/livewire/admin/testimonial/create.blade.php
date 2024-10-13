<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="row">
        <div class="col-12 col-md-6 form-group mb-4">
            <label for="name">Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Name">
            @error('name')
            <div class="feedback text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group mb-4">
            <label for="role">Role</label>
            <input type="text" class="form-control" wire:model="role" placeholder="Role">
            @error('role')
            <div class="feedback text-danger">
                Please provide a valid role.
            </div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6 mb-4">
            <label for="rating">Rating</label>
            <input type="text" class="form-control" wire:model="rating" placeholder="Rating">
            @error('rating')
            <div class="feedback text-danger">
                Please provide a valid rating.
            </div>
            @enderror
        </div>
        <div class="col-lg-6 form-group mb-4">
            <label for="image">Image</label>
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
                <input type="file" class="d-none" id="fileInput" wire:model='image'
                    @change="showPreview">
    
                <!-- Image preview -->
                <template x-if="imageUrl">
                    <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                        style="max-width: 200px;margin-left:1rem">
                </template>
                @error('image')
                <div class="feedback text-danger">
                    Please provide a valid image
                </div>
                @enderror
            </div>
        </div>

    </div>
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
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
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