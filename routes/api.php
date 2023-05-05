<?php

use App\Http\Controllers\api\BlogsController;
use App\Http\Controllers\api\ContactMessagesController;
use App\Http\Controllers\api\mainPageController;
use App\Http\Controllers\api\ProductsController;
use App\Http\Controllers\api\StaticPagesController;
use App\Http\Controllers\api\TestimonialsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=> ['api']], function () {
    Route::get('/mainpage',[StaticPagesController::class,'mainpage']);
    Route::get('/contactus',[StaticPagesController::class, 'contactus']);
    Route::get('/aboutus',[StaticPagesController::class, 'aboutus']);
    Route::get('/staticData',[StaticPagesController::class, 'staticData']);
    //products
    Route::get('/products',[ProductsController::class, 'products']);
    Route::get('/products/{product}/details',[ProductsController::class, 'productDetails']);
    //Testimonials
    Route::get('/testimonials',[TestimonialsController::class, 'testimonials']);
    Route::get('/testimonials/{testimonial}/details',[TestimonialsController::class, 'testimonialsDetails']);
    //Blog
    Route::get('/media',[BlogsController::class, 'index']);
    Route::get('/media/{media}',[BlogsController::class, 'show']);
    //main page
    Route::get('/mainpage',[mainPageController::class, 'index']);

    //Contact Us
    Route::post('/sendContactMessage',[ContactMessagesController::class, 'sendContactMessage']);


});

