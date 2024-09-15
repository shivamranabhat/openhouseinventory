<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Name">
        </div>
        @error('name')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="new_doc_img">Identity Docs</label>
        <input type="file" class="form-control-file" wire:model="doc_img">
        @error('new_doc_img')
        <div class="feedback text-danger">
            Please provide a identity image (Max:10MB).
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Age</label>
            <input type="text" class="form-control" wire:model="age" placeholder="Age">
        </div>
        @error('age')
        <div class="feedback text-danger">
            Please provide an age.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Address</label>
            <input type="text" class="form-control" wire:model="address" placeholder="Address">
        </div>
        @error('address')
        <div class="feedback text-danger">
            Please provide an address.
        </div>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="department_id">Department</label>
        <select class="form-select" wire:model="department_id">
            <option value="{{$employee->department_id}}">{{$employee->department->name}}</option>
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
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="join_date">Join Date</label>
            <input type="date" class="form-control" id="date" wire:model="join_date" placeholder="Join date" wire:ignore>
        </div>
        @error('join_date')
        <div class="feedback text-danger">
            Please provide a join date.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Designation</label>
            <input type="text" class="form-control" wire:model="designation" placeholder="Designation">
        </div>
        @error('designation')
        <div class="feedback text-danger">
            Please provide a designation.
        </div>
        @enderror
    </div>
   
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Salary</label>
            <input type="text" class="form-control" wire:model="salary" placeholder="Salary">
        </div>
        @error('salary')
        <div class="feedback text-danger">
            Please provide a salary.
        </div>
        @enderror
    </div>
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>