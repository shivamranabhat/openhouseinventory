<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="form-group mb-4">
        <label for="title">Title</label>
        <input type="text" class="form-control" wire:model="title" placeholder="Title">
        @error('title')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="description">Description</label>
        <textarea class="form-control" wire:model="description"></textarea>
        @error('description')
        <div class="feedback text-danger">
            Please provide a description.
        </div>
        @enderror
    </div>
 
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
  
</form>