<?php

Auth::routes();

// Front-end route is here
Route::get('/', 'WebsiteController@index')->name('website');
Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');
Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
Route::get('posts', 'PostController@index')->name('post.index');
Route::get('post/{slug}', 'PostController@details')->name('post.details');
Route::get('category/{slug}', 'PostController@postsByCategory')->name('posts.category');
Route::get('tag/{slug}', 'PostController@postsByTag')->name('posts.tag');
Route::get('search', 'SearchController@search')->name('search');
Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
Route::get('profile/{username}', 'AuthorController@profile')->name('author.profile');

// Admin is here
    Route::group(['as'=>'admin.', 'prefix' => 'admin', 'namespace'=>'Admin','middleware'=>['auth','admin']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/tags', 'TagController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/posts', 'PostController');
    Route::get('post/pending', 'PostController@pending')->name('post.pending');
    Route::put('/post/{id}/approve', 'PostController@approve')->name('post.approve');
    Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');
    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::put('/profile-update', 'SettingsController@update')->name('profile.update');
    Route::put('/Password-update', 'SettingsController@updatepassword')->name('password.update');
    Route::get('favorite/post', 'FavoritePostController@index')->name('favorite.post');
    Route::get('comments', 'CommentController@index')->name('comments.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');
    Route::get('authors', 'AuthorController@index')->name('authors.index');
    Route::delete('authors/{id}', 'AuthorController@destroy')->name('authors.destroy');
});

// Author is here
Route::group(['as'=>'author.', 'prefix' => 'author', 'namespace'=>'Author','middleware'=>['auth','author']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/posts', 'PostController');
    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::put('/profile-update', 'SettingsController@update')->name('profile.update');
    Route::put('/Password-update', 'SettingsController@updatepassword')->name('password.update');
    Route::get('favorite/post', 'FavoritePostController@index')->name('favorite.post');
    Route::get('comments', 'CommentController@index')->name('comments.index');
    Route::delete('comments/{id}', 'CommentController@destroy')->name('comments.destroy');
});
