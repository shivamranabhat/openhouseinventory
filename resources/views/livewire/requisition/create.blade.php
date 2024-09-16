<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="form-group mb-4">
        <label for="item_in_id">Product</label>
        <select class="form-select" wire:model="item_in_id">
            <option value="">Select a product</option>
            @forelse($stocks as $stock)
            <option value="{{$stock->id}}">{{$stock->product->name}}</option>
            @empty 
            <option value="">No product found</option>
            @endforelse
           
        </select>
        @error('item_in_id')
        <div class="feedback text-danger">
            Please select a product.
        </div>
        @enderror
    </div>
   
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="quantity">Quantity</label>
            <input type="text" class="form-control" wire:model="quantity" placeholder="Quantity">
        </div>
        @error('quantity')
        <div class="feedback text-danger">
            Please provide a quantity.
        </div>
        @enderror
    </div>
   
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>