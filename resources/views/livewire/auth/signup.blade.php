<div class="card-body">
    <form class="row" wire:submit.prevent='save'>
        <div class="col-md-12 mb-3">
            <h2>Sign Up</h2>
            <p>Create an account to use our system</p>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <label class="form-label">Name</label>
                <input type="name" class="form-control" wire:model='name' placeholder="Name">
                @error('name')
                <div class="feedback text-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-12 col-md-6 mb-4">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" wire:model='email' placeholder="Email">
                @error('email')
                <div class="feedback text-danger">
                    Please provide an email.
                </div>
                @enderror
            </div>
        </div>
        <div class="form-group mb-4">
            <label for="image">Company Logo</label>
            <div x-data="fileUpload()">
                <label for="fileInput">
                    <svg xmlns="http://www.w3.org/2000/svg" role="button" width="30" height="30" viewBox="0 0 30 30" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-image">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                        <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                </label>
                <input type="file" class="d-none" id="fileInput" wire:model='image' @change="showPreview">
                <!-- Image preview -->
                <template x-if="imageUrl">
                    <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                        style="max-width: 200px;margin-left:1rem">
                </template>
                @error('image')
                <div class="feedback text-danger">
                    Please provide a valid logo
                </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" wire:model='password' placeholder="Password">
                    @error('password')
                    <div class="feedback text-danger">
                        Please provide a valid password.
                    </div>
                    @enderror
                    @error('password_confirmation')
                    <div class="feedback text-danger">
                        Please enter a same password.
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div class="form-group">
                    <label for="password_confirmation">Confirm
                        Password</label>
                    <input type="password" class="form-control mb-3"
                        wire:model="password_confirmation"
                        placeholder="Confirm Password">
                </div>
            </div>
        </div>
       
        
        <div class="col-12">
            <div class="mb-4">
                <button class="btn btn-primary w-100">
                    <x-spinner />SIGN IN
                </button>
            </div>
        </div>


    </form>
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
</div>