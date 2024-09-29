<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="row mb-4">
        <div class="col-12 col-md-6 form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Name">
            @error('name')
            <div class="feedback text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group">
            <label for="exampleFormControlInput1">Age</label>
            <input type="text" class="form-control" wire:model="age" placeholder="Age">
            @error('age')
            <div class="feedback text-danger">
                Please provide a valid age.
            </div>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 col-md-6 form-group">
            <label for="exampleFormControlInput1">Address</label>
            <input type="text" class="form-control" wire:model="address" placeholder="Address">
            @error('address')
            <div class="feedback text-danger">
                Please provide an address.
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group">
            <label for="department_id">Department</label>
            <select class="form-select" wire:model="department_id">
                <option value="">Select a department</option>
                @forelse($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
                @empty 
                <option value="">No department found</option>
                @endforelse
               
            </select>
            @error('department_id')
            <div class="feedback text-danger">
                Please select a department.
            </div>
            @enderror
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 col-md-6 form-group">
            <label for="join_date">Join Date</label>
            <input type="date" class="form-control" id="date" wire:model="join_date" placeholder="Join date" wire:ignore>
            @error('join_date')
            <div class="feedback text-danger">
                Please provide a join date.
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group">
            <label for="exampleFormControlInput1">Designation</label>
            <input type="text" class="form-control" wire:model="designation" placeholder="Designation">
            @error('designation')
            <div class="feedback text-danger">
                Please provide a designation.
            </div>
            @enderror
        </div>
    </div>

    <div class="row mb-4 align-items-center">
        <div class="col-12 col-md-6 form-group">
            <label for="exampleFormControlInput1">Salary</label>
            <input type="text" class="form-control" wire:model="salary" placeholder="Salary">
            @error('salary')
            <div class="feedback text-danger">
                Please provide a salary.
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group">
            <label for="doc_img">Identity Docs</label>
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
                <input type="file" class="d-none" id="fileInput" wire:model='doc_img'
                    @change="showPreview">

                <!-- Image preview -->
                <template x-if="imageUrl">
                    <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                        style="max-width: 50px;margin-left:1rem">
                </template>
                @error('doc_img')
                <div class="feedback text-danger">
                    Please provide document image (Max:1MB)
                </div>
                @enderror
            </div>
        </div>
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
                resetPreview() {
                    this.imageUrl = '';
                }
            };
        }
    </script>
</form>