<div class="doc-container">

    <div class="row">
        <div class="col-xl-9">

            <div class="invoice-content">

                <div class="invoice-detail-body">

                    <div class="invoice-detail-title">

                        <div class="invoice-logo">
                            <div class="profile-image">

                                <img src="{{asset('storage/'.auth()->user()->company->image)}}" class="rounded-circle"
                                    width="100" alt="logo">
                            </div>
                        </div>

                        <div class="invoice-title">
                            <input type="text" class="form-control" wire:model='receipt_no' placeholder="Receipt N.o.">
                            @error('receipt_no')
                            <div class="feedback text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="invoice-detail-header">
                        <div class=" invoice-address-client">
                            <h4>Bill To:-</h4>
                            <div class="invoice-address-client-fields">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="date">Vendor</label>
                                            <select class="form-select" wire:model='vendor_id'
                                                wire:change='vendor($event.target.value)'>
                                                <option value="">Select a vendor</option>
                                                @forelse($vendors as $vendor)
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                @empty
                                                <option value="">No vendor found</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('vendor_id')
                                        <div class="feedback text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label for="date">Bill Date</label>
                                            <input type="text" class="form-control form-control-sm flatpickr-input"
                                                id="date" wire:model='bill_date' placeholder="Bill Date">
                                            @error('bill_date')
                                            <div class="feedback text-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="invoice-detail-terms">

                        <div class="row justify-content-between">

                            <div class="col-md-3">

                                <div class="form-group mb-4">
                                    <label for="number">Bill Number</label>
                                    <p>#{{$slug}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="invoice-detail-items" x-data="invoiceApp()">
                        <div class="table-responsive">
                            <table class="table item-table">
                                <thead>
                                    <tr>
                                        <th class=""></th>
                                        <th>Description</th>
                                        <th class="">Rate</th>
                                        <th class="">Qty</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    @foreach($rows as $index => $row)
                                    <tr>
                                        <td class="delete-item-row">
                                            <ul class="table-controls">
                                                <li>
                                                    <a wire:click="removeRow({{ $index }})" class="delete-item"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                                        role="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="item_in_id">
                                            {{-- @if($items)
                                            <select class="form-select" wire:model="rows.{{ $index }}.item_in_id"
                                                wire:change="item({{ $index }}, $event.target.value)">
                                                <option value="">Select an item</option>
                                                @forelse($items as $item)
                                                <option value="{{$item->id}}">{{$item->product->name}}</option>
                                                @empty
                                                <option value="">No item found</option>
                                                @endforelse

                                            </select>
                                            @else
                                            <input type="text" class="form-control form-control-sm" placeholder="Item"
                                                x-model="item.item_in_id">
                                            @endif --}}
                                            <select class="form-select" wire:model="rows.{{ $index }}.item_in_id"
                                                wire:change="item({{ $index }}, $event.target.value)">
                                                <option value="">Select an item</option>
                                                @forelse($items as $item)
                                                <option value="{{$item->id}}">{{$item->product->name}} (Quantity:{{$item->stock}} {{$item->product->sku}})</option>
                                                @empty
                                                <option value="">No item found</option>
                                                @endforelse

                                            </select>
                                            @error('rows.'.$index.'.item_in_id')
                                            <div class="feedback text-danger">
                                                {{$message}}
                                            </div>
                                            @enderror

                                        </td>
                                        <td class="rate">
                                            <input type="text" class="form-control form-control-sm" placeholder="0"
                                                wire:model="rows.{{ $index }}.rate">
                                            @error('rate')
                                            <div class="feedback text-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </td>
                                        <td class="text-right qty">
                                            <input type="text" class="form-control form-control-sm" placeholder="1"
                                                wire:model="rows.{{ $index }}.quantity">
                                            @error('quantity')
                                            <div class="feedback text-danger">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </td>
                                        <td class="text-right amount">
                                            <span class="editable-amount">
                                                <span class="currency">Rs.</span>
                                                <span class="amount">{{ $this->calculateTotal($index) }}</span>
                                            </span>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button class="btn btn-dark additem _effect--ripple waves-effect waves-light"
                            wire:click="addRow">Add Item</button>
                        <div class="inv--total-amounts">

                            <div class="row mt-4">
                                <div class="col-sm-5 col-12 order-sm-0 order-1">
                                </div>
                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                    <div class="text-sm-end">
                                        <div class="row">
                                            <div class="col-sm-8 col-7">
                                                <p class="">Sub Total :</p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="">Rs.{{ number_format($this->calculateSubtotal(),0) }}</p>
                                            </div>
                                            {{-- @if($type)
                                            <div class="col-sm-8 col-7">
                                                <p class="">{{$type}} {{$value}}%:</p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="">Rs.{{ number_format($this->calculateGrandTotal(),0) }}</p>
                                            </div>
                                            @endif --}}
                                            @if($type && $value)
                                            <div class="col-sm-8 col-7">
                                                <p class="">{{$type}} ({{$value}}%):</p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="">Rs.{{ number_format(($this->calculateSubtotal() *
                                                    $this->value / 100), 0) }}</p>
                                            </div>
                                            @endif


                                            <div class="col-sm-8 col-7 grand-total-title mt-3">
                                                <h4 class="">Grand Total : </h4>
                                            </div>
                                            <div class="col-sm-4 col-5 grand-total-amount mt-3">
                                                <h4 class="">Rs.{{ number_format($this->calculateGrandTotal(),0) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="invoice-detail-note">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 mt-4">
                                <button wire:click='save'
                                    class="btn btn-primary btn-download _effect--ripple waves-effect waves-light"><x-spinner />Save
                                    
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="invoice-actions">
                <div class="invoice-action-tax mt-0 pt-0">
                    <h5>Charges</h5>
                    <div class="invoice-action-tax-fields">
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="date">Type</label>
                                    <select class="form-select" wire:model='charge_id'
                                        wire:change='charge($event.target.value)'>
                                        <option value="">None</option>
                                        @forelse($charges as $charge)
                                        <option value="{{$charge->id}}">{{$charge->name}}</option>
                                        @empty
                                        <option value="">Not found</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>