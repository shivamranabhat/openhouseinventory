<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="col-12">
        <div class="form-group mb-4">
            <label for="date">Vendor</label>
            <select class="form-select" wire:model='vendor_id'>
                <option value="{{$cheque->vendor_id}}">{{$cheque->vendor->name}}</option>
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
            <input type="text" class="form-control flatpickr-input" id="date" wire:model="pay_date"
                placeholder="Payment Date">
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
            <input type="text" class="form-control flatpickr-input" id="withdraw" wire:model="withdraw_date"
                placeholder="Withdraw Date">
        </div>
        @error('withdraw_date')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    @if($cheque->image)
    <div class="d-flex align-items-center gap-5 mb-4">
        <a role="button" class="mt-2" wire:click='deleteImage'>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-trash">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                </path>
            </svg>
        </a>
        <a href="{{ asset('storage/' . $cheque->image) }}" target="_blank" role="button"><img
                src="{{ asset('storage/' . $cheque->image) }}" alt="Existing Image" class="mt-3"
                style="max-width: 150px;">
        </a>
    </div>
    @else
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
            <input type="file" class="d-none" id="fileInput" wire:model='newImage' @change="showPreview">

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
    @endif
    @if($cheque->image == '' && $newImage == '')
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light"
            disabled>Submit
        </button>
    </div>
    @else
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">
            <x-spinner />Submit
        </button>
    </div>
    @endif
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