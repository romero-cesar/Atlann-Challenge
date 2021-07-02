@extends('layouts.master')

@section('contenido')
	@if($tipoVista == 'lista')
		<div class="col-sm-12 text-center">
			<h4>Listado de empleados <a class="btn btn-sm btn-success" href="{{ 'empleados/crear' }}"><i class="fa fa-plus"></i></a></h4>
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
		        <table class="table table-bordered table-hover">
		        	<thead>
		                <tr>
				        	<th>Nombre</th>
				        	<th>Apellido</th>
				        	<th>Direccion</th>
				        	<th>Correo</th>
				        	<th>Acciones</th>
				        </tr>
				    </thead>
				    <tbody>
			    		@foreach ($empleados as $empleado)
				    		<tr>
				    			<td>{{ $empleado->nombre }}</td>
				    			<td>{{ $empleado->apellido }}</td>
				    			<td>{{ $empleado->direccion }}</td>
				    			<td>{{ $empleado->email }}</td>
				    			<td>
				    				<a class="btn btn-sm btn-primary" href="/empleados/editar/{{$empleado->id}}">
				    					<i class="fa fa-edit"></i>
				    				</a>
				    				<button class="btn btn-sm btn-danger">
				    					<i class="fa fa-minus"></i>
				    				</button>
				    			</td>
				    		</tr>
			    		@endforeach
				    </tbody>
		        </table>
			</div>
			<div class="mb-4 mt-2 text-center">
				{{ $empleados->links() }}
			</div>
		</div>

		<script type="text/javascript">
			
		</script>

	@elseif($tipoVista == 'form'))
		<div class="col-sm-12 text-center">
			@if($empleado->exists)
				<h4>Edita la información del empleado.</h4>
			@else
            	<h4>Registra la información del empleado.</h4>
            @endif
        </div>
		<div class="container">
			@if($errors->any())
				<div class="col-sm-12">
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<p>Corrige los siguientes errores:</p>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</div>
			@endif
        	<div class="col-sm-12">
        		@if($empleado->exists)
            	<form method="post" action="/empleados/actualizar" id="form-create">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="idEmpleado" value="{{ $empleado->id }}">
                @else
	            <form method="post" action="/empleados/guardar" id="form-create">
                @endif
	                {{ csrf_field() }}
	                <div class="col-sm-6">
		                <div class="form-group">
		                    <label class="col-sm-4 control-label">Nombre</label>
		                    <div class="col-sm-8"><input type="text" name="nombre" class="form-control" value="{{ $empleado->nombre ?? old('nombre') }}" required></div>
		                </div>

		                <div class="form-group">
		                    <label class="col-sm-4 control-label">Apellido</label>
		                    <div class="col-sm-8"><input name="apellido" class="form-control" value="{{ $empleado->apellido ?? old('apellido') }}"></div>
		                </div>
		            </div>

	                <div class="col-sm-6">
		                <div class="form-group">
		                    <label class="col-sm-4 control-label">Email</label>
		                    <div class="col-sm-8"><input type="email" name="email" class="form-control" value="{{ $empleado->email ?? old('email') }}" required></div>
		                </div>

		                <div class="form-group">
		                    <label class="col-sm-4 control-label">Dirección</label>
		                    <div class="col-sm-8"><textarea name="direccion" class="form-control">{{ $empleado->direccion ?? old('direccion') }}</textarea> </div>
		                </div>
		            </div>

		            <div class="text-center mb-4">
		            	<button type="submit" class="btn btn-sm btn-success">Guardar</button>
		            	<a class="btn btn-sm btn-warning" href="/">Cancelar</a>
		            </div>
	            </form>
	        </div>
        </div>
	@endif
@endsection