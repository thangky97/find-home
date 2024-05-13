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

    Route::prefix('/staffs')->group(function () {
        Route::get('/', 'Admin\StaffController@index')->name('route_BackEnd_Staff_List');
        Route::get('/create', 'Admin\StaffController@create')->name('route_BackEnd_Staff_Create');
        Route::get('/edit/{id}', 'Admin\StaffController@edit')->name('route_BackEnd_Staff_Edit');
    });

    Route::prefix('/customers')->group(function () {
        Route::get('/', 'Admin\CustomerController@index')->name('route_BackEnd_Customers_List');
        Route::get('/create', 'Admin\CustomerController@create')->name('route_BackEnd_Customers_Create');
        Route::get('/edit/{id}', 'Admin\CustomerController@edit')->name('route_BackEnd_Customers_Edit');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/', 'Admin\ProductController@index')->name('route_BackEnd_Products_List');
        Route::get('/create', 'Admin\ProductController@create')->name('route_BackEnd_Products_Create');
        Route::get('/edit/{id}', 'Admin\ProductController@edit')->name('route_BackEnd_Products_Edit');
    });

    Route::prefix('/category_products')->group(function () {
        Route::get('/', 'Admin\CategoryProductController@index')->name('route_BackEnd_CategoryProducts_List');
        Route::get('/create', 'Admin\CategoryProductController@create')->name('route_BackEnd_CategoryProducts_Create');
        Route::get('/edit/{id}', 'Admin\CategoryProductController@edit')->name('route_BackEnd_CategoryProducts_Edit');
    });

    Route::prefix('/attributes')->group(function () {
        Route::get('/', 'Admin\ProductAttributeController@index')->name('route_BackEnd_Products_Attribute_List');
        Route::get('/create', 'Admin\ProductAttributeController@create')->name('route_BackEnd_Products_Attribute_Create');
        Route::get('/edit/{id}', 'Admin\ProductAttributeController@edit')->name('route_BackEnd_Products_Attribute_Edit');
    });

    Route::prefix('/news')->group(function () {
        Route::get('/', 'Admin\NewsController@index')->name('route_BackEnd_News_List');
        Route::get('/add', 'Admin\NewsController@addForm')->name('route_BackEnd_News_Add');
        Route::post('/saveAddForm', 'Admin\NewsController@saveAdd')->name('route_BackEnd_News_saveAdd');
        Route::get('/detail/{id}', 'Admin\NewsController@editForm')->name('route_BackEnd_News_Detail');
        Route::post('/detail/{id}', 'Admin\NewsController@saveEdit')->name('route_BackEnd_News_Update');
    });

    Route::prefix('/category_news')->group(function () {
        Route::get('/', 'Admin\CategoryNewController@index')->name('route_BackEnd_Category_News_List');
        Route::get('/add', 'Admin\CategoryNewController@addForm')->name('route_BackEnd_Category_News_Add');
        Route::post('/saveAddForm', 'Admin\CategoryNewController@saveAdd')->name('route_BackEnd_Category_News_saveAdd');
        Route::get('/detail/{id}', 'Admin\CategoryNewController@editForm')->name('route_BackEnd_Category_News_Detail');
        Route::post('/detail/{id}', 'Admin\CategoryNewController@saveEdit')->name('route_BackEnd_Category_News_Update');
    });
});