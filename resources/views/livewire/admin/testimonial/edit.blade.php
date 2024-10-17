<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
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
            @if($testimonial->image)
            <div class="d-flex align-items-center gap-5">
                <a role="button" class="mt-2" wire:click='deleteImage'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-trash">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path
                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                        </path>
                    </svg>
                </a>
                <a href="{{ asset('storage/' . $testimonial->image) }}" target="_blank"
                    role="button"><img src="{{ asset('storage/' . $testimonial->image) }}"
                        alt="Existing Image" class="mt-3" style="max-width: 200px;">
                </a>
            </div>
            @else
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
                <input type="file" class="d-none" id="fileInput" wire:model='new_image'
                    @change="showPreview">

                <!-- Image preview -->
                <template x-if="imageUrl">
                    <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                        style="max-width: 200px;margin-left:1rem">
                </template>
                @error('new_image')
                <div class="feedback text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            @endif
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
        @if($testimonial->image == null && $new_image == null)
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