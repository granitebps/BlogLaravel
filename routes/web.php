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

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Dashboard Admin
    Route::get('/home', 'HomeController@index')->name('home');
    
    // Setting
    Route::get('/setting', 'SettingController@edit')->name('setting');
    Route::post('/setting', 'SettingController@update')->name('setting.update');

    // User
    Route::get('/user', 'UserController@index')->name('user');
    Route::get('/user/{id}', 'UserController@destroy')->name('user.delete');
    // Trashed User
    Route::get('/trashed_user', 'UserController@trashed')->name('user.trashed');
    Route::get('/restore_user/{id}', 'UserController@restore')->name('user.restore');
    Route::get('/kill_user/{id}', 'UserController@kill')->name('user.kill');

    // Profile
    Route::get('/profile', 'ProfileController@edit')->name('profile');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');
    // Change Password
    Route::get('/change-password', 'ProfileController@edit_password')->name('password');
    Route::post('/change-password', 'ProfileController@update_password')->name('password.update');

    // Task
    Route::resource('task', 'TaskController');
    Route::get('/task/completed/{id}', 'TaskController@completed')->name('task.completed');

    // Category
    Route::get('category/delete/{id}', 'CategoryController@destroy')->name('category.delete');
    Route::resource('category', 'CategoryController');

    // Tag
    Route::resource('tag', 'TagController');

    // Message
    Route::get('/message', 'MessageController@index')->name('message.index');
    // Reply Message
    Route::get('/reply/{id}', 'MessageController@reply')->name('message.reply');
    Route::post('/reply/{id}', 'MessageController@replied')->name('message.replied');
    // Delete Message
    Route::get('/delete/{id}', 'MessageController@delete')->name('message.delete');
    // Readed Message
    Route::get('/readed/{id}', 'MessageController@readed')->name('message.read');

    // Subscriber
    Route::get('/subscriber', 'SubscriberController@index')->name('subs.index');

    // Post
    Route::resource('post', 'PostController');
    // Trashed Post
    Route::get('/trashed_post', 'PostController@trashed')->name('post.trashed');
    // Restored Post
    Route::get('/restored_post/{id}', 'PostController@restored')->name('post.restored');
    // Deleted Post Permanently
    Route::get('/killed_post/{id}', 'PostController@killed')->name('post.killed');
    // Drafted Post
    Route::get('/draft_post/{id}', 'PostController@drafted')->name('post.draft');

    // Portfolio
    Route::resource('portfolio', 'PortfolioController');
});

// Tampilan User
Route::get('/', 'HomeController@welcome')->name('home.welcome');
// Tampilan per post
Route::get('/post/{slug}', 'HomeController@show')->name('home.show');
// Tampilan per category
Route::get('/category/{slug}', 'HomeController@category')->name('home.category');
// Tampilan per tag
Route::get('/tag/{slug}', 'HomeController@tag')->name('home.tag');
// Search Post
Route::get('/search-post', 'HomeController@search')->name('home.search');
// About
Route::get('/about', 'HomeController@about')->name('home.about');
// Contact
Route::get('/contact', 'HomeController@contact')->name('home.contact');
// Contact Email
Route::post('/contact', 'HomeController@contact_email')->name('home.email');
// Subscription
Route::post('/subs', 'HomeController@subs')->name('home.subs');
// Portfolio
Route::get('/portfolio', 'HomeController@portfolio')->name('home.portfolio');