<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $fillable = ['nombre', 'apellido', 'direccion', 'email'];

    public function roles() {
    	return $this->belongsToMany('App\Models\Rol', 'empleado_rol', 'empleado_id', 'rol_id')->withTimestamps();
    }
}
