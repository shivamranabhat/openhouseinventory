<form class="widget-content widget-content-area ecommerce-create-section" wire:submit.prevent='save'>
    <div class="row mb-4">
        <div class="col-lg-6 form-group">
            <label for="product_id">Product</label>
            <select class="form-select" wire:model="product_id" wire:change='category($event.target.value)'>
                <option value="">Select a product</option>
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
        <div class="col-lg-6 form-group">
            <label for="vendor_id">Vendor</label>
            <select class="form-select" wire:model="vendor_id">
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
    <div class="row">
        <div class="col-lg-6 form-group mb-4">
            <label for="stock">Stock</label>
            <input type="text" class="form-control" wire:model="stock" wire:change="updatePrice" placeholder="Stock">
            @error('stock')
            <div class="feedback text-danger">
                Please provide a stock.
            </div>
            @enderror
        </div>
        <div class="col-lg-6 form-group mb-4">
            <label for="unit_price">Unit Price</label>
            <input type="text" class="form-control" wire:model="unit_price" wire:change="updatePrice"
                placeholder="Unit Price">
            @error('unit_price')
            <div class="feedback text-danger">
                Please provide a unit price.
            </div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 form-group mb-4">
            <label for="total">Total Amount</label>
            <input type="text" class="form-control" wire:model="total" placeholder="Total amount" readonly>
        </div>
        <div class="col-lg-6 form-group mb-4">
            <label for="barcode">No.of barcode</label>
            <input type="text" class="form-control" wire:model="barcode" placeholder="1"
                wire:change="updateBarcodeValue">
            @error('barcode')
            <div class="feedback text-danger">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="col-lg-6 form-group mb-4">
            <label for="purchase_date">Purchased Date</label>
            <input type="date" class="form-control" id="date" wire:model="purchase_date" placeholder="Purchase Date"
                wire:ignore>
            @error('purchase_date')
            <div class="feedback text-danger">
                Please provide a purchase date.
            </div>
            @enderror
        </div>
        <div class="col-lg-6 form-group mb-4">
            <label for="rack_no">Rack Number</label>
            <input type="text" class="form-control" wire:model="rack_no" placeholder="Rack Number">
            @error('rack_no')
            <div class="feedback text-danger">
                Please provide a rack number.
            </div>
            @enderror
        </div>
    </div>
    @if(count($barcodeList) > 0)
    <div class="mb-4">
        <div class="row mb-2">
            <p class="col-6">Generated Barcodes</p>
            <div class="col-6 d-flex justify-content-end">
                <button type="button" wire:click="updateBarcodeValue"
                    class="btn btn-secondary btn-sm">Regenerate</button>
            </div>
        </div>
        <ul class="list-group">
            @foreach($barcodeList as $index => $barcode)
            <li class="list-group-item barcode d-flex justify-content-between align-items-center"
                id="barcode-{{ $index }}">
                <span class="d-flex flex-column">
                    @php
                    $barcodeImage = AgeekDev\Barcode\Facades\Barcode::imageType('svg')
                    ->foregroundColor('#000000')
                    ->height(30)
                    ->widthFactor(2)
                    ->type(AgeekDev\Barcode\Enums\Type::TYPE_CODE_128)
                    ->generate($barcode);
                    @endphp
                    {!! $barcodeImage !!}

                </span>
                <button type="button" class="badge bg-primary rounded-pill" onclick="printBarcode({{ $index }})">Print</button>
            </li>
            @endforeach
        </ul>

    </div>
    @endif
    <div class="col-12">
        <button class="btn btn-primary _effect--ripple waves-effect waves-light" type="submit">
            <x-spinner />Submit
        </button>
    </div>
    <script>
        function printBarcode(index) {
            var barcodeContent = document.getElementById('barcode-' + index).querySelector('span').innerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Barcode</title>');
            printWindow.document.write('<style>@media print { body { margin: 0; padding: 0; } }</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(barcodeContent);
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.focus();
            printWindow.print(); 
            printWindow.close(); 
        }
    </script>
</form>