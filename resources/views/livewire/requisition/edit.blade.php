<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="form-group mb-4">
        <label for="product_id">Product</label>
        <select class="form-select" wire:model="product_id">
            <option value="">Select a product</option>
            @forelse($categories as $product)
            <option value="{{$product->id}}">{{$product->name}}</option>
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
            <label for="exampleFormControlInput1">Quantity</label>
            <input type="text" class="form-control" wire:model="quantity" placeholder="Quantity">
        </div>
    </div>
   
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>