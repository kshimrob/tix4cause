<?php

Route::get('/', 'LandingPageController@index')->name('landing-page');
/**Ip additions**/
Route::post('/currentlocation', 'LandingPageController@current');
Route::post('/inputlocation', 'LandingPageController@input');
Route::get('/about', 'StaticPageController@about');
Route::get('/terms', 'StaticPageController@terms');
Route::get('/privacy', 'StaticPageController@privacy');
Route::get('/faq', 'StaticPageController@faq');
Route::get('/proprietary', 'StaticPageController@proprietary');

Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');

Route::get('/checkout/{product}', 'CheckoutController@show')->name('checkout.show');
Route::post('/checkout', 'CheckoutController@chargeCreditCard')->name('checkout.store');

Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Route::get('/post/{slug}', 'PostController@show')->name('post.show');
Route::get('/blog', 'BlogController@index')->name('blog.index');
Route::get('/blog/{slug}', 'PostCategoryController@show')->name('postcategory.show');

Route::get('/causecheckout', 'CauseCheckoutController@index')->name('causecheckout.index');
Route::get('/causecheckout/{slug}', 'CauseCheckoutController@show')->name('causecheckout.show');

Route::get('/export', 'ShopController@exportFile');
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/search', 'ShopController@search')->name('search');

Route::get('/search-algolia', 'ShopController@searchAlgolia')->name('search-algolia');
/*
Route::get('/event', function(){
		return view('event');
});
*/
Route::get('/event', 'EventController@index')->name('event.index');

Route::get('/searchEvents', function(){
		return view('searchEvents');
});
/*
Route::get('/contact', function(){
	return view('contact');
});
*/
Route::get('contact', 'ContactUsController@getContact');
Route::post('contact', 'ContactUsController@postContact');