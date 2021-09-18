<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\ConfigController;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/
Route::get('site-bakimda',function(){
    return view('front.widgets.offline');
});

Route::get('/',[Homepage::class,'index'])->name('homepage');
Route::get('/sayfa',[Homepage::class,'index']);
Route::get('/iletisim',[Homepage::class,'contact'])->name('contact');
Route::post('/iletisim',[Homepage::class,'contactpost'])->name('contact.post');
Route::get('/blog/{category}/{slug}',[Homepage::class,'single'])->name('single');
Route::get('/kategori/{category}',[Homepage::class,'category'])->name('category');
Route::get('/{slug}',[Homepage::class,'page'])->name('page');
/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function ()
{
    Route::get('giris',[AuthController::class,'login'])->name('login');
    Route::post('giris',[AuthController::class,'loginPost'])->name('login.post');
});


Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function ()
{
    Route::get('panel',[Dashboard::class,'index'])->name('dashboard');
    Route::get('cikis',[AuthController::class,'logout'])->name('logout');
    //MAKALE
    Route::get('switch',[ArticleController::class,'switch'])->name('switch');
    Route::get('deletearticle/{id}',[ArticleController::class,'delete'])->name('delete.article');
    Route::get('harddeletearticle/{id}',[ArticleController::class,'hardDelete'])->name('hard.delete.article');
    Route::get('recoverarticle/{id}',[ArticleController::class,'recover'])->name('recover.article');
    Route::get('makaleler/silinenler',[ArticleController::class,'trashed'])->name('trashed.article');
    Route::resource('makaleler',ArticleController::class);
    //KATEGORİ
    Route::get('kategoriler',[CategoryController::class,'index'])->name('category.index');
    Route::get('kategori/status',[CategoryController::class,'switch'])->name('category.switch');
    Route::post('kategori/create',[CategoryController::class,'create'])->name('category.create');
    Route::post('kategori/update',[CategoryController::class,'update'])->name('category.update');
    Route::post('kategori/delete',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('kategori/getData',[CategoryController::class,'getData'])->name('category.getData');
    //SAYFALAR
    Route::get('sayfalar',[PageController::class,'index'])->name('page.index');
    Route::get('sayfalar/olustur',[PageController::class,'create'])->name('page.create');
    Route::post('sayfalar/olustur',[PageController::class,'post'])->name('page.post');
    Route::get('sayfalar/guncelle/{id}',[PageController::class,'update'])->name('page.update');
    Route::post('sayfalar/guncelle/{id}',[PageController::class,'updatePost'])->name('page.update.post');
    Route::get('sayfalar/sil/{id}',[PageController::class,'delete'])->name('page.delete');
    Route::get('sayfalar/siralama',[PageController::class,'order'])->name('page.order');
    Route::get('sayfalar/switch',[PageController::class,'switch'])->name('page.switch');
    //AYARLAR
    Route::get('ayarlar',[ConfigController::class,'index'])->name('config.index');
    Route::post('ayarlar/update',[ConfigController::class,'update'])->name('config.update');

});
