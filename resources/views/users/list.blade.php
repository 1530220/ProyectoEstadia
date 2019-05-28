@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Usuarios")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-table" style="background-color:#ab7967"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Usuarios</h4>
						<span style="text-transform: none;">Lista de todos los usuarios (administradores, alumnos, profesores y tutores) registrados en el sistema.</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class="breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">
								<i class="icofont icofont-home"></i>
							</a>
						</li>
						<li class="breadcrumb-item">Usuarios
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Page-header end -->

	<!-- Page-body start -->
	<div class="page-body">
		<div class="row">
			<div class="col-sm-12">
				<!-- Zero config.table start -->
				<div class="card">
					<div class="card-block">
						<div class="dt-responsive table-responsive">
							<table style="width:100%" id="custom_datatable" class="table table-striped table-bordered">
								@if ($users->isNotEmpty())

								<thead id="table_header">
									<tr>
										<th class="all" scope="col" style="width:10%;">ID</th>
										<th scope="col" style="width:10%;">Num. Empleado</th>
										<th scope="col" style="width:20%;">Nombre Completo</th>
										<th scope="col" style="width:20%;">Email</th>
										<th scope="col" style="width:10%;">Tipo</th>
										<th class="all" scope="col" style="width:30%;">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($users as $user)
									<tr>
										@if($user->deleted=='0')
										<th scope="row">{{ $user->id }}</th>
										<th scope="row">{{ $user->university_id }}</th>
										<td>{{ $user->title }} {{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}</td>
										<td>{{ $user->email }}</td>
											@switch($user->type)
												@case(1)
												<td>Administrador</td>
												@break
												@case(2)
												<td>Empleado</td>
												@break
												@case(3)
												<td>Alumno</td>
												@break
												@case(4)
												<td>Profesor</td>
												@break
												@case(5)
												<td>Tutor</td>
												@break
												@case(6)
												<td>Empleado de Salud</td>
												@break
												@case(7)
												<td>Empleado de Psicología</td>
												@break
												@endswitch
										@else
											<th style="color:red;" scope="row">{{ $user->id }}</th>
											<th style="color:red;" scope="row">{{ $user->university_id }}</th>
											<td style="color:red;">{{ $user->title }} {{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}</td>
											<td style="color:red;">{{ $user->email }}</td>
												@switch($user->type)
													@case(1)
													<td style="color:red;">Administrador</td>
													@break
													@case(2)
													<td style="color:red;">Empleado</td>
													@break
													@case(3)
													<td style="color:red;">Alumno</td>
													@break
													@case(4)
													<td style="color:red;">Profesor</td>
													@break
													@case(5)
													<td style="color:red;">Tutor</td>
													@break
													@case(6)
													<td style="color:red;">Empleado de Salud</td>
													@break
													@case(7)
													<td style="color:red;">Empleado de Psicología</td>
													@break
													@endswitch
										@endif
											<td>
												@if($user->deleted=='0')
												<form id="form" name="form" action="{{ route('users.destroy', ['id' => $user->id])}}" method="POST">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
												@else
													<form id="form" name="form" action="{{ route('users.restore', ['id' => $user->id]) }}" method="POST">
														{{ csrf_field() }}
												@endif
													<center>
														@if ($user->id == Auth::user()->id)
															<a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-warning" title="Ver detalles del usuario con el id {{ $user->university_id }}" style="margin: 3px;"><span class="icofont icofont-eye-alt"></span></a>
															<a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary" title="Editar el usuario con el id {{ $user->university_id }}" style="margin: 3px;"><span class="icofont icofont-ui-edit"></span></a>
														@else
															<a href="{{ route('users.show', ['id' => $user->id]) }}" class="btn btn-warning" title="Ver detalles del usuario con el id {{ $user->university_id }}" style="margin: 3px;"><span class="icofont icofont-eye-alt"></span></a>
															<a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-primary" title="Editar el usuario con el id {{ $user->university_id }}" style="margin: 3px;"><span class="icofont icofont-ui-edit"></span></a>
															@if($user->deleted=='0')
																<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar el usuario con el id {{ $user->university_id }}"><span class="icofont icofont-ui-delete"></span></button>
															@else
																<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar el usuario con el id {{ $user->university_id }}"><span class="fas fa-reply"></span></a>
															@endif
														@endif
													</center>
												</form>
											</td>
									</tr>
									@endforeach
								</tbody>
								@else
								<center>
										<p>Actualmente no hay usuarios registrados.</p>
								</center>
								@endif
								<tfoot>
									<tr id="table_footer">
										<th style="padding-right: 2.8%" scope="col">ID</th>
										<th style="padding-right: 2.8%" scope="col">Nombre Completo</th>
										<th style="padding-right: 2.8%" scope="col">Num. Empleado</th>
										<th style="padding-right: 2.8%" scope="col">Email</th>
										<th style="padding-right: 2.8%" scope="col">Tipo</th>
										<th style="padding-left: 3.2%" scope="col" style="width:0%;"></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascriptcode')
<script>
	var button='<a href="{{ route('users.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-user-plus"></i>Agregar Usuario</button></a>';
	applyStyleToDatatable(button, 'Buscar en usuarios....');
</script>
@endsection
