<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function department()
    {
        return view('pages.department.index');
    }
    public function departmentCreate()
    {
        return view('pages.department.create');
    }
    public function departmentEdit($slug)
    {
        return view('pages.department.edit',compact('slug'));
    }
    public function vendor()
    {
        return view('pages.vendor.index');
    }
    public function vendorCreate()
    {
        return view('pages.vendor.create');
    }
    public function vendorEdit($slug)
    {
        return view('pages.vendor.edit',compact('slug'));
    }
    public function category()
    {
        return view('pages.category.index');
    }
    public function categoryCreate()
    {
        return view('pages.category.create');
    }
    public function categoryEdit($slug)
    {
        return view('pages.category.edit',compact('slug'));
    }
    public function inventory()
    {
        return view('pages.inventory.index');
    }
    public function inventoryCreate()
    {
        return view('pages.inventory.create');
    }
    public function inventoryEdit($slug)
    {
        return view('pages.inventory.edit',compact('slug'));
    }
    public function service()
    {
        return view('pages.service.index');
    }
    public function serviceCreate()
    {
        return view('pages.service.create');
    }
    public function serviceEdit($slug)
    {
        return view('pages.service.edit',compact('slug'));
    }
    public function employee()
    {
        return view('pages.employee.index');
    }
    public function employeeCreate()
    {
        return view('pages.employee.create');
    }
    public function employeeEdit($slug)
    {
        return view('pages.employee.edit',compact('slug'));
    }
    public function stock()
    {
        return view('pages.stock.index');
    }
    public function stockCreate()
    {
        return view('pages.stock.create');
    }
    public function stockEdit($slug)
    {
        return view('pages.stock.edit',compact('slug'));
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
}
