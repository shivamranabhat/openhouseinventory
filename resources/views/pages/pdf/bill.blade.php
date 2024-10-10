<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Transaction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .main-content {
            padding: 20px;
        }

        .doc-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .invoice-container {
            margin-top: 20px;
        }

        .inv--head-section {
            margin-bottom: 20px;
        }

        .in-heading {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: #007bff;
            border-bottom: 2px solid #007bff;
        }

        .inv-customer-name {
            font-weight: bold;
            font-size: 18px;
        }

        .inv-street-addr,
        .inv-email-address {
            margin: 5px 0;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .text-end {
            text-align: right;
        }

        .inv--total-amounts {
            margin-top: 20px;
            padding-top: 10px;
        }

        .inv--note {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>

<body class="layout-boxed">
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="doc-container">

                <div class="row">
                    <div class="col-12">
                        <div class="invoice-container">
                            <div class="invoice-inbox">
    
                                <div id="ct" class="">
    
                                    <div class="invoice-00001">
                                        <div class="content-section">
    
                                            <div class="inv--head-section inv--detail-section">
    
                                                <div class="row">
    
                                                    <div class="col-sm-6 col-12 mr-auto">
                                                        <div class="d-flex">
                                                            <img src="{{asset('storage/'.auth()->user()->company->image)}}" class="rounded-circle"
                                                            width="100" alt="logo">
                                                        </div>
                                                    </div>
    
                                                    <div class="col-sm-6 text-sm-end">
                                                        <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span
                                                                class="inv-title">Bill N.o. : </span> <span
                                                                class="inv-number">#{{$slug}}</span></p>
                                                        <p class="inv-created-date mt-sm-5 mt-3"><span
                                                                class="inv-title">Bill Date : </span> <span
                                                                class="inv-date">{{\Carbon\Carbon::parse($details->bill_date)->format('M
                                                                d Y')}}</span></p>
                                                    </div>
                                                </div>
    
                                            </div>
    
                                            <div class="inv--detail-section inv--customer-detail-section">
                                                <div class="row">
                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                        <p class="inv-to">Bill To</p>
                                                        <p class="inv-customer-name">{{$details->vendor->name}}</p>
                                                        <p class="inv-street-addr">{{$details->vendor->address}}</p>
                                                        <p class="inv-email-address">{{$details->vendor->phone}}</p>
                                                        <p class="inv-email-address">{{$details->vendor->pan_vat}}</p>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="inv--product-table-section">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="">
                                                            <tr>
                                                                <th scope="col">S.N.</th>
                                                                <th scope="col">Items</th>
                                                                <th class="text-end" scope="col">Qty</th>
                                                                <th class="text-end" scope="col">Price</th>
                                                                <th class="text-end" scope="col">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($products as $product)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$product->itemIn->product->name}}</td>
                                                                <td class="text-end">{{$product->quantity}}</td>
                                                                <td class="text-end">Rs.{{number_format($product->rate,0)}}
                                                                </td>
                                                                <td class="text-end">
                                                                    Rs.{{number_format((float)$product->quantity*(float)$product->rate,0)}}
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">No records found</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
    
                                            <div class="inv--total px-3 pb-3">
                                                <div class="row mt-4">
                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                    </div>
                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                        <div class="text-sm-end">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Total :Rs.{{ number_format($subtotal,0) }}</p>
                                                                </div>
                                                                
                                                                @php
                                                                $totalExtraCharge = 0;
                                                                @endphp
                                                                @foreach($products as $product)
                                                                @if($product->extra_charge_id && $loop->first)
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">{{$product->extraCharge->name}}
                                                                        {{$product->extraCharge->value}}% : Rs.{{number_format((float)$subtotal+(float)$subtotal*((float)$product->extraCharge->value/100),0)}}</p>
                                                                </div>
                                                               
                                                                <div class="col-sm-8 col-7 grand-total-title mt-3">
                                                                    <h4 class="">Grand Total : Rs.{{number_format((float)$subtotal+(float)$subtotal*((float)$product->extraCharge->value/100),0)}}</h4>
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inv--note">
    
                                                <div class="row mt-4">
                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                        <p>Note: Thank you for doing Business with us.</p>
                                                    </div>
                                                </div>
            
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
    
    
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!--  END CONTENT AREA  -->

</body>

</html>