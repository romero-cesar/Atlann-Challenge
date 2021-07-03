@extends('layouts.master')

@section('menu')
	<div class="col-md-8 offset-md-2 mb-3">
		<ul class="nav nav-pills">
			<li class="nav-item">
    			<a class="nav-link" href="/empleados">Empleados</a>
  			</li>
  			<li class="nav-item">
    			<a class="nav-link" href="/roles">Roles</a>
  			</li>
		</ul>
	</div>
@endsection

@section('contenido')
	@if($tipoVista == 'asignar_rol')
		<div class="col-sm-12 text-center mb-3">
			<h4>Asignar rol(es) a <b>{{ $empleado->nombre . ' ' . $empleado->apellido }}</b></h4>
		</div>
		<div class="container">
			@if(Session()->has('mensaje'))
				<div class="col-sm-12">
					<div class="alert alert-{{ Session()->get('tipo') }} alert-dismissible fade show" role="alert">
						{{ Session()->get('mensaje') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			@endif
			<div class="col-sm-12 text-center">
				<form method="post" action="/asignar-rol-empleado" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="empleadoId" value="{{ $empleado->id }}">
			        <table class="table table-bordered table-hover">
			        	<thead>
			                <tr>
					        	<th>Rol</th>
					        	<th>Descripcion</th>
					        	<th>Seleccionar</th>
					        </tr>
					    </thead>
					    <tbody>
				    		@forelse ($roles as $rol)
					    		<tr>
					    			<td width="35%">{{ $rol->nombre }}</td>
					    			<td width="35%">{{ $rol->descripcion }}</td>
					    			<td width="30%">
					    				@if ($empleado->roles()->where('rol_id', $rol->id)->first() != null)
					    					<input type="checkbox" name="rol[]" checked="checked" value="{{ $rol->id }}">
					    				@else
					    					<input type="checkbox" name="rol[]" value="{{ $rol->id }}">
					    				@endif
					    			</td>
					    		</tr>
					    	@empty
					    		<tr>
					    			<td colspan="3">No hay roles creados. <a class="btn btn-sm btn-success" href="/roles/crear" title="Crear rol"><i class="fa fa-plus"></i></a></td>
					    		</tr>
				    		@endforelse
					    </tbody>
			        </table>

			        <div class="row text-center mt-4 mb-4">
				        <div class="col-sm-12">
			            	<button type="submit" class="btn btn-sm btn-success">Guardar</button>
			            	<a class="btn btn-sm btn-warning" href="/empleados">Cancelar</a>
			            </div>
			        </div>
			    </form>
			</div>
			<div class="mb-4 mt-2 text-center">
				{{ $roles->links() }}
			</div>
		</div>
	@elseif($tipoVista == 'asignar_empleado')
		<div class="col-sm-12 text-center mb-3">
			<h4>Asignar rol(es) <b>{{ $rol->nombre }}</b> a empleado(s)</h4>
		</div>
		<div class="container">
			@if(Session()->has('mensaje'))
				<div class="col-sm-12">
					<div class="alert alert-{{ Session()->get('tipo') }} alert-dismissible fade show" role="alert">
						{{ Session()->get('mensaje') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			@endif
			<div class="col-sm-12 text-center">
				<form method="post" action="/asignar-empleado-rol" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="rolId" value="{{ $rol->id }}">
			        <table class="table table-bordered table-hover">
			        	<thead>
			                <tr>
					        	<th>Nombre</th>
					        	<th>Apellido</th>
					        	<th>Email</th>
					        	<th>Seleccionar</th>
					        </tr>
					    </thead>
					    <tbody>
				    		@forelse ($empleados as $empleado)
					    		<tr>
					    			<td width="25%">{{ $empleado->nombre }}</td>
					    			<td width="25%">{{ $empleado->apellido }}</td>
					    			<td width="30%">{{ $empleado->email }}</td>
					    			<td width="20%">
					    				@if ($rol->empleados()->where('empleado_id', $empleado->id)->first() != null)
					    					<input type="checkbox" name="empleado[]" checked="checked" value="{{ $empleado->id }}">
					    				@else
					    					<input type="checkbox" name="empleado[]" value="{{ $empleado->id }}">
					    				@endif
					    			</td>
					    		</tr>
					    	@empty
					    		<tr>
					    			<td colspan="3">No hay empleados creados. <a class="btn btn-sm btn-success" href="/empleados/crear" title="Crear empleado"><i class="fa fa-plus"></i></a></td>
					    		</tr>
				    		@endforelse
					    </tbody>
			        </table>

			        <div class="row text-center mt-4 mb-4">
				        <div class="col-sm-12">
			            	<button type="submit" class="btn btn-sm btn-success">Guardar</button>
			            	<a class="btn btn-sm btn-warning" href="/roles">Cancelar</a>
			            </div>
			        </div>
			    </form>
			</div>
			<div class="mb-4 mt-2 text-center">
				{{ $empleados->links() }}
			</div>
		</div>
	@endif
@endsection