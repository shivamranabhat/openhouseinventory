<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='update'>
    <div class="form-group mb-4">
        <label for="product_id">Product</label>
        <select class="form-select" wire:model="product_id">
            <option value="{{$item_in->product_id}}">{{$item_in->product->name}}</option>
            @forelse($products as $product)
            <option value="{{$product->id}}">{{$product->name}}</option>
            @empty
            <option value="">No product found</option>
            @endforelse

        </select>
        @error('product_id')
        <div class="feedback text-danger">
            Please select a product.
        </div>
        @enderror
    </div>
    <div class="form-group mb-4">
        <label for="vendor_id">Vendor</label>
        <select class="form-select" wire:model="vendor_id">
            <option value="{{$item_in->vendor_id}}">{{$item_in->vendor->name}}</option>
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
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" wire:model="stock" wire:change="updatePrice" placeholder="Stock">
        </div>
        @error('stock')
        <div class="feedback text-danger">
            Please provide a stock.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="unit_price">Unit Price</label>
            <input type="text" class="form-control" wire:model="unit_price" wire:change="updatePrice"
                placeholder="Unit Price">
        </div>
        @error('unit_price')
        <div class="feedback text-danger">
            Please provide a unit price.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="total">Total Amount</label>
            <input type="text" class="form-control" wire:model="total" placeholder="Total amount" readonly>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="prefix">Barcode Prefix</label>
            <input type="text" class="form-control" wire:model="prefix" placeholder="Prefix"
                wire:change="updateBarcodeValue">
        </div>
        @error('prefix')
        <div class="feedback text-danger">
            Please provide a barcode prefix.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="barcode">No.of barcode</label>
            <input type="text" class="form-control" wire:model="barcode" placeholder="1"
                wire:change="updateBarcodeValue">
        </div>
        @error('barcode')
        <div class="feedback text-danger">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="mb-4">
         @if(!empty($existingBarcodes) && empty($barcodeList))
        <div class="row mb-2">
            <p class="col-6">Existing Barcodes</p>
            <div class="col-6 d-flex justify-content-end">
                <button type="button" wire:click="updateBarcodeValue"
                    class="btn btn-secondary btn-sm">Regenerate</button>
            </div>
        </div>
        <ul class="list-group">
            @foreach($existingBarcodes as $existingBarcode)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="d-flex flex-column">
                    @php
                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    $barcodeHtml = $generator->getBarcode($existingBarcode, $generator::TYPE_CODE_128);
                    @endphp
                    {!! $barcodeHtml !!}
                    <span>{{ $existingBarcode }}</span> <!-- Display the barcode number -->
                </span>
                <button type="button" class="badge bg-primary rounded-pill">Print</button>
            </li>
            @endforeach
        </ul>
        @endif
        @if(!empty($barcodeList))
        <div class="row mb-2">
            <p class="col-6">New Barcodes</p>
            <div class="col-6 d-flex justify-content-end">
                <button type="button" wire:click="regenerateBarcode"
                    class="btn btn-secondary btn-sm">Regenerate</button>
            </div>
        </div>
        <ul class="list-group">
            @foreach($barcodeList as $barcode)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="d-flex flex-column">
                    @php
                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    $barcodeHtml = $generator->getBarcode($barcode, $generator::TYPE_CODE_128);
                    @endphp
                    {!! $barcodeHtml !!}
                    <span>{{ $barcode }}</span> <!-- Display the barcode number -->
                </span>
                <button type="button" class="badge bg-primary rounded-pill"
                    onclick="printBarcode('{{ $barcode }}')">Print</button>
            </li>
            @endforeach
        </ul>
        @endif
    </div>


    <div class="mb-4">
        <div class="col-sm-12">
            <label for="purchase_date">Purchased Date</label>
            <input type="date" class="form-control" id="date" wire:model="purchase_date" placeholder="Purchase Date"
                wire:ignore>
        </div>
        @error('purchase_date')
        <div class="feedback text-danger">
            Please provide a purchase date.
        </div>
        @enderror
    </div>
    <div class="row mb-4">
        <div class="col-sm-12">
            <label for="rack_no">Rack Number</label>
            <input type="text" class="form-control" wire:model="rack_no" placeholder="Rack Number">
        </div>
        @error('rack_no')
        <div class="feedback text-danger">
            Please provide a rack number.
        </div>
        @enderror
    </div>
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">
            <x-spinner />Submit
        </button>
    </div>
</form>