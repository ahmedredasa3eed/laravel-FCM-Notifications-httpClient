<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\ImagesSliderController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\SubCategoriesController;
use App\Http\Controllers\Backend\TagsController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>'checkAdminLogin','prefix'=>'admin'],function (){
    Route::get('login',[AuthController::class,'login'])->name('admin.login');
    Route::post('login',[AuthController::class,'loginProcess'])->name('admin.login-process');
});



Route::group(['middleware'=>'auth:admin','prefix'=>'admin'],function (){

    Route::get('/logout',[AuthController::class,'logout'])->name('admin.logout');
    Route::get('/',[HomeController::class,'index'])->name('admin.index');

    Route::group(['prefix'=>'categories'],function (){
        Route::get('/',[CategoriesController::class,'index'])->name('categories.index');
        Route::get('/create',[CategoriesController::class,'create'])->name('categories.create');
        Route::post('/store',[CategoriesController::class,'store'])->name('categories.store');
        Route::get('/edit/{category}',[CategoriesController::class,'edit'])->name('categories.edit');
        Route::put('/update/{category}',[CategoriesController::class,'update'])->name('categories.update');
        Route::get('/destroy/{category}',[CategoriesController::class,'destroy'])->name('categories.destroy');
    });

    Route::group(['prefix'=>'subCategories'],function (){
        Route::get('/all/{category}',[SubCategoriesController::class,'index'])->name('sub_categories.index');
        Route::get('/create',[SubCategoriesController::class,'create'])->name('sub_categories.create');
        Route::post('/store',[SubCategoriesController::class,'store'])->name('sub_categories.store');
        Route::get('/edit/{subCategory}',[SubCategoriesController::class,'edit'])->name('sub_categories.edit');
        Route::put('/update/{subCategory}',[SubCategoriesController::class,'update'])->name('sub_categories.update');
        Route::get('/destroy/{subCategory}',[SubCategoriesController::class,'destroy'])->name('sub_categories.destroy');
    });


    Route::group(['prefix'=>'brands'],function (){
        Route::get('/',[BrandsController::class,'index'])->name('brands.index');
        Route::get('/create',[BrandsController::class,'create'])->name('brands.create');
        Route::post('/store',[BrandsController::class,'store'])->name('brands.store');
        Route::get('/edit/{brand}',[BrandsController::class,'edit'])->name('brands.edit');
        Route::put('/update/{brand}',[BrandsController::class,'update'])->name('brands.update');
        Route::get('/destroy/{brand}',[BrandsController::class,'destroy'])->name('brands.destroy');
    });

    Route::group(['prefix'=>'products'],function (){
        Route::get('/',[ProductsController::class,'index'])->name('products.index');
        Route::get('/create',[ProductsController::class,'create'])->name('products.create');
        Route::post('/store',[ProductsController::class,'store'])->name('products.store');
        Route::get('/edit/{product}',[ProductsController::class,'edit'])->name('products.edit');
        Route::put('/update/{product}',[ProductsController::class,'update'])->name('products.update');
        Route::get('/destroy/{product}',[ProductsController::class,'destroy'])->name('products.destroy');
        Route::post('/search',[ProductsController::class,'searchProduct'])->name('products.search');
        Route::get('/changeProductFeaturedStatus/{product}',[ProductsController::class,'changeProductFeaturedStatus'])->name('products.changeProductFeaturedStatus');
    });


    Route::group(['prefix'=>'tags'],function (){
        Route::get('/',[TagsController::class,'index'])->name('tags.index');
        Route::get('/create',[TagsController::class,'create'])->name('tags.create');
        Route::post('/store',[TagsController::class,'store'])->name('tags.store');
        Route::get('/edit/{tag}',[TagsController::class,'edit'])->name('tags.edit');
        Route::put('/update/{tag}',[TagsController::class,'update'])->name('tags.update');
        Route::get('/destroy/{tag}',[TagsController::class,'destroy'])->name('tags.destroy');
    });

    Route::group(['prefix'=>'sliders'],function (){
        Route::get('/',[ImagesSliderController::class,'index'])->name('sliders.index');
        Route::get('/create',[ImagesSliderController::class,'create'])->name('sliders.create');
        Route::post('/store',[ImagesSliderController::class,'store'])->name('sliders.store');
        Route::get('/edit/{slider_id}',[ImagesSliderController::class,'edit'])->name('sliders.edit');
        Route::put('/update/{slider_id}',[ImagesSliderController::class,'update'])->name('sliders.update');
        Route::get('/destroy/{slider_id}',[ImagesSliderController::class,'destroy'])->name('sliders.destroy');
    });

});


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth:admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
