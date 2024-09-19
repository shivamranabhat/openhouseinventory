<div class="doc-container">

    <div class="row">
        <div class="col-xl-9">

            <div class="invoice-content">

                <div class="invoice-detail-body">

                    <div class="invoice-detail-title">

                        <div class="invoice-logo">
                            <div class="profile-image">

                                <img src="https://catwalkpokhara.com/assets/images/logo.png" class="rounded-circle"
                                    width="100" alt="logo">
                            </div>
                        </div>

                        <div class="invoice-title">
                            <input type="text" class="form-control" placeholder="Receipt N.o.">
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
                                            <select class="form-select" wire:model='vendor_id' wire:change='vendor($event.target.value)'>
                                                <option value="">Select a vendor</option>
                                                @forelse($vendors as $vendor)
                                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                                @empty 
                                                <option value="">No vendor found</option>
                                                @endforelse
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-4">
                                            <label for="date">Invoice Date</label>
                                            <input type="text" class="form-control form-control-sm flatpickr-input"
                                                id="date" placeholder="Bill Date">
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
                                    <p>#0001</p>
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- <div class="invoice-detail-items">

                        <div class="table-responsive">
                            <table class="table item-table">
                                <thead>
                                    <tr>
                                        <th class=""></th>
                                        <th>Description</th>
                                        <th class="">Rate</th>
                                        <th class="">Qty</th>
                                        <th class="text-right">Amount</th>
                                        <th class="text-center">Tax</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="delete-item-row">
                                            <ul class="table-controls">
                                                <li><a href="javascript:void(0);" class="delete-item"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x-circle">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="15" y1="9" x2="9" y2="15"></line>
                                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                                        </svg></a></li>
                                            </ul>
                                        </td>
                                        <td class="description"><input type="text" class="form-control form-control-sm"
                                                placeholder="Item Description"> <textarea class="form-control"
                                                placeholder="Additional Details"></textarea></td>
                                        <td class="rate">
                                            <input type="text" class="form-control form-control-sm" placeholder="Price">
                                        </td>
                                        <td class="text-right qty"><input type="text"
                                                class="form-control form-control-sm" placeholder="Quantity"></td>
                                        <td class="text-right amount"><span class="editable-amount"><span
                                                    class="currency">$</span> <span class="amount">100.00</span></span>
                                        </td>
                                        <td class="text-center tax">
                                            <div class="n-chk">
                                                <div class="form-check form-check-primary form-check-inline me-0 mb-0">
                                                    <input class="form-check-input inbox-chkbox contact-chkbox"
                                                        type="checkbox">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button class="btn btn-dark additem _effect--ripple waves-effect waves-light">Add Item</button>

                    </div> --}}
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
                                        <th class="text-center">Tax</th>
                                    </tr>
                                    <tr aria-hidden="true" class="mt-3 d-block table-row-hidden"></tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr>
                                            <td class="delete-item-row">
                                                <ul class="table-controls">
                                                    <li>
                                                        <a href="javascript:void(0);" @click="removeItem(index)" class="delete-item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                                            </svg>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="description">
                                                <input type="text" class="form-control form-control-sm" placeholder="Item Description" x-model="item.description">
                                                <textarea class="form-control" placeholder="Additional Details" x-model="item.details"></textarea>
                                            </td>
                                            <td class="rate">
                                                <input type="text" class="form-control form-control-sm" placeholder="Price" x-model="item.price">
                                            </td>
                                            <td class="text-right qty">
                                                <input type="text" class="form-control form-control-sm" placeholder="Quantity" x-model="item.qty">
                                            </td>
                                            <td class="text-right amount">
                                                <span class="editable-amount">
                                                    <span class="currency">$</span> 
                                                    <span class="amount" x-text="(item.price * item.qty).toFixed(2)">100.00</span>
                                                </span>
                                            </td>
                                            <td class="text-center tax">
                                                <div class="n-chk">
                                                    <div class="form-check form-check-primary form-check-inline me-0 mb-0">
                                                        <input class="form-check-input inbox-chkbox contact-chkbox" type="checkbox" x-model="item.tax">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    
                        <button class="btn btn-dark additem _effect--ripple waves-effect waves-light" @click="addItem">Add Item</button>
                    </div>
                    
                    <script>
                        function invoiceApp() {
                            return {
                                items: [
                                    { description: '', details: '', price: 0, qty: 1, tax: false }
                                ],
                                addItem() {
                                    this.items.push({ description: '', details: '', price: 0, qty: 1, tax: false });
                                },
                                removeItem(index) {
                                    this.items.splice(index, 1);
                                }
                            }
                        }
                    </script>
                    
                    <div class="invoice-detail-note">

                        <div class="row">

                            <div class="col-md-12 align-self-center">

                                <div class="form-group row invoice-note">
                                    <label for="invoice-detail-notes"
                                        class="col-sm-12 col-form-label col-form-label-sm">Notes:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="invoice-detail-notes"
                                            placeholder="Notes - For example, &quot;Thank you for doing business with us&quot;"
                                            style="height: 88px;"></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>

            </div>

        </div>

        <div class="col-xl-3">

            <div class="invoice-actions">


                <div class="invoice-action-tax mt-0 pt-0">

                    <h5>Tax</h5>

                    <div class="invoice-action-tax-fields">

                        <div class="row">

                            <div class="col-6">

                                <div class="form-group mb-0">
                                    <label>Type</label>

                                    <div class="dropdown selectable-dropdown invoice-tax-select">
                                        <a id="taxTypeDropdown" href="javascript:void(0);" class="dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span
                                                class="selectable-text">None</span> <span class="selectable-arrow"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg></span></a>
                                        <div class="dropdown-menu" aria-labelledby="taxTypeDropdown">
                                            <a class="dropdown-item" data-value="Deducted"
                                                href="javascript:void(0);">Deducted</a>
                                            <a class="dropdown-item" data-value="Per Item"
                                                href="javascript:void(0);">Per Item</a>
                                            <a class="dropdown-item" data-value="On Total" href="javascript:void(0);">On
                                                Total</a>
                                            <a class="dropdown-item" data-value="None"
                                                href="javascript:void(0);">None</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-6">
                                <div class="form-group mb-0 tax-rate-deducted" style="display: none;">
                                    <label for="rate1">Rate (%)</label>
                                    <input type="number" class="form-control input-rate" id="rate1" placeholder="Rate"
                                        value="10">
                                </div>

                                <div class="form-group mb-0 tax-rate-per-item" style="display: none;">
                                    <label for="rate2">Rate (%)</label>
                                    <input type="number" class="form-control input-rate" id="rate2" placeholder="Rate"
                                        value="5">
                                </div>

                                <div class="form-group mb-0 tax-rate-on-total" style="display: none;">
                                    <label for="rate3">Rate (%)</label>
                                    <input type="number" class="form-control input-rate" id="rate3" placeholder="Rate"
                                        value="25">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="invoice-action-discount">

                    <h5>Discount</h5>

                    <div class="invoice-action-discount-fields">

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group mb-0">
                                    <label>Type</label>

                                    <div class="dropdown selectable-dropdown invoice-discount-select">
                                        <a id="discountDropdown" href="javascript:void(0);" class="dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span
                                                class="selectable-text">None</span> <span class="selectable-arrow"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-chevron-down">
                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                </svg></span></a>
                                        <div class="dropdown-menu" aria-labelledby="discountDropdown">
                                            <a class="dropdown-item" data-value="Percent"
                                                href="javascript:void(0);">Percent</a>
                                            <a class="dropdown-item" data-value="Flat Amount"
                                                href="javascript:void(0);">Flat Amount</a>
                                            <a class="dropdown-item" data-value="None"
                                                href="javascript:void(0);">None</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-6">
                                <div class="form-group mb-0 discount-amount" style="display: none;">
                                    <label for="ratet1">Amount</label>
                                    <input type="number" class="form-control input-rate" id="ratet1" placeholder="Rate"
                                        value="25">
                                </div>

                                <div class="form-group mb-0 discount-percent" style="display: none;">
                                    <label for="ratet2">Percent</label>
                                    <input type="number" class="form-control input-rate" id="ratet2" placeholder="Rate"
                                        value="10">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="invoice-actions-btn">

                <div class="invoice-action-btn">

                    <div class="row">
                        <div class="col-xl-12 col-md-4">
                            <a href="javascript:void(0);"
                                class="btn btn-primary btn-send _effect--ripple waves-effect waves-light">Send
                                Invoice</a>
                        </div>
                        <div class="col-xl-12 col-md-4">
                            <a href="./app-invoice-preview.html"
                                class="btn btn-secondary btn-preview _effect--ripple waves-effect waves-light">Preview</a>
                        </div>
                        <div class="col-xl-12 col-md-4">
                            <a href="javascript:void(0);"
                                class="btn btn-success btn-download _effect--ripple waves-effect waves-light">Save</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


</div>