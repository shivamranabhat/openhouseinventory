<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Vendor Name</label>
            <input type="text" class="form-control" wire:model="name" placeholder="Department Name">
        </div>
        @error('name')
        <div class="feedback text-danger">
            Please provide a valid vendor name.
        </div>
        @enderror
    </div>
   
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Phone Number</label>
            <input type="text" class="form-control" wire:model="phone" placeholder="Phone Number">
        </div>
        @error('phone')
        <div class="feedback text-danger">
            Please provide a valid phone number.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Address</label>
            <input type="text" class="form-control" wire:model="address" placeholder="Enter address">
        </div>
        @error('address')
        <div class="feedback text-danger">
            Please provide an address.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">PAN/ VAT</label>
            <input type="text" class="form-control" wire:model="pan_vat" placeholder="Enter PAN/VAT">
        </div>
        @error('pan_vat')
        <div class="feedback text-danger">
            Please provide pant or vat.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="exampleFormControlInput1">Contact Person</label>
            <input type="text" class="form-control" wire:model="contact_person" placeholder="Enter contact person">
        </div>
        @error('contact_person')
        <div class="feedback text-danger">
            Please provide a contact person.
        </div>
        @enderror
    </div>
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit"><x-spinner />Submit
        </button>
    </div>
</form>