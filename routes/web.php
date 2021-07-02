<?php

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
	return redirect('empleados');
    //return view('welcome');
});

Route::group(['prefix' => 'empleados'], function() {
	Route::get('/', [
	    'uses' => 'EmpleadoController@index',
	    'as' => 'index'
	    ]
	)->name('index_empleado');

    Route::get('/crear', [
        'uses' => 'EmpleadoController@crear',
        'as' => 'crear'
        ]
    );

    Route::post('/guardar', [
        'uses' => 'EmpleadoController@guardar',
        'as' => 'guardar'
        ]
    );

    Route::get('/editar/{empleadoId}', [
        'uses' => 'EmpleadoController@editar',
        'as' => 'editar'
        ]
    );

    Route::put('/actualizar', [
        'uses' => 'EmpleadoController@actualizar',
        'as' => 'actualizar'
        ]
    );

    Route::delete('/{empleadoId}', [
        'uses' => 'EmpleadoController@eliminar',
        'as' => 'eliminar'
        ]
    );
});
