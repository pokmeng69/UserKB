<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Login;
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
//login
Route::get('/', [Login::class, 'Login']);
//layout Home
Route::get('/Home', [AdminController::class, 'HomeAdmin']);

//register
Route::get('/reg', [Login::class, 'Reg']);

//get category
Route::get('/AddCategory', [AdminController::class, 'ViewCategory']);
//get article
Route::get('/AddArticle', [AdminController::class, 'ViewArticle']);
Route::get('/ViewAllArticle', [AdminController::class, 'ViewAllArticle']);

//Create
//Category Create
Route::post('AddCategory', [AdminController::class, 'AddCategory']);
//Article Create
Route::post('AddArticle', [AdminController::class, 'AddArticle']);

//Update
//Update Category
Route::get('/category/edit/{id}', [AdminController::class, 'ViewEditCategory']);
Route::match(array('GET','POST'), '/category/postedit', [AdminController::class, 'PostEditCategory']);
//Update article
Route::get('/article/edit/{id}', [AdminController::class, 'ViewEditArticle']);
Route::match(array('GET','POST'), '/article/postedit', [AdminController::class, 'PostEditArticle']);

//edit article
Route::get('/EditArticle{id}', [AdminController::class, 'EditArticle'])->name('EditArticle.show');

//Delete
Route::get('/category/delete/{id}',[AdminController::class, 'DeleteCategory']);
Route::get('/article/delete/{id}',[AdminController::class, 'DeleteArticle']);

Route::match(array('GET','POST'),'ckeditor/upload', [AdminController::class, 'uploadImage'])->name('ckeditor.upload');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
