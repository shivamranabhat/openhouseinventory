<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="form-group mb-4">
        <label for="Position">Position</label>
        <select class="form-select" wire:model='position' wire:change='showPosition($event.target.value)'>
            <option value="">Select a position</option>
            <option class="Hero Section">Hero Section</option>
            <option class="Business Feature">Business Feature</option>
            <option class="Software Feature">Software Feature</option>
            <option class="Testimonial">Testimonial</option>
            <option class="FAQs">FAQs</option>
            <option class="Blog">Blog</option>
            <option class="Contact">Contact</option>
            <option class="Footer">Footer</option>
        </select>
        @error('position')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="title">Title</label>
        <input type="text" class="form-control" wire:model="title" placeholder="Title">
        @error('title')
        <div class="feedback text-danger">
            Please provide a title.
        </div>
        @enderror
    </div>
    @if($position != 'Footer')
    <div class="form-group mb-4">
        <label for="subtitle">Subtitle</label>
        <input type="text" class="form-control" wire:model="subtitle" placeholder="Subtitle">
        @error('subtitle')
        <div class="feedback text-danger">
            Please provide a subtitle.
        </div>
        @enderror
    </div>
    @endif
    @if($position == 'Hero Section' || $position == 'Software Feature' || $position == 'Contact')
    <div class="form-group mb-4">
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
    @endif

    <div class="col-12">
        @if($image == null && $position == 'Hero Section' || $image == null && $position == 'Software Feature' || $image == null &&  $position == 'Contact')
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