<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="col-12">
        <div class="form-group mb-4">
            <label for="date">Vendor</label>
            <select class="form-select" wire:model='vendor_id'>
                <option value="">Select a vendor</option>
                @forelse($vendors as $vendor)
                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                @empty
                <option value="">No vendor found</option>
                @endforelse
            </select>
            @error('vendor_id')
            <div class="feedback text-danger">
                Please select a vendor.
            </div>
            @enderror
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="cheque_no">Cheque N.o.</label>
            <input type="text" class="form-control" wire:model="cheque_no" placeholder="Cheque N.o.">
        </div>
        @error('cheque_no')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="pay_date">Payment Date</label>
            <input type="text" class="form-control flatpickr-input"
            id="date"  wire:model="pay_date" placeholder="Payment Date">
        </div>
        @error('pay_date')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="withdraw_date">Withdraw Date</label>
            <input type="text" class="form-control flatpickr-input" id="withdraw" wire:model="withdraw_date" placeholder="Withdraw Date">
        </div>
        @error('withdraw_date')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="col-md-8 mb-4">
        <div x-data="fileUpload()">
            <label for="fileInput">
                <svg xmlns="http://www.w3.org/2000/svg" role="button" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-camera">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                    </path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
            </label>
            <input type="file" class="d-none" id="fileInput" wire:model='image' @change="showPreview">

            <!-- Image preview -->
            <template x-if="imageUrl">
                <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                    style="max-width: 150px;margin-left:2rem">
            </template>
            @error('image')
            <div class="feedback text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">
            <x-spinner />Submit
        </button>
    </div>
    <script>
        function fileUpload() {
            return {
                imageUrl: '',
                showPreview(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.imageUrl = URL.createObjectURL(file);
                    }
                }
            };
        }
    </script>
</form>