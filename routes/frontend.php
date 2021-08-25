<?php

Route::group(['middleware' => 'frontend'], function() {
    Route::get('/', ['as' => 'home.index', 'uses' => 'Auth\AuthController@getLogin']);
     
  
});
