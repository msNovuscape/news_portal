<?php

use App\Models\Language;
use Illuminate\Support\Facades\Route;

if (Session()->has('language')) {
} else{
    $language_id = 0;
    $lang = Language::select('id')->where('defa', 1)->first();
    if (isset($lang->id))
    {
        $language_id = $lang->id;
    }
    session(['language' => $language_id]);
}
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
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'admin\AdminController@dashboard');
    Route::get('/dashboard', ['as'=>'admin.dashboard','uses'=>'admin\AdminController@dashboard']);

    Route::get('/setting', 'admin\SettingController@index');
    Route::get('/setting/edit/{id}', 'admin\SettingController@edit');
    Route::post('/setting/update', 'admin\SettingController@update');

    Route::get('/user', 'admin\UserController@index');
    Route::get('/user/addnew', 'admin\UserController@create');
    Route::post('/user/save', 'admin\UserController@store');
    Route::get('/user/delete/{id}', 'admin\UserController@destroy');
    Route::get('/user/edit/{id}', 'admin\UserController@edit');
    Route::post('/user/update', 'admin\UserController@update');

    Route::get('/usergroup', 'admin\UserGroupController@index');
    Route::get('/usergroup/addnew', 'admin\UserGroupController@create');
    Route::post('/usergroup/save', 'admin\UserGroupController@store');
    Route::get('/usergroup/delete/{id}', 'admin\UserGroupController@destroy');
    Route::get('/usergroup/edit/{id}', 'admin\UserGroupController@edit');
    Route::post('/usergroup/update', 'admin\UserGroupController@update');
    Route::get('/usergroup/autocomplete', 'admin\UserGroupController@autocomplete');

    Route::get('/language', 'admin\LanguageController@index');
    Route::get('/language/addnew', 'admin\LanguageController@create');
    Route::post('/language/save', 'admin\LanguageController@store');
    Route::get('/language/delete/{id}', 'admin\LanguageController@destroy');
    Route::get('/language/edit/{id}', 'admin\LanguageController@edit');
    Route::post('/language/update', 'admin\LanguageController@update');

    Route::get('/layout', 'admin\LayoutController@index');
    Route::get('/layout/addnew', 'admin\LayoutController@create');
    Route::post('/layout/save', 'admin\LayoutController@store');
    Route::get('/layout/delete/{id}', 'admin\LayoutController@destroy');

    Route::get('/menu', 'admin\MenuController@index');
    Route::get('/menu/addnew', 'admin\MenuController@create');
    Route::post('/menu/save', 'admin\MenuController@store');
    Route::get('/menu/delete/{id}', 'admin\MenuController@destroy');
    Route::get('/menu/edit/{id}', 'admin\MenuController@edit');
    Route::post('/menu/update', 'admin\MenuController@update');
    Route::get('/menu/autocomplete', 'admin\MenuController@autocomplete');


    Route::get('/article', 'admin\ArticleController@index');
    Route::get('/article/addnew', 'admin\ArticleController@create');
    Route::post('/article/save', 'admin\ArticleController@store');
    Route::get('/article/delete/{id}', 'admin\ArticleController@destroy');
    Route::get('/article/edit/{id}', 'admin\ArticleController@edit');
    Route::post('/article/update', 'admin\ArticleController@update');
    Route::get('/article/autocomplete', 'admin\ArticleController@autocomplete');
    Route::post('/article/removeFile', 'admin\ArticleController@removefile');

    Route::get('/comment/{id}', 'admin\CommentController@index');




    Route::get('/modules', 'admin\ModuleController@index');
    Route::get('/module/addnew/{page}', 'admin\ModuleController@addnew');
    Route::post('/module/save', 'admin\ModuleController@save');

    Route::get('/module/delete/{id}', 'admin\ModuleController@delete');
    Route::get('/module/edit/{id}', 'admin\ModuleController@edit');
    Route::post('/module/update', 'admin\ModuleController@update');

    Route::get('/module/display/{id}', 'admin\ModuleController@display');
    Route::post('/module/display/save', 'admin\ModuleController@displaySave');

    Route::get('/advertise', 'admin\AdvertiseController@index');
    Route::get('/advertise/addnew', 'admin\AdvertiseController@create');
    Route::post('/advertise/save', 'admin\AdvertiseController@store');
    Route::get('/advertise/delete/{id}', 'admin\AdvertiseController@destroy');
    Route::get('/advertise/edit/{id}', 'admin\AdvertiseController@edit');
    Route::post('/advertise/update', 'admin\AdvertiseController@update');
});



Route::get('/', 'front\HomeController@index');
Route::get('/change_language/{id}', 'front\HomeController@changeLanguage');

Route::get('admin/login', 'admin\AdminLoginController@getLogin')->name('login');
Route::post('admin/login', 'admin\AdminLoginController@adminAuth')->name('post_login');
Route::post('comment/save', 'front\CommentController@store')->name('store_comment');

Route::get('logout', 'admin\AdminLoginController@logOut')->name('lotout');


Route::get('/admin/filemanager', 'FileController@index');
Route::post('/admin/filemanager/upload', 'FileController@upload');
Route::post('/admin/filemanager/folder', 'FileController@folder');
Route::get('/admin/filemanager/delete', 'FileController@delete');
Route::get('/admin/filemanager/select_multiple', 'FileController@select_multiple');
Route::get('/article/{seo_url}', 'front\ArticleController@index');
Route::get('/{seo_url}', 'front\MenuController@index');
