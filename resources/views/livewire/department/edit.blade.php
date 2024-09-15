<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Department Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Department Name">
        </div>
        @error('name')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Head of Department</label>
            <input type="text" class="form-control" wire:model="head" placeholder="Head Name">
        </div>
        @error('head')
        <div class="feedback text-danger">
            Please provide a valid head of department.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Phone Number</label>
            <input type="text" class="form-control" wire:model="phone" placeholder="Phone Number">
        </div>
        @error('phone')
        <div class="feedback text-danger">
            Please provide a valid phone number.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Email</label>
            <input type="text" class="form-control" wire:model="email" placeholder="Enter Email">
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Total Employee</label>
            <input type="number" class="form-control" wire:model="employee" placeholder="Enter total employee">
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>