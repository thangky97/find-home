<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function () {
    return view('client/product');
});

Route::get('/news', function () {
    return view('client/news');
});

Route::get('/contact', function () {
    return view('client/contact');
});

Route::get('/about', function () {
    return view('client/about');
});


// Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {

    Route::get('/dashboard', 'Admin\DashboardController@index')->name('route_BackEnd_Dashboard');

    Route::prefix('/users')->group(function () {
        Route::get('/', 'Admin\StaffController@index')->name('route_BackEnd_Users_List');
        Route::match(['get', 'post'], '/create', 'Admin\StaffController@create')->name('route_BackEnd_Users_Create');
        Route::get('/edit/{id}', 'Admin\StaffController@edit')->name('route_BackEnd_Users_Edit');
        Route::post('/update/{id}', 'Admin\StaffController@update')->name('route_BackEnd_Users_Update');
        Route::get('/remove/{id}', 'Admin\StaffController@remove')->name('route_BackEnd_Users_Remove');
    });

    Route::prefix('/customer')->group(function () {
        Route::get('/', 'Admin\CustomerController@index')->name('route_BackEnd_Customers_List');
        Route::match(['get', 'post'], '/create', 'Admin\CustomerController@create')->name('route_BackEnd_Customers_Create');
        Route::get('/edit/{id}', 'Admin\CustomerController@edit')->name('route_BackEnd_Customers_Edit');
        Route::post('/update/{id}', 'Admin\CustomerController@update')->name('route_BackEnd_Customers_Update');
        Route::get('/remove/{id}', 'Admin\CustomerController@remove')->name('route_BackEnd_Customers_Remove');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/', 'Admin\ProductController@index')->name('route_BackEnd_Products_List');
        Route::match(['get', 'post'], '/create', 'Admin\ProductController@create')->name('route_BackEnd_Products_Create');
        Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('route_BackEnd_Products_Edit');
        Route::post('/update/{id}', 'Admin\ProductController@update')->name('route_BackEnd_Products_Update');
        Route::get('/remove/{id}', 'Admin\ProductController@remove')->name('route_BackEnd_Products_Remove');
    });

    Route::prefix('/attribute')->group(function () {
        Route::get('/', 'Admin\AttributeController@index')->name('route_BackEnd_Attribute_List');
        Route::match(['get', 'post'], '/create', 'Admin\AttributeController@create')->name('route_BackEnd_Attribute_Create');
        Route::get('/edit/{id}', 'Admin\AttributeController@edit')->name('route_BackEnd_Attribute_Edit');
        Route::post('/update/{id}', 'Admin\AttributeController@update')->name('route_BackEnd_Attribute_Update');
        Route::get('/remove/{id}', 'Admin\AttributeController@remove')->name('route_BackEnd_Attribute_Remove');
    });

    Route::prefix('/banner')->group(function () {
        Route::get('/', 'Admin\BannerController@index')->name('route_BackEnd_Banner_List');
        Route::match(['get', 'post'], '/create', 'Admin\BannerController@create')->name('route_BackEnd_Banner_Create');
        Route::get('/edit/{id}', 'Admin\BannerController@edit')->name('route_BackEnd_Banner_Edit');
        Route::post('/update/{id}', 'Admin\BannerController@update')->name('route_BackEnd_Banner_Update');
        Route::get('/remove/{id}', 'Admin\BannerController@remove')->name('route_BackEnd_Banner_Remove');
    });

    Route::prefix('/news')->group(function () {
        Route::get('/', 'Admin\NewsController@index')->name('route_BackEnd_News_List');
        Route::match(['get', 'post'], '/create', 'Admin\NewsController@create')->name('route_BackEnd_News_Create');
        Route::get('/edit/{id}', 'Admin\NewsController@edit')->name('route_BackEnd_News_Edit');
        Route::post('/update/{id}', 'Admin\NewsController@update')->name('route_BackEnd_News_Update');
        Route::get('/remove/{id}', 'Admin\NewsController@remove')->name('route_BackEnd_News_Remove');
    });

    Route::prefix('/category_news')->group(function () {
        Route::get('/', 'Admin\CategoryNewsController@index')->name('route_BackEnd_Category_News_List');
        Route::match(['get', 'post'], '/create', 'Admin\CategoryNewsController@create')->name('route_BackEnd_Category_News_Create');
        Route::get('/edit/{id}', 'Admin\CategoryNewsController@edit')->name('route_BackEnd_Category_News_Edit');
        Route::post('/update/{id}', 'Admin\CategoryNewsController@update')->name('route_BackEnd_Category_News_Update');
        Route::get('/remove/{id}', 'Admin\CategoryNewsController@remove')->name('route_BackEnd_Category_News_Remove');
    });
});