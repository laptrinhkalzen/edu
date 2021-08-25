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
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
Route::get('/filter-news-cat', ['as' => 'api.filter_news_cat', 'uses' => 'Backend\NewssController@filter_news_cat']);
Route::group(['prefix' => 'api', 'middleware' => 'api'], function() {
    Route::post('/login-marketing', ['as' => 'api.login-marketing', 'uses' => 'Api\AuthController@login']);
    Route::get('/logout-marketing', ['as' => 'api.logout-marketing', 'uses' => 'Api\AuthController@logout']);
    Route::post('/login-construction', ['as' => 'api.login-construction', 'uses' => 'Api\FrontendController@loginConstruction']);
    Route::get('/logout-construction', ['as' => 'api.logout-construction', 'uses' => 'Api\AuthController@logoutConstruction']);
    Route::post('/add-to-cart', ['as' => 'api.addtocart', 'uses' => 'Api\ProductController@addToCart']);
    Route::post('/update-cart', ['as' => 'api.updatecart', 'uses' => 'Api\ProductController@updateCart']);
    Route::post('/delete-cart', ['as' => 'api.deletecart', 'uses' => 'Api\ProductController@deleteCart']);
    Route::post('/login-with-fb-sdk', ['as' => 'api.login_with_fb', 'uses' => 'Api\FrontendController@checkUser']);

    Route::post('/edit_template_setting', ['as' => 'api.edit_template_setting', 'uses' => 'Api\TemplateSettingController@update']);

});

