<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('frontend.index');
})->name('landing-page');

/*****************ADMIN ROUTES*******************/
Route::prefix('admin')->middleware('can:admin')->group(function(){
    Route::get('/dashboard', function () {
    return view('frontend.setting');
})->name('dashboard');
    //trailer
    Route::resource('trailers', App\Http\Controllers\admin\TrailerController::class);
});
/*****************END ADMIN ROUTES*******************/


/*****************DASHBOARD ROUTES*******************/
Route::prefix('dashboard')->middleware(['auth','dashboard'])->group(function(){

//brand-profile
Route::get('/profile',[App\Http\Controllers\DashboardController::class, 'profile'])->name('dashboard.profile');
Route::post('/update-profile',[App\Http\Controllers\DashboardController::class, 'update_profile'])->name('update.profile');

});


/********************DASHBOARD ROUTES END******************************/

//order trailer
Route::post('order-trailer', [App\Http\Controllers\OrderTrailerController::class, 'order_trailer'])->name('order-trailer');


Route::get('/book_trailer', function () {
    return view('frontend.book_trailer');
});

Route::get('/congrats', function () {
    return view('frontend.congrats');
});

Route::get('/done', function () {
    return view('frontend.done');
});

Route::get('/payment_method', function () {
    return view('frontend.payment_method');
});

Route::get('/photo_uploaded', function () {
    return view('frontend.photo_uploaded');
});

Route::get('/upload_photo', function () {
    return view('frontend.upload_photo');
});

Route::get('/about_us', function () {
    return view('frontend.about_us');
})->name('about-us');    

Route::get('/contact_us', function () {
    return view('frontend.contact_us');
})->name('contact-us');

Route::get('/terms', function () {
    return view('frontend.terms');
});

Route::get('/legal', function () {
    return view('frontend.legal');
});

Route::get('/my_booking', function () {
    return view('frontend.my_booking');
});

Route::get('/user_profile', function () {
    return view('frontend.user_profile');
});

Route::get('/dashboard', function () {
    return view('frontend.dashboard');
});

// about_us.blade

Auth::routes();

Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'handleGoogleCallback']);
Route::get('auth/facebook', [App\Http\Controllers\GoogleController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [App\Http\Controllers\GoogleController::class, 'handleFacebookCallback']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
