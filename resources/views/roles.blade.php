@extends('layouts.master')

@section('menu')
	<div class="col-md-8 offset-md-2 mb-3">
		<ul class="nav nav-pills">
			<li class="nav-item">
    			<a class="nav-link" href="/empleados">Empleados</a>
  			</li>
  			<li class="nav-item">
    			<a class="nav-link active" href="/roles">Roles</a>
  			</li>
		</ul>
	</div>
@endsection

@section('contenido')
	@if($tipoVista == 'lista')
		<div class="col-sm-12 text-center mb-3">
			<h4>Listado de roles <a class="btn btn-sm btn-success" href="/roles/crear"><i class="fa fa-plus"></i></a></h4>
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
				        	<th>Rol</th>
				        	<th>Descripcion</th>
				        	<th>Acciones</th>
				        </tr>
				    </thead>
				    <tbody>
			    		@foreach ($roles as $rol)
				    		<tr>
				    			<td>{{ $rol->nombre }}</td>
				    			<td>{{ $rol->descripcion }}</td>
				    			<td>
				    				<a class="btn btn-sm btn-primary" href="/roles/editar/{{$rol->id}}">
				    					<i class="fa fa-edit"></i>
				    				</a>
				    				<a class="btn btn-sm btn-info" href="asignar-empleado-rol/{{$rol->id}}" title="Asignar rol a empleado(s)">
				    					<i class="fa fa-user"></i>
				    				</a>
				    				<button class="btn btn-sm btn-danger" onclick="eliminarRol({{$rol->id}})">
				    					<i class="fa fa-minus"></i>
				    				</button>
				    			</td>
				    		</tr>
			    		@endforeach
				    </tbody>
		        </table>
			</div>
			<div class="mb-4 mt-2 text-center">
				{{ $roles->links() }}
			</div>
		</div>
		<form method="post" action="/roles/eliminar" id="form-delete">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <input type="hidden" id="idRol" name="idRol">
        </form>

		<script type="text/javascript">
			function eliminarRol(idRol) {
				if(confirm("Deseas eliminar el rol?")) {
					$("#idRol").val(idRol);
			        $("#form-delete").submit();
			    } else {
			        return false;
			    }
			}
		</script>

	@elseif($tipoVista == 'form')
		<div class="col-sm-12 text-center">
			@if($rol->exists)
				<h4>Edita la información del rol.</h4>
			@else
            	<h4>Registra la información del rol.</h4>
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
        		@if($rol->exists)
            	<form method="post" action="/roles/actualizar" id="form-create">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="idRol" value="{{ $rol->id }}">
                @else
	            <form method="post" action="/roles/guardar" id="form-create">
                @endif
	                {{ csrf_field() }}
	                <div class="col-sm-6">
		                <div class="form-group">
		                    <label class="col-sm-4 control-label">Rol</label>
		                    <div class="col-sm-8"><input type="text" name="nombre" class="form-control" value="{{ $rol->nombre ?? old('nombre') }}" required></div>
		                </div>

		                <div class="form-group">
		                    <label class="col-sm-4 control-label">Descripción</label>
		                    <div class="col-sm-8"><textarea name="descripcion" class="form-control">{{ $rol->descripcion ?? old('descripcion') }}</textarea> </div>
		                </div>
		            </div>

		            <div class="text-center mb-4">
		            	<button type="submit" class="btn btn-sm btn-success">Guardar</button>
		            	<a class="btn btn-sm btn-warning" href="/roles">Cancelar</a>
		            </div>
	            </form>
	        </div>
        </div>
	@endif
@endsection