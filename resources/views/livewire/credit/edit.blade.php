<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="name">Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Name">
        </div>
        @error('name')
        <div class="feedback text-danger">
           {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" wire:model="phone" placeholder="Phone">
        </div>
        @error('phone')
        <div class="feedback text-danger">
           {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="amount">Amount</label>
            <input type="text" class="form-control" wire:model="amount" placeholder="Amount">
        </div>
        @error('amount')
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