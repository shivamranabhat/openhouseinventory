<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::prefix('/department')->controller(PageController::class)->group(function(){
    Route::get('','department')->name('departments');
    Route::get('/create','departmentCreate')->name('department.create');
    Route::get('/edit/{slug}','departmentEdit')->name('department.edit');
});
Route::prefix('/vendor')->controller(PageController::class)->group(function(){
    Route::get('','vendor')->name('vendors');
    Route::get('/create','vendorCreate')->name('vendor.create');
    Route::get('/edit/{slug}','vendorEdit')->name('vendor.edit');
});
Route::prefix('/category')->controller(PageController::class)->group(function(){
    Route::get('','category')->name('categories');
    Route::get('/create','categoryCreate')->name('category.create');
    Route::get('/edit/{slug}','categoryEdit')->name('category.edit');
});
Route::prefix('/product')->controller(PageController::class)->group(function(){
    Route::get('','product')->name('products');
    Route::get('/create','productCreate')->name('product.create');
    Route::get('/edit/{slug}','productEdit')->name('product.edit');
});
Route::prefix('/service')->controller(PageController::class)->group(function(){
    Route::get('','service')->name('services');
    Route::get('/create','serviceCreate')->name('service.create');
    Route::get('/edit/{slug}','serviceEdit')->name('service.edit');
});
Route::prefix('/service')->controller(PageController::class)->group(function(){
    Route::get('','service')->name('services');
    Route::get('/create','serviceCreate')->name('service.create');
    Route::get('/edit/{slug}','serviceEdit')->name('service.edit');
});
Route::prefix('/employee')->controller(PageController::class)->group(function(){
    Route::get('','employee')->name('employees');
    Route::get('/create','employeeCreate')->name('employee.create');
    Route::get('/edit/{slug}','employeeEdit')->name('employee.edit');
});
Route::prefix('/stock-in')->controller(PageController::class)->group(function(){
    Route::get('','stock')->name('stocks');
    Route::get('/create','stockCreate')->name('stock.create');
    Route::get('/edit/{slug}','stockEdit')->name('stock.edit');
});
