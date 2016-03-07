<?php

Route::group(['middleware' => ['web','role:admin']], function() {
    /**
     * Users Routes
     */
    Route::get('users/{id}/delete', ['as'=>'users.delete', 'uses'=>'UsersController@delete']);
    Route::resource('users','UsersController');
});
