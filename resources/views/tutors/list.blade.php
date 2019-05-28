@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Tutores")

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
						<h4 style="text-transform: none;">Listado de Tutores</h4>
						<span style="text-transform: none;">Lista de todos los tutores que estan registrados en el sistema.</span>
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
						<li class="breadcrumb-item">Tutores
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
											<th class="all" scope="col" style="width:5%;">Num. Empleado</th>
											<th scope="col" style="width:30%;">Nombre Completo</th>
											<th scope="col" style="width:15%;">Email</th>
											<th scope="col" style="width:10%;">Carrera</th>
											<th scope="col" style="width:0%;">Cantidad Tutorados</th>
											<th class="all" scope="col" style="width:45%;">Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($teachers as $tutor)
											<tr>
												@if($tutor->deleted=='0')
													<th scope="row">{{ $tutor->university_id }}</th>
													<td>{{ $tutor->title }} {{ $tutor->first_name }} {{ $tutor->last_name }} {{ $tutor->second_last_name }}</td>
													<td>{{ $tutor->email }}</td>
													@if($tutor->career_abbreviation!="Sin Asignar")
														<td>{{ $tutor->career_abbreviation }}</td>
													@else
														<td style="color:red">{{ $tutor->career_abbreviation }}</td>
													@endif
													@if($tutor->num_tutorados==0)
														<td style="color:red">{{ $tutor->num_tutorados }}</td>
													@else
														<td><a href="{{ route('tutors.tutorados', ['id' => $tutor->user_id]) }}">{{ $tutor->num_tutorados }}</a></td>
													@endif
												@else
													<th style="color:red" scope="row">{{ $tutor->university_id }}</th>
													<td style="color:red">{{ $tutor->title }} {{ $tutor->first_name }} {{ $tutor->last_name }} {{ $tutor->second_last_name }}</td>
													<td style="color:red">{{ $tutor->email }}</td>
													<td style="color:red">{{ $tutor->career_abbreviation }}</td>
													<td style="color:red">{{ $tutor->num_tutorados }}</td>
												@endif
												<td>
													@if($tutor->deleted=='0')
														<form id="form" name="form" action="{{ route('tutors.destroy', ['id' => $tutor->user_id]) }}" method="POST">
															{{ csrf_field() }}
															{{ method_field('DELETE') }}
													@else
														<form id="form" name="form" action="{{ route('tutors.restore', ['id' => $tutor->user_id]) }}" method="POST">
															{{ csrf_field() }}
													@endif
														<center>
															<a href="{{ route('tutors.show', ['id' => $tutor->university_id]) }}" class="btn btn-warning" title="Ver detalles del tutor con el num. de empleado {{ $tutor->university_id }}" style="margin: 1px;"><span class="icofont icofont-eye-alt"></span></a>
															@if(Auth::user()->type==1 || Auth::user()->type==2)
																<a href="{{ route('tutors.edit', ['id' => $tutor->user_id]) }}" class="btn btn-primary" title="Editar tutor con el num. de empleado {{ $tutor->university_id }}" style="margin: 1px;"><span class="icofont icofont-ui-edit"></span></a>
																<a href="{{ route('tutors.tutorados', ['id' => $tutor->user_id]) }}" class="btn btn-purple" title="Ver todos los tutorados del tutor con el num. de empleado {{ $tutor->university_id }}" style="margin: 1px;"><span style="color:white;" class="icofont icofont-users"></span></a>
																@if($tutor->deleted=='0')
																	<button type="submit" class="btn btn-danger" style="margin: 1px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar el tutor con el num. de empleado {{ $tutor->university_id }}"><span class="icofont icofont-ui-delete"></span></button>
																@else
																	<button type="submit" class="btn btn-success" style="margin: 1px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar el tutor con el num. de empleado {{ $tutor->university_id }}"><span class="fas fa-reply"></span></a>
																@endif
															@endif
														</center>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr id="table_footer">
											<th style="padding-right: 2.8%" scope="col">Num .Empleado</th>
											<th style="padding-right: 2.8%" scope="col">Nombre Completo</th>
											<th style="padding-right: 2.8%" scope="col">Email</th>
											<th style="padding-right: 2.8%" scope="col">Carrera</th>
											<th style="padding-right: 2.8%" scope="col" style="width:5px">Cantidad Tutorados</th>
											<th style="padding-left: 1.5%" scope="col"></th>
										</tr>
									</tfoot>
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Atención</strong>
											<p>No hay ningun tutor registrado.</p>
										</div>
										<a href="{{ route('tutors.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-user-plus"></i>Agregar Nuevo Tutor</button></a>
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
	var button = '<a href="{{ route('tutors.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-user-plus"></i>Agregar Tutor</button></a>';
	applyStyleToDatatable(button, 'Buscar en tutores...');
</script>
@endsection
