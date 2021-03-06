<?php


use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
//    return redirect()->route('category.show', ['slug'=>'books']);
});


Route::prefix('basics')->group(function (){

    Route::get('/merhaba', function () {
        return "Merhaba API";
    });

    Route::get('/merhaba-json', function () {
        return ['message'=> "Merhaba API"];
    });

    Route::get('/merhaba-json2', function () {
        return response(['message'=> "Merhaba API"],200)
            ->header('Content-Type','application/json');
    });

    Route::get('/merhaba-json3', function () {
        return response()->json(['message'=> "Merhaba API"]);
    });

    Route::get('/product/{id}/{type?}', function ($id,$r_type = 'tumu') {
        return "Product Id: .$id, Type:: $r_type";
    });

    Route::get('/category/{slug}', function ($slug) {
        return "Product Slug: $slug";
    })->name('category.show');
});

//Route::get('/product/{id}/{type?}', 'ProductController@show')->name('product.show');

Route::resource('/products','ProductController');



Route::get('/secured', function () {
    return "You are authenticatred";
})->middleware('auth');





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
