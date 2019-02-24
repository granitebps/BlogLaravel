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

// ============================================ BLOG ============================================

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Dashboard Admin
    Route::get('/home', 'Blog\HomeController@index')->name('home');

    // Setting
    Route::get('/setting', 'Blog\SettingController@edit')->name('setting');
    Route::post('/setting', 'Blog\SettingController@update')->name('setting.update');

    // User
    Route::get('/user', 'Blog\UserController@index')->name('user');
    Route::get('/user/{id}', 'Blog\UserController@destroy')->name('user.delete');
    // Trashed User
    Route::get('/trashed_user', 'Blog\UserController@trashed')->name('user.trashed');
    Route::get('/restore_user/{id}', 'Blog\UserController@restore')->name('user.restore');
    Route::get('/kill_user/{id}', 'Blog\UserController@kill')->name('user.kill');

    // Profile
    Route::get('/profile', 'Blog\ProfileController@edit')->name('profile');
    Route::post('/profile', 'Blog\ProfileController@update')->name('profile.update');
    // Change Password
    Route::get('/change-password', 'Blog\ProfileController@edit_password')->name('password');
    Route::post('/change-password', 'Blog\ProfileController@update_password')->name('password.update');

    // Task
    Route::resource('task', 'Blog\TaskController');
    Route::get('/task/completed/{id}', 'Blog\TaskController@completed')->name('task.completed');

    // Category
    Route::get('category/delete/{id}', 'Blog\CategoryController@destroy')->name('category.delete');
    Route::resource('category', 'Blog\CategoryController');

    // Tag
    Route::resource('tag', 'Blog\TagController');

    // Message
    Route::get('/message', 'Blog\MessageController@index')->name('message.index');
    // Reply Message
    Route::get('/reply/{id}', 'Blog\MessageController@reply')->name('message.reply');
    Route::post('/reply/{id}', 'Blog\MessageController@replied')->name('message.replied');
    // Delete Message
    Route::get('/delete/{id}', 'Blog\MessageController@delete')->name('message.delete');
    // Readed Message
    Route::get('/readed/{id}', 'Blog\MessageController@readed')->name('message.read');

    // Subscriber
    Route::get('/subscriber', 'Blog\SubscriberController@index')->name('subs.index');

    // Post
    Route::resource('post', 'Blog\PostController');
    // Trashed Post
    Route::get('/trashed_post', 'Blog\PostController@trashed')->name('post.trashed');
    // Restored Post
    Route::get('/restored_post/{id}', 'Blog\PostController@restored')->name('post.restored');
    // Deleted Post Permanently
    Route::get('/killed_post/{id}', 'Blog\PostController@killed')->name('post.killed');
    // Drafted Post
    Route::get('/draft_post/{id}', 'Blog\PostController@drafted')->name('post.draft');

    // Portfolio
    Route::resource('portfolio', 'Blog\PortfolioController');
});

// Tampilan User
Route::get('/', 'Blog\HomeController@welcome')->name('home.welcome');
// Tampilan per post
Route::get('/post/{slug}', 'Blog\HomeController@show')->name('home.show');
// Tampilan per category
Route::get('/category/{slug}', 'Blog\HomeController@category')->name('home.category');
// Tampilan per tag
Route::get('/tag/{slug}', 'Blog\HomeController@tag')->name('home.tag');
// Search Post
Route::get('/search-post', 'Blog\HomeController@search')->name('home.search');
// About
Route::get('/about', 'Blog\HomeController@about')->name('home.about');
// Contact
Route::get('/contact', 'Blog\HomeController@contact')->name('home.contact');
// Contact Email
Route::post('/contact', 'Blog\HomeController@contact_email')->name('home.email');
// Subscription
Route::post('/subs', 'Blog\HomeController@subs')->name('home.subs');
// Portfolio
Route::get('/portfolio', 'Blog\HomeController@portfolio')->name('home.portfolio');

// ============================================ PORTFOLIO ============================================
