@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Profesores")

@switch(Auth::user()->type)
	@case(1)
		@section('body')
		@break
	@case(2)
		@section('bodyUsuario')
		@break
	@case(3)
		@section('bodyStudent')
		@break
	@case(4)
		@section('bodyTeacher')
		@break
	@case(5)
		@section('bodyTutor')
		@break
	@case(6)
		@section('bodyUserSalud')
		@break
	@case(7)
		@section('bodyUserPsicologia')
		@break
@endswitch
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-table bg-c-green"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Profesores</h4>
						<span style="text-transform: none;">Lista de los profesores que tienen acceso al sistema.</span>
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
						<li class="breadcrumb-item">Profesores
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
							<table id="custom_datatable" style="width:100%" class="table table-striped table-bordered">
								@if ($teachers->isNotEmpty())
									<thead id="table_header">
										<tr>
											<th class="all" scope="col">Num. Empleado</th>
											<th scope="col">Nombre Completo</th>
											<th scope="col">Email</th>
											<th scope="col">Carrera</th>
											<th class="all" scope="col" style="width:28%;">Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($teachers as $teacher)
											<tr>
												@if($teacher->deleted=='0')
													<th scope="row">{{ $teacher->university_id }}</th>
													<td>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</td>
													<td>{{ $teacher->email }}</td>
													<td>{{ $teacher->career_abbreviation }}</td>
												@else
													<th style="color:red" scope="row">{{ $teacher->university_id }}</th>
													<td style="color:red">{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</td>
													<td style="color:red">{{ $teacher->email }}</td>
													<td style="color:red">{{ $teacher->career_abbreviation }}</td>
												@endif
												<td>
												@if($teacher->deleted=='0')
													<form id="form" name="form" action="{{ route('teachers.destroy', ['id' => $teacher->user_id]) }}" method="POST">
														{{ csrf_field() }}
														{{ method_field('DELETE') }}
												@else
													<form id="form" name="form" action="{{ route('teachers.restore', ['id' => $teacher->user_id]) }}" method="POST">
														{{ csrf_field() }}
												@endif
														<center>
															<a href="{{ route('teachers.show', ['id' => $teacher->university_id]) }}" class="btn btn-warning" title="Ver detalles del profesor con el num. de empleado {{ $teacher->university_id }}" style="margin: 1px;"><span class="icofont icofont-eye-alt"></span></a>
															<a href="{{ route('teachers.edit', ['id' => $teacher->user_id]) }}" class="btn btn-primary" title="Editar profesor con el num. de empleado {{ $teacher->university_id }}" style="margin: 1px;"><span class="icofont icofont-ui-edit"></span></a>
															<a href="{{ route('tutors.create', ['id' => $teacher->user_id]) }}" class="btn btn-info" title="Asignar el profesor con el id {{ $teacher->university_id }} como tutor" style="margin: 1px;"><i class="fas fa-level-up-alt"></i></span></a>

															@if($teacher->deleted=='0')
																<button type="submit" class="btn btn-danger" style="margin: 1px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar el profesor con el num. de empleado {{ $teacher->university_id }}"><span class="icofont icofont-ui-delete"></span></button>
															@else
																<button type="submit" class="btn btn-success" style="margin: 1px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar el profesor con el num. de empleado {{ $teacher->university_id }}"><span class="fas fa-reply"></span></a></button>
															@endif

														</center>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr id="table_footer">
											<th style="padding-right: 2.8%" scope="col">Num. Empleado</th>
											<th style="padding-right: 2.8%" scope="col">Nombre Completo</th>
											<th style="padding-right: 2.8%" scope="col">Email</th>
											<th style="padding-right: 2.8%" scope="col">Carrera</th>
											<th style="padding-left: 2.0%" scope="col" style="width:0%;"></th>
										</tr>
									</tfoot>
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Atención</strong>
											<p>No hay ningun profesor registrado.</p>
										</div>
										<a href="{{ route('teachers.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-user-plus"></i>Agregar Profesor</button></a>
									</center>
								@endif

							</table>
						</div>
					</div>
				</div>
				<!-- Zero config.table end -->
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascriptcode')
<script>
	var button = '<a href="{{ route('teachers.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-user-plus"></i>Agregar Profesor</button></a>';
	applyStyleToDatatable(button, 'Buscar en profesores...');
</script>
@endsection
