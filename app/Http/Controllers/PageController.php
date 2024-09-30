<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    public function department()
    {
        return view('pages.department.index');
    }
    public function departmentCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.department.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function departmentEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.department.edit',compact('slug'));
        } 
        else 
        {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function vendor()
    {
        return view('pages.vendor.index');
    }
    public function vendorCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.vendor.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function transaction($slug)
    {
        return view('pages.vendor.transaction',compact('slug'));
    }
    public function vendorEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.vendor.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function category()
    {
        return view('pages.category.index');
    }
    public function categoryCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.category.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }

    }
    public function categoryEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.category.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function cheque()
    {
        return view('pages.cheque.index');
    }
    public function charge()
    {
        return view('pages.charge.index');
    }
    public function chargeCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.charge.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
        
    }
    public function chargeEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.charge.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
        
    }
    public function inventory()
    {
        return view('pages.inventory.index');
    }
    public function inventoryCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.inventory.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function inventoryEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.inventory.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
        
    }
    public function service()
    {
        return view('pages.service.index');
    }
    public function serviceCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.service.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function serviceEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.service.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function employee()
    {
        return view('pages.employee.index');
    }
    public function employeeCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.employee.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function employeeEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.employee.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function stock()
    {
        return view('pages.stock.index');
    }
    public function stockCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.stock.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
        
    }
    public function stockEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.stock.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
        
    }
    public function prefix()
    {
        return view('pages.prefix.index');
    }
    public function prefixCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.prefix.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
        
    }
    public function prefixEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.prefix.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function bill()
    {
        return view('pages.bill.index');
    }
    public function billPreview($slug)
    {
        return view('pages.bill.preview',compact('slug'));
    }
    public function billCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.bill.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
        
    }
    public function billEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.bill.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function payment()
    {
        return view('pages.payment.index');
    }
    public function paymentPreview($slug)
    {
        if (Gate::allows('action-create')) {
            return view('pages.payment.preview',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to preview.');
        }
    }
    public function paymentCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.payment.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
        
    }
    public function paymentEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.payment.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
        
    }
    public function account()
    {
        return view('pages.account.index');
    }
    public function accountCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.account.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function accountEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.account.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function requisition()
    {
        return view('pages.requisition.index');
    }
    public function requisitionCreate()
    {
        return view('pages.requisition.create');
    }
    public function requisitionEdit($slug)
    {
        return view('pages.requisition.edit',compact('slug'));
    }
    public function approve()
    {
        if (Gate::allows('action-approve')) {
            return view('pages.requisition.approve.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to approve.');
        }
        
    }
    public function decline()
    {
        if (Gate::allows('action-decline')) {
            return view('pages.requisition.decline.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to decline.');
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
}
