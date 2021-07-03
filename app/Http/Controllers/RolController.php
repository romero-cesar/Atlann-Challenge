<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Rol;

class RolController extends Controller
{
    public function index() {
    	return view('roles', [
    			'tipoVista' => 'lista',
                'roles' => Rol::paginate(5)
            ]
        );
    }

    public function crear() {
    	return view('roles', [
    			'tipoVista' => 'form',
                'rol' => new Rol()
            ]
        );
    }

    public function guardar(Request $request) {
    	$validarData = Validator::make($request->all(), [
            'nombre'	=> 'required'
        ], [
        	'nombre.required'	 => 'El campo nombre es obligatorio',
        ]);

        if ($validarData->fails()) {
            return redirect()->back()->withErrors($validarData)->withInput();
        }

        $rol = new Rol();
        $rol->fill($request->all());
        $rol->save();

        return redirect('roles')->with(['mensaje' => 'Se ha agregado exitosamente la información del rol', 'tipo' => 'success']);
    }

    public function editar($rolId)
    {
        return view('roles', [
                'tipoVista' => 'form',
                'rol' => Rol::findOrFail($rolId)
            ]
        );
    }

    public function actualizar(Request $request) {
    	$rol = Rol::findOrFail($request->idRol);
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;

		$rol->save();
        
        return redirect('roles')->with(['mensaje' => 'Se ha actualizado exitosamente la información del rol', 'tipo' => 'success']);
    }

    public function eliminar(Request $request) {
    	$rol = Rol::findOrFail($request->idRol);

    	$rol->roles()->sync([]);
    	$rol->delete();

    	return redirect('roles')->with(['mensaje' => 'Se ha eliminado exitosamente la información del rol', 'tipo' => 'success']);
    }
}
