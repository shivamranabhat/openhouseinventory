<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\ItemIn;
use App\Models\PaymentOut;
use App\Models\Bill;
use App\Models\BillProduct;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function downloadTransactionPdf($slug)
    {
        $vendor = Vendor::whereSlug($slug)->first();
        $purchases = ItemIn::where('vendor_id',$vendor->id)->paginate(10);
        $total = ItemIn::where('vendor_id', $vendor->id)
        ->selectRaw('SUM(total) as total_sum')
        ->groupBy('vendor_id')
        ->first();
        $transaction = PaymentOut::where('vendor_id',$vendor->id)
        ->selectRaw('SUM(paid) as paid')
        ->groupBy('vendor_id')
        ->first();
        $remain = PaymentOut::where('vendor_id',$vendor->id)
        ->selectRaw('SUM(remain) as remain')
        ->groupBy('vendor_id')
        ->first();

        $data = [
            'purchases'=>$purchases,
            'transaction'=>$transaction,
            'total'=>$total,
            'remain'=>$remain,
            'vendor'=>$vendor
        ];
        $pdf = PDF::loadView('pages.pdf.transaction', $data);
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', ' ', $vendor->name) . '.pdf';
        return $pdf->download($fileName);
    }
    
    public function downloadBillPdf($slug)
    {
        $details = Bill::whereSlug($slug)->first();
        $products = BillProduct::where('bill_id',$details->id)->latest()->get();
        $subtotal = $products->sum(function ($product) {
            return $product->rate * $product->quantity;
        });
        $data = [
            'details'=>$details,
            'products'=>$products,
            'subtotal'=>$subtotal,
            'slug'=>$slug,
        ];
        $pdf = PDF::loadView('pages.pdf.bill', $data);
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', ' ', 'Bill-'.$slug) . '.pdf';
        return $pdf->download($fileName);
    }
}
