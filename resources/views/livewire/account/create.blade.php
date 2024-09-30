<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="row mb-4">
        <div class="col-12 col-md-6 form-group">
            <label for="employee_id">Employee</label>
            <select class="form-select" wire:model="employee_id" wire:change="show($event.target.value)">
                <option value="">Select a employee</option>
                @forelse($employees as $employee)
                <option value="{{$employee->id}}">{{$employee->name}}</option>
                @empty
                <option value="">No employee found</option>
                @endforelse
            </select>
            @error('employee_id')
            <div class="feedback text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" wire:model="email" placeholder="Email">
            @error('email')
            <div class="feedback text-danger">
                Please provide a valid email.
            </div>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12 col-md-6 form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" wire:model="password" placeholder="Password">
            @error('password')
            <div class="feedback text-danger">
                Please provide an password (Min:6 characters).
            </div>
            @enderror
        </div>
        <div class="col-12 col-md-6 form-group">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control" wire:model="password_confirmation"
                placeholder="Confirm Password">
            @error('password_confirmation')
            <div class="feedback text-danger">
                Password confirm doesnot match with password.
            </div>
            @enderror
        </div>

    </div>
    <div class="form-group mb-4">
        <label for="password">Permissions</label>
        <div class="d-flex flex-md-row flex-column gap-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="can_create" wire:model="can_create">
                <label class="form-check-label" for="can_create">Create</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="can_edit" wire:model="can_edit">
                <label class="form-check-label" for="can_edit">Edit</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="can_delete" wire:model="can_delete">
                <label class="form-check-label" for="can_delete">Delete</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="can_approve" wire:model="can_approve">
                <label class="form-check-label" for="can_approve">Approve</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="can_decline" wire:model="can_decline">
                <label class="form-check-label" for="can_decline">Decline</label>
            </div>
        </div>
        {{-- @error('password_confirmation')
        <div class="feedback text-danger">
            Password confirm doesnot match with password.
        </div>
        @enderror --}}
    </div>

    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">
            <x-spinner />Submit
        </button>
    </div>
</form>