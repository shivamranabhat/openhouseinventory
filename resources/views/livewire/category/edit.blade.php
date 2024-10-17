<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Category Name">
        </div>
        @error('name')
        <div class="feedback text-danger">
           {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12 form-group">
            <label for="type">Type</label>
            <select class="form-select" wire:model="type">
                <option value="{{$category->type}}" selected>{{$category->type}}</option>
                <option value="{{$category->type == 'Product' ? 'Service' : 'Product'}}">{{$category->type == 'Product' ? 'Service' : 'Product'}}</option>
            </select>
            @error('type')
            <div class="feedback text-danger">
                Please select a category type.
            </div>
            @enderror
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>