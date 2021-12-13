<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NegocioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PaqueteController;
use App\Http\Controllers\ProductoController;

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


Route::get('mail', function () {
    return view('mails.register');
});

Route::get('registro', [App\Http\Controllers\HomeController::class, 'registro']);
Route::post('registro', [App\Http\Controllers\HomeController::class, 'register']);

Route::get('confirmation/{param}', [App\Http\Controllers\HomeController::class, 'verify']);


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('categorias', [App\Http\Controllers\HomeController::class, 'pageCategorias']);
Route::get('recomendados', [App\Http\Controllers\HomeController::class, 'recomendados']);
Route::get('anuncio/detalle/{id}', [App\Http\Controllers\HomeController::class, 'detalle']);
Route::get('detalleanuncio/{id}', [App\Http\Controllers\HomeController::class, 'detalleanuncio']);

Route::get('destacados', [App\Http\Controllers\HomeController::class, 'destacados']);

Route::post('catsnego', [HomeController::class, 'categoriasAndNegocios']);
Route::get('negocioscat/{id}', [HomeController::class, 'negociosCat']);

Route::get('home/categorias', [HomeController::class, 'categoriasActive']);
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('categorias/home/negocios/{param}', [HomeController::class, 'negocios']);
Route::get('home/negocios/{param}', [HomeController::class, 'homeNegociosCategoria']);
Route::get('anuncios', [HomeController::class, 'pageAnuncios']);
Route::get('resultados', [HomeController::class, 'resultados']);
Route::post('buscar', [HomeController::class, 'buscar']);

Auth::routes(['register' => false]);


Route::prefix('admin')->group(function () {
    
    Route::get('/', [AdminController::class,'index'])->middleware('rol:admin');
    Route::resource('/categorias', CategoriaController::class)->middleware('rol:admin');
    Route::get('/catlist', [CategoriaController::class, 'adminCategorias'])->middleware('rol:admin');
    Route::resource('/usuarios', UsuarioController::class)->middleware('rol:admin');
    Route::post('/usuarios/list', [UsuarioController::class, 'allUsers'])->middleware('rol:admin');    
    Route::resource('/negocios', NegocioController::class)->middleware('rol:admin');
    Route::get('/neglist', [NegocioController::class, 'adminNegocios'])->middleware('rol:admin');
    Route::post('/lista/negocios', [NegocioController::class, 'adminNegocios2'])->middleware('rol:admin');
    Route::get('/files/{filename}', [FileController::class, 'archivo'])->middleware('rol:admin');    
    Route::get('/images/{filename}', [FileController::class,'displayImage'])->middleware('rol:admin');
    Route::post('/files',[FileController::class,'imageUpload']);
    Route::get('/files/delete/{filename}', [FileController::class,'deleteFile'])->middleware('rol:admin');
    Route::resource('/paquetes', PaqueteController::class)->middleware('rol:admin');
    Route::get('/paqlist', [PaqueteController::class, 'adminPaquetes'])->middleware('rol:admin');
    Route::get('/anuncios', [AdminController::class, 'anuncios'])->middleware('rol:admin');
    Route::post('/lista/anuncios', [AdminController::class, 'allanuncios'])->middleware('rol:admin');
    Route::put('/anuncios/state/{id}', [AdminController::class, 'changestate'])->middleware('rol:admin');
});

Route::prefix('user')->group(function () {
    Route::get('/', [ClientController::class,'index'])->middleware('rol:client');
    Route::get('/negocio', [ClientController::class,'negocio'])->middleware('rol:client');
    Route::get('/minegocio', [ClientController::class,'minegocio'])->middleware('rol:client');
    Route::post('/updatenegocio/{id}', [ClientController::class,'actualizar'])->middleware('rol:client');
    Route::post('/negocio/file/{id}', [ClientController::class,'actualizarImagen'])->middleware('rol:client');
    /* COMPRAS */
    //Route::get('/', [PaqueteController::class,'index']);
    Route::get('/mipaquete', [ClientController::class,'mipaquete'])->middleware('rol:client');
    //Route::get('/compras', [ClientController::class,'comprar']);

    Route::post('/paquetes/add', [ClientController::class,'agregar'])->middleware('rol:client');
    Route::post('/files/anuncio', [FileController::class,'fotoUpload'])->middleware('rol:client');
    Route::post('/anuncios/crear', [ClientController::class, 'createAnuncio'])->middleware('rol:client');
    Route::get('/anuncios', [ClientController::class, 'anuncios'])->middleware('rol:client');
    /*PRUEBA*/
    /*Route::get('/paquetelist', [ClientController::class, 'userPaquetes']);*/
    /* PAGINAR ANUNCIOS */
    Route::post('/lista/anuncios', [ClientController::class, 'clientAnuncios'])->middleware('rol:client');
     /* PARA PRODUCTOS */
    Route::post('/lista/productos', [ClientController::class, 'clientProductos'])->middleware('rol:client');
    Route::get('/productos', [ClientController::class,'productos'])->middleware('rol:client');
    Route::get('/prodlist', [ClientController::class, 'clientProductos'])->middleware('rol:client');
    Route::post('/productos/crear', [ClientController::class, 'createProducto'])->middleware('rol:client');
    Route::post('/productos/actualizar/{id}', [ClientController::class, 'updateProducto'])->middleware('rol:client');    
});
//para paginar los anuncios
Route::post('negoanuncios', [HomeController::class, 'negociosAndAnuncios']);

