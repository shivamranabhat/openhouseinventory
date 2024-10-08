<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\BarcodeComponent;
use App\Http\Middleware\CompanyMiddleware;

Route::prefix('/department')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','department')->name('departments');
    Route::get('/create','departmentCreate')->name('department.create');
    Route::get('/edit/{slug}','departmentEdit')->name('department.edit');
});
Route::prefix('/vendor')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','vendor')->name('vendors');
    Route::get('/create','vendorCreate')->name('vendor.create');
    Route::get('/transaction/{slug}','transaction')->name('vendor.trans');
    Route::get('/edit/{slug}','vendorEdit')->name('vendor.edit');
});
Route::prefix('/category')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','category')->name('categories');
    Route::get('/create','categoryCreate')->name('category.create');
    Route::get('/edit/{slug}','categoryEdit')->name('category.edit');
});
Route::prefix('/inventory')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','inventory')->name('inventories');
    Route::get('/create','inventoryCreate')->name('inventory.create');
    Route::get('/edit/{slug}','inventoryEdit')->name('inventory.edit');
});

Route::prefix('/service')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','service')->name('services');
    Route::get('/create','serviceCreate')->name('service.create');
    Route::get('/edit/{slug}','serviceEdit')->name('service.edit');
});
Route::prefix('/employee')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','employee')->name('employees');
    Route::get('/create','employeeCreate')->name('employee.create');
    Route::get('/edit/{slug}','employeeEdit')->name('employee.edit');
});
Route::prefix('/stock-in')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','stock')->name('stocks');
    Route::get('/create','stockCreate')->name('stock.create');
    Route::get('/edit/{slug}','stockEdit')->name('stock.edit');
});
Route::prefix('/stock-out')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','stockOut')->name('stockOuts');
    Route::get('/create','stockOutCreate')->name('stockOut.create');
    Route::get('/edit/{slug}','stockOutEdit')->name('stockOut.edit');

});
Route::prefix('/prefix')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','prefix')->name('prefixes');
    Route::get('/create','prefixCreate')->name('prefix.create');
    Route::get('/edit/{slug}','prefixEdit')->name('prefix.edit');
});
Route::prefix('/charge')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','charge')->name('charges');
    Route::get('/create','chargeCreate')->name('charge.create');
    Route::get('/edit/{slug}','chargeEdit')->name('charge.edit');
});
Route::prefix('/credit')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','credit')->name('credits');
    Route::get('/create','creditCreate')->name('credit.create');
    Route::get('/edit/{slug}','creditEdit')->name('credit.edit');
});
Route::prefix('/bill')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','bill')->name('bills');
    Route::get('/create','billCreate')->name('bill.create');
    Route::get('/preview/{slug}','billPreview')->name('bill.preview');
    Route::get('/edit/{slug}','billEdit')->name('bill.edit');
});
Route::prefix('/requisition')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','requisition')->name('requisitions');
    Route::get('/create','requisitionCreate')->name('requisition.create');
    Route::get('/edit/{slug}','requisitionEdit')->name('requisition.edit');
});
Route::prefix('/account')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','account')->name('accounts');
    Route::get('/create','accountCreate')->name('account.create');
    Route::get('/edit/{slug}','accountEdit')->name('account.edit');
});
Route::prefix('/payment-out')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','payment')->name('payments');
    Route::get('/create','paymentCreate')->name('payment.create');
    Route::get('/edit/{slug}','paymentEdit')->name('payment.edit');
});
// Route::prefix('/approved')->controller(PageController::class)->middleware(['auth'])->group(function(){
//     Route::get('','approve')->name('approves');
// });
// Route::prefix('/declined')->controller(PageController::class)->middleware(['auth'])->group(function(){
//     Route::get('','decline')->name('declines');
// });
Route::prefix('/cheque')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','cheque')->name('cheques');
    Route::get('/create','chequeCreate')->name('cheque.create');
    Route::get('/edit/{slug}','chequeEdit')->name('cheque.edit');
});
Route::prefix('/profile')->controller(PageController::class)->middleware(['auth'])->group(function(){
    Route::get('','profile')->name('profile');
});
Route::prefix('/login')->controller(PageController::class)->group(function(){
    Route::get('','login')->name('login');
});
Route::prefix('/signup')->controller(PageController::class)->group(function(){
    Route::get('','signup')->name('signup');
});
Route::prefix('/')->controller(PdfController::class)->group(function(){
    Route::get('transaction-pdf/{slug}','downloadTransactionPdf')->name('downloadTransactionPdf');
    Route::get('bill-pdf/{slug}','downloadBillPdf')->name('downloadBillPdf');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('index');
});
