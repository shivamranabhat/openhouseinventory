<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="form-group mb-4">
        <label for="item_in_id">Product</label>
        <select class="form-select" wire:model="item_in_id" wire:change='product($event.target.value)'>
            <option value="{{$item->item_in_id}}">{{$item->itemIn->product->name}}</option>
        </select>
    </div>
    <div class="form-group mb-4">
        <label for="department_id">Department</label>
        <select class="form-select" wire:model="department_id">
            <option value="{{$item->department_id}}">{{$item->department->name}}</option>
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
            <label for="stock">Quantity</label>
            <input type="text" class="form-control" wire:model="stock" wire:change='checkQuantity'
                placeholder="Quantity">
        </div>
        @error('stock')
        <div class="feedback text-danger">
            Please provide a quantity.
        </div>
        @enderror
        @if (session('stock'))
        <div class="feedback text-danger">
            {{ session('stock') }}
        </div>
        @endif

    </div>

    <div class="col-12">
        @if (session('stock'))
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" disabled>
           Submit
        </button>
        @else
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">
            <x-spinner />Submit
        </button>
        @endif
    </div>
    <x-success />
    <x-error />
</form>