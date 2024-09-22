<div class="doc-container">
    <div class="row">
        <div class="col-xl-9">
            <form class="invoice-content" wire:submit.prevent='save'>
                <div class="invoice-detail-body">

                    <div class="invoice-detail-title">

                        <div class="invoice-logo">
                            <div class="profile-image">
                                <img src="https://catwalkpokhara.com/assets/images/logo.png" class="rounded-circle"
                                    width="100" alt="logo">
                            </div>
                        </div>

                        <div class="invoice-title">
                            <input type="text" class="form-control" placeholder="Receipt N.o." wire:model='receipt_no'>
                            @error('receipt_no')
                            <div class="feedback text-danger">
                                Please provide a receipt number.
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="invoice-detail-header">
                        <div class=" invoice-address-client">
                            <div class="invoice-address-client-fields">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-6">
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
                                            {{-- @if($vendor_id)
                                            @if($total)
                                            <label>Total Remaining: Rs. {{ number_format($total->total_sum,0)
                                                }}</label>
                                            @else
                                            <label>Paid / Amount not found</label>
                                            @endif
                                            @endif
                                            @error('vendor_id')
                                            <div class="feedback text-danger">
                                                Please select a vendor.
                                            </div>
                                            @enderror --}}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="date">Date</label>
                                            <input type="text" class="form-control form-control-sm flatpickr-input"
                                                id="date" wire:model='payment_date' placeholder="Date">
                                        </div>
                                        @error('payment_date')
                                        <div class="feedback text-danger">
                                            Please provide a payment date.
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="type">Payment Type</label>
                                            <select class="form-select" wire:model='type'
                                                wire:change='payMethod($event.target.value)'>
                                                <option value="">Select a type</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Online Banking">Online Banking</option>
                                            </select>
                                            @error('type')
                                            <div class="feedback text-danger">
                                                Please provide a payment type.
                                            </div>
                                            @enderror
                                            @error('cheque_no')
                                            <div class="feedback text-danger">
                                               {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @if($type=='Cheque')
                                    <div class="col-md-2">
                                        <div class="form-group mb-4">
                                            <label for="cheque_no">Cheque N.o.</label>
                                            <input type="text" class="form-control form-control-sm"
                                                wire:model='cheque_no' placeholder="Cheque no">
                                            
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control form-control-sm" wire:model='paid'
                                                placeholder="Paid Amount">
                                            @error('paid')
                                            <div class="feedback text-danger">
                                                Please provide an amount.
                                            </div>
                                            @enderror
                                            <div class="feedback text-danger">
                                                {{session('error')}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8 mb-4">
                                        <div x-data="fileUpload()">
                                            <label for="fileInput">
                                                <svg xmlns="http://www.w3.org/2000/svg" role="button" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-camera">
                                                    <path
                                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z">
                                                    </path>
                                                    <circle cx="12" cy="13" r="4"></circle>
                                                </svg>
                                            </label>
                                            <input type="file" class="d-none" id="fileInput" wire:model='image'
                                                @change="showPreview">

                                            <!-- Image preview -->
                                            <template x-if="imageUrl">
                                                <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                                                    style="max-width: 100px;">
                                            </template>
                                            @error('image')
                                            <div class="feedback text-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary _effect--ripple waves-effect waves-light"
                                            type="submit">
                                            <x-spinner />Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>

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

</div>