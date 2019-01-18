<?php

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('404', function () {
    return view('errors.404');
})->name('404');

Auth::routes();

Route::group([
    'middleware' => ['auth', 'is.admin'],
    'prefix'     => 'admin',
    'namespace'  => 'Admin',
    'as'         => 'admin.',
], function () {
    Route::get('dashboard', 'HomeController@index')->name('dashboard');

    //Manager Product
    Route::get('products', 'ProductController@index')->name('products.index');
    Route::get('products/create', 'ProductController@create')->name('product.create');
    Route::post('products', 'ProductController@store')->name('product.store');
    Route::delete('products/{id}', 'ProductController@destroy')->name('product.destroy');
    Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::put('products/{product}', 'ProductController@update')->name('products.update');
    Route::get('products/{product}/detail', 'ProductController@detailProductId')->name('product.detail');

    //Manger Image
    Route::get('images', 'ImageController@index')->name('image.index');
    Route::get('images/create', 'ImageController@create')->name('image.create');
    Route::post('images', 'ImageController@store')->name('image.store');
    Route::delete('images/{product}/delete', 'ImageController@destroy')->name('image.destroy');
    Route::get('images/{id}/edit', 'ImageController@edit')->name('image.edit');
    Route::post('images/{id}/update', 'ImageController@update')->name('image.update');

    //Manage ProductDetail
    Route::get('productdetails', 'ProductDetailController@index')->name('productdetail.index');
    Route::get('productdetails/{id}/edit', 'ProductDetailController@edit')->name('productdetail.edit');
    Route::post('productdetails/{id}/update', 'ProductDetailController@update')->name('productdetail.update');
    Route::delete('productdetails/{id}', 'ProductDetailController@destroy')->name('productdetail.destroy');

    //Category
    Route::get('categories', 'CategoryController@index')->name('categories.index');
    Route::get('categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    Route::delete('categories/{category}', 'CategoryController@destroy')->name('categories.delete');

	//Order
    Route::get('orders', 'OrderController@index')->name('orders.index');
    Route::get('orders/{order}', 'OrderController@show')->name('orders.show');
    Route::put('orders/{order}/status', 'OrderController@updateStatus')->name('orders.update.status');
    Route::delete('orders/{order}', 'OrderController@destroy')->name('orders.delete');

	//Comment
    Route::get('comments', 'CommentController@index')->name('comments.index');
    Route::get('comments/{comment}', 'CommentController@show')->name('comments.show');
    Route::put('comments/{comment}', 'CommentController@update')->name('comments.update');
    Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.delete');

    //User
    Route::get('users/admin', 'UserController@index')->name('user.index');
    Route::get('users/user', 'UserController@indexUser')->name('user.indexuser');
    Route::get('user/create', 'UserController@create')->name('user.create');
    Route::post('users', 'UserController@store')->name('user.store');
    Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
    Route::post('users/{user}', 'UserController@update')->name('user.update');
    Route::delete('users/{id}', 'UserController@destroy')->name('user.delete');
    Route::get('users/{user}/list_oder', 'UserController@listOrderById')->name('user.list_order');


    //Search
    Route::get('search/orders', 'SearchController@searchOrder')->name('search.orders');
    Route::get('users/search', 'UserController@getSearch')->name('user.search');
    Route::get('products/search','ProductController@getSearch')->name('product.search');

});

//Category
Route::get('categories', 'CategoryController@index')->name('categories.index');
Route::get('categories/{category}/products', 'CategoryController@listProductsById')->name('categories.list_products_by_id');

//Product
Route::get('products/{product}', 'ProductController@show')->name('products.show');

//Comment
Route::post('comments', 'CommentController@store')->name('comments.store');

//Account
Route::get('account', 'UserController@contactById')->name('account.index');
Route::get('account/addresses', 'UserController@addressById')->name('account.addresses');
Route::get('addresses/{address}/edit', 'UserController@edit')->name('address.edit');
Route::put('addresses/{address}', 'UserController@update')->name('address.update');
Route::get('account/orders/{order}/cancel', 'UserController@editOrderStatusById')->name('account.order.cannel');
Route::get('account/address/create', 'UserController@createNewAddress')->name('account.address.create');
Route::post('account/addresses','UserController@storeNewAddress')->name('account.address.storeNewAddress');
Route::delete('account/addresses/{address}', 'UserController@destroyAddressById')->name('account.address.delete');

//Search
Route::get('search', 'SearchController@index')->name('search');

//Cart
Route::get('cart', 'CartController@index')->name('cart.index');
Route::get('cart/checkout', 'CartController@showCheckoutForm')->name('cart.show_checkout_form');
Route::post('cart/checkout', 'CartController@checkout')->name('cart.checkout');

Auth::routes();
