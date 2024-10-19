<div class="doc-container">

    <div class="row">

        <div class="col-xl-9">

            <div class="invoice-container" id="invoice-container">
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

                                    <div class="row gap-3 gap-md-0">

                                        <div class="col-xl-8 col-lg-7 col-md-6">
                                            <p class="inv-customer-name">{{$vendor->name}}</p>
                                            <p class="inv-street-addr">{{$vendor->address}}</p>
                                            <p class="inv-email-address">{{$vendor->phone}}</p>
                                            <p class="inv-email-address">{{$vendor->pan_vat}}</p>
                                        </div>
                                        <div class="col-xl-4 col-lg-5 col-md-6">

                                            <div class="inv--total-amount px-0 px-md-5">
            
                                                <div class="row">
                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                    </div>
                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                        <div class="text-sm-end">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Paid :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">Rs.{{$transaction ?
                                                                        number_format($transaction->paid,0) : '0'}}</p>
                                                                </div>
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Due :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">Rs.{{$remain ? number_format($remain,0) :
                                                                        '0'}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
            
                                            </div>

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
                                                    <td class="text-end">Rs.{{number_format($purchase->unit_price,0)}}
                                                    </td>
                                                    <td class="text-end">Rs.{{number_format($purchase->total,0)}}</td>
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

        <div class="col-xl-3">

            <div class="invoice-actions-btn">

                <div class="invoice-action-btn">

                    <div class="row">

                        <div class="col-xl-12 col-md-3 col-sm-6">
                            <a href="javascript:void(0);"
                                class="btn btn-secondary btn-print action-print _effect--ripple waves-effect waves-light"
                                onclick="printBill()">Print</a>
                        </div>
                        <div class="col-xl-12 col-md-3 col-sm-6" target="_blank">
                            <a href="{{route('downloadTransactionPdf',$slug)}}"
                                class="btn btn-success btn-download _effect--ripple waves-effect waves-light">Download</a>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <script>
        function printBill() {
            // Get the invoice container
            var invoiceContent = document.getElementById('invoice-container').innerHTML;
    
            // Create a new window
            var printWindow = window.open('', '_blank');
    
            // Write the HTML content to the new window
            printWindow.document.write(`
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Print Invoice</title>

                    <!-- BEGIN GLOBAL MANDATORY STYLES -->
                    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
                    <link href="{{asset('src/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
                    <link href="{{asset('layouts/vertical-dark-menu/css/light/plugins.css')}}" rel="stylesheet" type="text/css" />
                    <link href="{{asset('layouts/vertical-dark-menu/css/dark/plugins.css')}}" rel="stylesheet" type="text/css" />
                    <link href="{{asset('src/assets/css/light/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css">
                    <link href="{{asset('src/assets/css/dark/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css">
                    <link href="{{asset('src/assets/css/light/components/modal.css')}}" rel="stylesheet" type="text/css">
                    <link href="{{asset('src/assets/css/dark/components/modal.css')}}" rel="stylesheet" type="text/css">
                    <!-- END GLOBAL MANDATORY STYLES -->

                    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
                    <link href="{{asset('src/plugins/src/animate/animate.css')}}" rel="stylesheet" type="text/css" />
                    <link href="{{asset('src/assets/css/light/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
                    <link href="{{asset('src/assets/css/dark/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
                    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/src/table/datatable/datatables.css')}}">

                    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/light/table/datatable/dt-global_style.css')}}">
                    <link rel="stylesheet" type="text/css" href="{{asset('src/plugins/css/dark/table/datatable/dt-global_style.css')}}">
                    <link href="{{asset('src/assets/css/dark/apps/invoice-list.css')}}" rel="stylesheet" type="text/css">
                    <link href="{{asset('assets/dark/invoice-preview.css')}}" rel="stylesheet" type="text/css">
                    <link href="{{asset('assets/light/invoice-preview.css')}}" rel="stylesheet" type="text/css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
                    <style>
                        /* Add your custom styles here */
                        body {
                            margin: 20px;
                        }
                    </style>
                </head>
                <body onload="window.print(); window.close();">
                    ${invoiceContent}
                    
                </body>
                </html>
            `);
    
            printWindow.document.close();
        }
    </script>

</div>