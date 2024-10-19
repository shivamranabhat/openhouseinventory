<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TwitterCardController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\OpenGraphController;
use App\Http\Controllers\TagController;
use App\Http\Livewire\BarcodeComponent;
use App\Http\Middleware\CompanyMiddleware;

Route::prefix('/store-hero')->group(function(){
    Route::get('/logout', [PageController::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout');
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
        Route::get('/upload','stockOutUpload')->name('stockOut.upload');
        Route::post('/upload-excel','stockOutUploadExcel')->name('stockOut.uploadExcel');
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
     //Routes for blog
     Route::prefix('/blog')->controller(BlogController::class)->middleware(['auth'])->group(function(){
        Route::get('/','index')->name('blogs');
        Route::get('/create','create')->name('blog.create');
        Route::post('/upload-blog-img','uploadCkImage')->name('ckeditor.upload');
        Route::post('/store','store')->name('blog.store');
        Route::get('/{slug}','edit')->name('blog.edit');
        Route::put('/update/{slug}','update')->name('blog.update');
        Route::delete('/delete/{slug}','destroy')->name('blog.destroy');
    });
    Route::prefix('/testimonial')->controller(PageController::class)->middleware(['auth'])->group(function(){
        Route::get('','testimonial')->name('testimonials');
        Route::get('/create','testimonialCreate')->name('testimonial.create');
        Route::get('/edit/{slug}','testimonialEdit')->name('testimonial.edit');
    });
    Route::prefix('/faq')->controller(PageController::class)->middleware(['auth'])->group(function(){
        Route::get('','faq')->name('faqs');
        Route::get('/create','faqCreate')->name('faq.create');
        Route::get('/edit/{slug}','faqEdit')->name('faq.edit');
    });
    Route::prefix('/feature')->controller(PageController::class)->middleware(['auth'])->group(function(){
        Route::get('','feature')->name('features');
        Route::get('/create','featureCreate')->name('feature.create');
        Route::get('/edit/{slug}','featureEdit')->name('feature.edit');
    });
    Route::prefix('/payment-out')->controller(PageController::class)->middleware(['auth'])->group(function(){
        Route::get('','payment')->name('payments');
        Route::get('/create','paymentCreate')->name('payment.create');
        Route::get('/edit/{slug}','paymentEdit')->name('payment.edit');
    });

    Route::prefix('/cheque')->controller(PageController::class)->middleware(['auth'])->group(function(){
        Route::get('','cheque')->name('cheques');
        Route::get('/create','chequeCreate')->name('cheque.create');
        Route::get('/edit/{slug}','chequeEdit')->name('cheque.edit');
    });
    Route::prefix('/content')->controller(PageController::class)->middleware(['auth'])->group(function(){
        Route::get('','content')->name('contents');
        Route::get('/create','contentCreate')->name('content.create');
        Route::get('/edit/{slug}','contentEdit')->name('content.edit');
    });
    Route::prefix('/')->controller(PdfController::class)->group(function(){
        Route::get('transaction-pdf/{slug}','downloadTransactionPdf')->name('downloadTransactionPdf');
        Route::get('bill-pdf/{slug}','downloadBillPdf')->name('downloadBillPdf');
    });
    Route::prefix('/profile')->controller(PageController::class)->middleware(['auth'])->group(function(){
        Route::get('','profile')->name('profile');
    });
    Route::prefix('/seo')->group(function(){
        //Routes for tags
        Route::prefix('/tags')->controller(TagController::class)->group(function(){
            Route::get('/','index')->name('tags');
            Route::get('/create','create')->name('tag.create');
            Route::post('/store','store')->name('tag.store');
            Route::get('/{slug}','edit')->name('tag.edit');
            Route::put('/update/{slug}','update')->name('tag.update');
            Route::delete('/delete/{slug}','destroy')->name('tag.destroy');
        });
        
         //Routes for open graphs
        Route::prefix('/open-graph')->controller(OpenGraphController::class)->group(function(){
            Route::get('/','index')->name('graphs');
            Route::get('/create','create')->name('graph.create');
            Route::post('/store','store')->name('graph.store');
            Route::get('/{slug}','edit')->name('graph.edit');
            Route::put('/update/{slug}','update')->name('graph.update');
            Route::delete('/delete/{slug}','destroy')->name('graph.destroy');
        });
        //Routes for twitter cards
        Route::prefix('/twitter-card')->controller(TwitterCardController::class)->group(function(){
            Route::get('/','index')->name('cards');
            Route::get('/create','create')->name('card.create');
            Route::post('/store','store')->name('card.store');
            Route::get('/{slug}','edit')->name('card.edit');
            Route::put('/update/{slug}','update')->name('card.update');
            Route::delete('/delete/{slug}','destroy')->name('card.destroy');
        });
        //Routes for script
        Route::prefix('/scripts')->controller(ScriptController::class)->group(function(){
            Route::get('/','index')->name('scripts');
            Route::get('/create','create')->name('script.create');
            Route::post('/store','store')->name('script.store');
            Route::get('/{slug}','edit')->name('script.edit');
            Route::put('/update/{slug}','update')->name('script.update');
            Route::delete('/delete/{slug}','destroy')->name('script.destroy');
        });
    });
});

Route::prefix('/login')->controller(PageController::class)->group(function(){
    Route::get('','login')->name('login');
});
Route::prefix('/signup')->controller(PageController::class)->group(function(){
    Route::get('','signup')->name('signup');
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/blog/{slug}','blogDetails')->name('blog.details');
});
