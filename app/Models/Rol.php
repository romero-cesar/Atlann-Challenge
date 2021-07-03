<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'descripcion'];

    public function empleados() {
    	return $this->belongsToMany('App\Models\Empleado', 'empleado_rol', 'rol_id', 'empleado_id')->withTimestamps();
    }
}
