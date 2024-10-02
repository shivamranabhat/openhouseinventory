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
                                    <div class="invoice">
                                        <div class="content-section">

                                            <div class="inv--head-section inv--detail-section">
                                                <div class="row">
                                                    <div class="col-sm-6 col-12 mr-auto">
                                                        <h3 class="in-heading ml-0">Transaction History</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="inv--detail-section inv--customer-detail-section">
                                                <div class="row">
                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                        <p class="inv-customer-name">{{$vendor->name}}</p>
                                                        <p class="inv-street-addr">{{$vendor->address}}</p>
                                                        <p class="inv-email-address">{{$vendor->phone}}</p>
                                                        <p class="inv-email-address">{{$vendor->pan_vat}}</p>
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
                                                            @forelse($purchases as $purchase)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$purchase->product->name}}</td>
                                                                <td class="text-end">{{$purchase->stock}}</td>
                                                                <td class="text-end">
                                                                    Rs.{{number_format($purchase->unit_price,0)}}</td>
                                                                <td class="text-end">
                                                                    Rs.{{number_format($purchase->total,0)}}</td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">No records found
                                                                </td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if($total)
                                            <div class="inv--total-amounts">
                                                <div class="row mt-4">
                                                    <div class="col-sm-5 col-12 order-sm-0 order-1"></div>
                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                        <div class="text-sm-end">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-7">
                                                                    <p>Total: Rs.{{$total ?
                                                                        number_format($total->total_sum,0) : '0'}}</p>
                                                                </div>

                                                                <div class="col-sm-8 col-7">
                                                                    <p>Paid: Rs.{{$transaction ?
                                                                        number_format($transaction->paid,0) : '0'}}</p>
                                                                </div>

                                                                <div class="col-sm-8 col-7">
                                                                    <p>Due: Rs.{{$remain ?
                                                                        number_format($remain->remain,0) : '0'}}</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="inv--note">
                                                <div class="row mt-4">
                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                        <p>Note: Thank you for doing business with us.</p>
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