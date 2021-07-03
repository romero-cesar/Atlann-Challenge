<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Empleado;
use App\Models\Rol;

class EmpleadoRolController extends Controller
{
    public function indexEmpleado($empleadoId)
    {
    	return view('empleado_rol', [
    			'tipoVista' => 'asignar_rol',
                'empleado' => Empleado::findOrFail($empleadoId),
                'roles' => Rol::paginate(15)
            ]
        );
    }

    public function asignarRolEmpleado(Request $request)
    {
    	$empleado = Empleado::findOrFail($request->empleadoId);

    	$empleado->roles()->sync($request->rol);

    	return redirect()->back()->with(['mensaje' => 'Se ha modificado exitosamente la información', 'tipo' => 'success']);
    }

    public function indexRol($rolId)
    {
    	return view('empleado_rol', [
    			'tipoVista' => 'asignar_empleado',
                'rol' => Rol::findOrFail($rolId),
                'empleados' => Empleado::paginate(15)
            ]
        );
    }

    public function asignarEmpleadoRol(Request $request)
    {
    	$rol = Rol::findOrFail($request->rolId);

    	$rol->empleados()->sync($request->empleado);

    	return redirect()->back()->with(['mensaje' => 'Se ha modificado exitosamente la información', 'tipo' => 'success']);
    }
}
