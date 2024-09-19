<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Product Name">
        </div>
        @error('name')
        <div class="feedback text-danger">
            Please provide a valid name.
        </div>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="category_id">Category</label>
        <select class="form-select" wire:model="category_id">
            <option value="">Select a category</option>
            @forelse($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @empty 
            <option value="">No category found</option>
            @endforelse
           
        </select>
        @error('category_id')
        <div class="feedback text-danger">
            Please select a category.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Sku</label>
            <input type="text" class="form-control" wire:model="sku" placeholder="Sku">
        </div>
        @error('sku')
        <div class="feedback text-danger">
            Please provide a sku.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Quantity</label>
            <input type="text" class="form-control" wire:model="quantity" placeholder="Quantity">
        </div>
    </div>
   
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Description</label>
            <textarea class="form-control" wire:model="description" rows="2"></textarea>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>