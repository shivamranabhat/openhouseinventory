<div class="doc-container">
    <div class="row">
        <div class="col-xl-9">
            <form class="invoice-content" wire:submit.prevent='update'>
                <div class="invoice-detail-body">

                    <div class="invoice-detail-title">

                        <div class="invoice-logo">
                            <div class="profile-image">
                                <img src="{{asset('storage/'.auth()->user()->image)}}" class="rounded-circle"
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
                                            @error('vendor_id')
                                            <div class="feedback text-danger">
                                                Please select a vendor.
                                            </div>
                                            @enderror
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
                                           
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control form-control-sm" wire:model='paid'
                                                placeholder="Amount">
                                            @error('paid')
                                            <div class="feedback text-danger">
                                                Please provide an amount.
                                            </div>
                                            @enderror
                                            @if(session()->has('error'))
                                            <div class="feedback text-danger">
                                                {{ session('error') }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @if($type=='Cheque')
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="cheque_no">Cheque N.o.</label>
                                            <input type="text" class="form-control form-control-sm"
                                                wire:model='cheque_no' placeholder="Cheque no">
                                                @error('cheque_no')
                                                <div class="feedback text-danger">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-4">
                                            <label for="date">Withdraw Date</label>
                                            <input type="text" class="form-control form-control-sm flatpickr-input"
                                                id="withdraw" wire:model='withdraw_date' placeholder="Withdraw Date">
                                        </div>
                                        @error('withdraw_date')
                                        <div class="feedback text-danger">
                                            Please provide a withdraw date.
                                        </div>
                                        @enderror
                                    </div>
                                    @endif
                                    <div class="col-md-8 mb-4">
                                        @if($payment->image && $type !=='Cash')
                                        <div class="d-flex align-items-center gap-5">
                                            <a role="button" class="mt-2" wire:click='deleteImage'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="{{ asset('storage/' . $payment->image) }}" target="_blank"
                                                role="button"><img src="{{ asset('storage/' . $payment->image) }}"
                                                    alt="Existing Image" class="mt-3" style="max-width: 150px;">
                                            </a>
                                        </div>
                                        @elseif($type !=='Cash')
                                        <div x-data="fileUpload()" class="d-flex gap-3">

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
                                            <input type="file" class="d-none" id="fileInput" wire:model='newImage'
                                                @change="showPreview">

                                            <!-- Image preview -->
                                            <template x-if="imageUrl">
                                                <img :src="imageUrl" alt="Image Preview" class="image-preview mt-3"
                                                    style="max-width: 150px;">
                                            </template>
                                        </div>
                                        @endif
                                        @error('image')
                                        <div class="feedback text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror

                                    </div>
                                    @if($type=='Cheque' && $newImage == '' && $image == '' || $type=='Online Banking' && $newImage == '' && $image == '')
                                    <div class="col-12">
                                        <button class="btn btn-primary _effect--ripple waves-effect waves-light"
                                            disabled>Submit
                                        </button>
                                    </div>
                                    @else
                                    <div class="col-12">
                                        <button class="btn btn-primary _effect--ripple waves-effect waves-light"
                                            type="submit">
                                            <x-spinner />Submit
                                        </button>
                                    </div>
                                    @endif
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