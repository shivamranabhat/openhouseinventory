<div class="account-settings-container layout-top-spacing">

    <div class="account-content">
        <div class="row mb-3">
            <div class="col-md-12">
                <ul class="nav nav-pills" id="animateLine" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab"
                            href="#animated-underline-home" role="tab" aria-controls="animated-underline-home"
                            aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg> Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="animated-underline-profile-tab" data-bs-toggle="tab"
                            href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile"
                            aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg> Department Details</button>
                    </li>

                </ul>
            </div>
        </div>

        <div class="tab-content" id="animateLineContent-4">
            <div class="tab-pane fade active show" id="animated-underline-home" role="tabpanel"
                aria-labelledby="animated-underline-home-tab">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                        <form class="section general-info" wire:submit.prevent='save'>
                            <div class="info">
                                <h6 class="">General Information</h6>
                                <div class="row">
                                    <div class="col-lg-11 mx-auto">
                                        <div class="row">
                                            <div class="col-xl-2 col-lg-12 col-md-4">
                                                <div class="profile-image  mt-4 pe-md-4">
                                                    <div class="img-uploader-content ">
                                                        @if($user->image)
                                                        <div class="d-flex align-items-center gap-3">
                                                            <a role="button" class="mt-2" wire:click='deleteImage'>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-trash">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                </svg>
                                                            </a>
                                                            <a href="{{ asset('storage/' . $user->image) }}"
                                                                target="_blank" class="border px-3 py-4"
                                                                role="button"><img
                                                                    src="{{ asset('storage/' . $user->image) }}"
                                                                    alt="Existing Image" class="mt-3"
                                                                    style="max-width: 100px;">
                                                            </a>
                                                        </div>
                                                        @else
                                                        <div x-data="fileUpload()">
                                                            <label for="fileInput">
                                                                <svg xmlns="http://www.w3.org/2000/svg" role="button"
                                                                    width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-camera">
                                                                    <path
                                                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                                                    </path>
                                                                    <circle cx="12" cy="13" r="4"></circle>
                                                                </svg>
                                                            </label>
                                                            <input type="file" class="d-none" id="fileInput"
                                                                wire:model='image' @change="showPreview">

                                                            <!-- Image preview -->
                                                            <template x-if="imageUrl">
                                                                <img :src="imageUrl" alt="Image Preview"
                                                                    class="image-preview mt-3"
                                                                    style="max-width: 100px;margin-left:1rem">
                                                            </template>
                                                            @error('doc_img')
                                                            <div class="feedback text-danger">
                                                                {{$message}}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                <div class="form">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fullName">Full Name</label>
                                                                <input type="text" class="form-control mb-3"
                                                                    wire:model='name' placeholder="Full Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input type="text" class="form-control mb-3"
                                                                    wire:model="email" placeholder="Email">
                                                            </div>
                                                        </div>

                                                        @if($user->role != 'Company')
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="address">Address</label>
                                                                <input type="text" class="form-control mb-3"
                                                                    wire:model="address" placeholder="Address">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="age">Age</label>
                                                                <input type="text" class="form-control mb-3"
                                                                    wire:model="age" placeholder="Age">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="password">Password</label>
                                                                <input type="password" class="form-control mb-3"
                                                                    wire:model="password" placeholder="Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="password_confirmation">Confirm
                                                                    Password</label>
                                                                <input type="password" class="form-control mb-3"
                                                                    wire:model="password_confirmation"
                                                                    placeholder="Password">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 mt-1">
                                                            <div class="form-group text-end">
                                                                <button
                                                                    class="btn btn-secondary _effect--ripple waves-effect waves-light">
                                                                    <x-spinner />Save
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel"
                aria-labelledby="animated-underline-profile-tab">
                <div class="section general-info">
                    <div class="info row">
                        <h6 class="">Department Information</h6>

                        @if($user->role != 'Company')

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control mb-3"
                                    value="{{$user->employee->department->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="head">Head</label>
                                <input type="text" class="form-control mb-3"
                                    value="{{$user->employee->department->head}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="employee">Number of Employees</label>
                                <input type="text" class="form-control mb-3"
                                    value="{{$user->employee->department->employee}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Contact Number</label>
                                <input type="text" class="form-control mb-3"
                                    value="{{$user->employee->department->phone}}" disabled>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>

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
                resetPreview() {
                    this.imageUrl = '';
                }
            };
        }
    </script>
    <x-success />
    <x-error />
</div>