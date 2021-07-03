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

    Route::delete('/eliminar', [
        'uses' => 'EmpleadoController@eliminar',
        'as' => 'eliminar'
        ]
    );
});

Route::group(['prefix' => 'roles'], function() {
	Route::get('/', [
	    'uses' => 'RolController@index',
	    'as' => 'index'
	    ]
	);

    Route::get('/crear', [
        'uses' => 'RolController@crear',
        'as' => 'crear'
        ]
    );

    Route::post('/guardar', [
        'uses' => 'RolController@guardar',
        'as' => 'guardar'
        ]
    );

    Route::get('/editar/{rolId}', [
        'uses' => 'RolController@editar',
        'as' => 'editar'
        ]
    );

    Route::put('/actualizar', [
        'uses' => 'RolController@actualizar',
        'as' => 'actualizar'
        ]
    );

    Route::delete('/eliminar', [
        'uses' => 'RolController@eliminar',
        'as' => 'eliminar'
        ]
    );
});

Route::get('/asignar-rol-empleado/{empleadoId}', [
	'uses' => 'EmpleadoRolController@indexEmpleado',
	'as' => 'indexEmpleado'
]);

Route::get('/asignar-empleado-rol/{rolId}', [
	'uses' => 'EmpleadoRolController@indexRol',
	'as' => 'indexRol'
]);

Route::post('/asignar-rol-empleado', [
	'uses' => 'EmpleadoRolController@asignarRolEmpleado',
	'as' => 'asignarRolEmpleado'
]);

Route::post('/asignar-empleado-rol', [
	'uses' => 'EmpleadoRolController@asignarEmpleadoRol',
	'as' => 'asignarEmpleadoRol'
]);