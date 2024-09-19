<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
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
           {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Prefix</label>
            <input type="text" class="form-control" wire:model="prefix" placeholder="Prefix">
        </div>
        @error('prefix')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
  
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>