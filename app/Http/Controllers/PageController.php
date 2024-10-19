<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Stock;
use App\Models\StockOut;
use App\Models\ItemIn;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class PageController extends Controller
{
   
    public function department()
    {
        try{

            if (Gate::allows('action-create')) {
                return view('pages.department.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function departmentCreate()
    {
        try{ 
            if (Gate::allows('action-create')) {
                return view('pages.department.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function departmentEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.department.edit',compact('slug'));
            } 
            else 
            {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function vendor()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.vendor.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function vendorCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.vendor.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function transaction($slug)
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.vendor.transaction',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function vendorEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.vendor.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function category()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.category.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function categoryCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.category.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }

    }
    public function categoryEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.category.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function cheque()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.cheque.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function chequeCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.cheque.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function chequeEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.cheque.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function charge()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.charge.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function chargeCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.charge.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
        
    }
    public function chargeEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.charge.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
        
    }
    public function inventory()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.inventory.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function inventoryCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.inventory.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function inventoryEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.inventory.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
        
    }
    public function service()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.service.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function serviceCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.service.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function serviceEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.service.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function employee()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.employee.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function employeeCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.employee.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function employeeEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.employee.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function stock()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.stock.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
   
    public function stockCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.stock.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            } 
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function stockEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.stock.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            } 
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function stockOut()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.stock_out.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function stockOutUpload()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.stock_out.upload');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to upload.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function stockOutCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.stock_out.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            } 
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function stockOutEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.stock_out.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            } 
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function credit()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.credit.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function creditCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.credit.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            } 
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function creditEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.credit.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            } 
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function prefix()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.prefix.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function prefixCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.prefix.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function prefixEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.prefix.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function bill()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.bill.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function billPreview($slug)
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.bill.preview',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function billCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.bill.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            } 
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function billEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.bill.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function payment()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.payment.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function paymentPreview($slug)
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.payment.preview',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to preview.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function paymentCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.payment.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
        
    }
    public function paymentEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.payment.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
        
    }
    public function account()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.account.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to view.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function accountCreate()
    {
        try{
            if (Gate::allows('action-create')) {
                return view('pages.account.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to create.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function accountEdit($slug)
    {
        try{
            if (Gate::allows('action-edit')) {
                return view('pages.account.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to edit.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function requisition()
    {
        try{
            return view('pages.requisition.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function requisitionCreate()
    {
        try{
            if(auth()->user()->employee_id !==null)
            {
                return view('pages.requisition.create');
            }
            else{
                return redirect()->back()->with('error','Only employees are allowed.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function requisitionEdit($slug)
    {
        try{
            return view('pages.requisition.edit',compact('slug'));
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function login()
    {
        return view('pages.auth.login');
    }
    public function profile()
    {
        return view('pages.auth.profile');
    }
    public function signup()
    {
        return view('pages.auth.signup');
    }
   
    public function testimonial()
    {
        try{
            if (Gate::allows('super-admin')) 
            {
               return view('pages.testimonial.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function testimonialCreate()
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.testimonial.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function testimonialEdit($slug)
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.testimonial.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function content()
    {
        try{
            if (Gate::allows('super-admin')) 
            {
               return view('pages.content.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function contentCreate()
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.content.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function contentEdit($slug)
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.content.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function feature()
    {
        try{
            if (Gate::allows('super-admin')) 
            {
               return view('pages.feature.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function featureCreate()
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.feature.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function featureEdit($slug)
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.feature.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function faq()
    {
        try{
            if (Gate::allows('super-admin')) 
            {
               return view('pages.faq.index');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function faqCreate()
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.faq.create');
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function faqEdit($slug)
    {
        try{
            if (Gate::allows('super-admin')) {
                return view('pages.faq.edit',compact('slug'));
            } else {
                // Handle unauthorized action
                return redirect()->back()->with('error','You do not have permission to access.');
            }
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }
    }
    public function stockOutUploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        // Open the uploaded CSV file
        $handle = fopen($request->file('file')->getRealPath(), 'r');

        // Skip the header row if necessary
        fgetcsv($handle);

        // Process each row in the CSV
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $this->processRow($row);
        }

        fclose($handle);

        return redirect()->route('stockOuts')->with('message', 'Data imported successfully!');
        
    }
    private function processRow(array $row)
    {
        // Similar processing logic as before
        $productName = $row[1];
        $departmentName = $row[2];
        $quantity = (int)$row[3];

        $department = Department::where('name', $departmentName)->first();
        $product = Product::where('name', $productName)->first();

        if ($product && $department) {
            $itemIn = ItemIn::where('product_id', $product->id)->first();
            if ($department && $itemIn) {
                $stockRecord = Stock::where('product_id', $product->id)->first();

                if ($stockRecord && $stockRecord->stock >= $quantity) {
                    StockOut::create([
                        'department_id' => $department->id,
                        'item_in_id' => $itemIn->id,
                        'company_id' => auth()->user()->company_id,
                        'quantity' => $quantity,
                        'slug' => \Str::slug($productName . '-' . now()),
                    ]);

                    $stockRecord->update([
                        'stock' => $stockRecord->stock - $quantity,
                    ]);
                }
                else{
                    session()->flash('error','Please check the used quantity properly.');
                }
            }
        }
        else{
            session()->flash('error','Please check the excel file properly.');
        }
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout successfully');
    }
}
