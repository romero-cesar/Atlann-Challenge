<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Empleado;

class EmpleadoController extends Controller
{
    public function index() {
    	return view('empleados', [
    			'tipoVista' => 'lista',
                'empleados' => Empleado::paginate(5)
            ]
        );
    }

    public function crear() {
    	return view('empleados', [
    			'tipoVista' => 'from',
                'empleado' => new Empleado()
            ]
        );
    }

    public function guardar(Request $request) {
    	$validarData = Validator::make($request->all(), [
            'nombre'	=> 'required',
            'apellido'  => 'required',
            'email'		=> 'required|unique:empleados,email'
        ], [
        	'nombre.required'	 => 'El campo nombre es obligatorio',
            'apellido.required'  => 'El campo apellido es obligatorio',
            'email.required'	 => 'El campo email es obligatorio',
            'email.unique'		 => 'El email ya se encuentra registrado',
        ]);

        if ($validarData->fails()) {
            return redirect()->back()->withErrors($validarData)->withInput();
        }

        $empleado = new Empleado();
        $empleado->fill($request->all());
        $empleado->save();

        return redirect('empleados')->with(['mensaje' => 'Se ha agregado exitosamente la información del empleado', 'tipo' => 'success']);
    }

    public function editar($empleadoId)
    {
        return view('empleados', [
                'tipoVista' => 'form',
                'empleado' => Empleado::findOrFail($empleadoId)
            ]
        );
    }

    public function actualizar(Request $request) {
    	$empleado = Empleado::findOrFail($request->idEmpleado);
        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->direccion = $request->direccion;
        $empleado->email = $request->email;

		$empleado->save();
        
        return redirect('empleados')->with(['mensaje' => 'Se ha actualizado exitosamente la información del empleado', 'tipo' => 'success']);
    }
}
