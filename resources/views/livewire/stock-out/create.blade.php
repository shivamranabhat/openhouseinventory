<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="form-group mb-4">
        <label for="product_id">Product</label>
        <select class="form-select" wire:model="product_id" wire:change='product($event.target.value)'>
            <option value="">Select a product</option>
            @forelse($stocks as $stock)
            <option value="{{$stock->id}}">{{$stock->name}}</option>
            @empty
            <option value="">No product found</option>
            @endforelse

        </select>
        @error('product_id')
        <div class="feedback text-danger">
            Please select a product.
        </div>
        @enderror
    </div>

    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="stock">Quantity</label>
            <input type="text" class="form-control" wire:model="stock" wire:change='checkQuantity'
                placeholder="Quantity">
        </div>
        @error('quantity')
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