<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="row mb-4">
        <div class="col-lg-6 form-group">
            <label for="name">Department Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Department Name">
            @error('name')
            <div class="feedback text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-lg-6 form-group">
            <label for="head">Head of Department</label>
            <input type="text" class="form-control" wire:model="head" placeholder="Head Name">
            @error('head')
            <div class="feedback text-danger">
                Please provide a valid head of department.
            </div>
            @enderror
        </div>

    </div>

    <div class="row mb-4">
        <div class="col-lg-5 form-group">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control" wire:model="phone" placeholder="Phone Number">
            @error('phone')
            <div class="feedback text-danger">
                Please provide a valid phone number.
            </div>
            @enderror
        </div>
        <div class="col-lg-5 form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" wire:model="email" placeholder="Enter Email">
            @error('email')
            <div class="feedback text-danger">
                Please provide a valid email address.
            </div>
            @enderror
        </div>
        <div class="col-lg-2 form-group">
            <label for="employee">Total Employee</label>
            <input type="number" class="form-control" wire:model="employee" placeholder="Total employee">
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>