<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Category Name">
        </div>
        @error('name')
        <div class="feedback text-danger">
            Please provide a valid category name.
        </div>
        @enderror
    </div>
    
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>