@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Tutorados")

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
					<i class="icofont icofont-group-students bg-c-green"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Tutorados Asignados al Tutor: {{$tutor->title}} {{$tutor->first_name}} {{$tutor->last_name}} {{$tutor->second_last_name}}</h4>
						<span style="text-transform: none;">Lista de los tutorados asignados al tutor con el numero de empleado: {{$tutor->university_id }}.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('tutors.list') }}">Tutores</a>
						</li>
						<li class="breadcrumb-item">Tutorados
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
							@if (sizeof($tutorados) != 0)
								<table id="custom_datatable" style="width:100%" class="table table-striped table-bordered">
									<thead id="table_header">
										<tr>
											<th scope="col" style="width:15%;">Matrícula</th>
											<th scope="col" style="width:20%;">Nombre Completo</th>
											<th scope="col" style="width:15%;">Email</th>
											<th scope="col" style="width:20%;">Carrera</th>
											<th scope="col" style="width:15%;">Situación Académica</th>
											<th scope="col" style="width:15%;">Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($tutorados as $tutorado)
											<tr>
											@if($tutorado->deleted=='0')
												<th scope="row">{{ $tutorado->university_id }}</th>
												<td><a href="{{ route('students.show', ['id' => $tutorado->university_id]) }}">{{ $tutorado->title }} {{ $tutorado->last_name }} {{ $tutorado->second_last_name }} {{ $tutorado->first_name }}</a></td>

												<td>{{ $tutorado->email }}</td>
												<td>{{ $tutorado->abbreviation }}</td>
												@switch($tutorado->academic_situation)
													@case(0)
														<td style="font-weight:bold">Regular</td>
														@break
													@case(1)
														<td style="color:red; font-weight:bold">Especial</td>
														@break
													@endswitch
											@else
												<th style="color:red" scope="row">{{ $tutorado->university_id }}</th>
												<td style="color:red"><a style="color:red" href="{{ route('students.show', ['id' => $tutorado->university_id]) }}">{{ $tutorado->title }} {{ $tutorado->last_name }} {{ $tutorado->second_last_name }} {{ $tutorado->first_name }}</a></td>
												<td style="color:red">{{ $tutorado->email }}</td>
												<td style="color:red">{{ $tutorado->abbreviation }}</td>
												@switch($tutorado->academic_situation)
													@case(0)
														<td style="color:red; font-weight:bold">Regular</td>
														@break
													@case(1)
														<td style="color:red; font-weight:bold">Especial</td>
														@break
													@endswitch
												@endif
												<td>
													<center>
														@if (sizeof($tutorados) > 1)
															<a href="{{ route('students.show', ['id' => $tutorado->university_id]) }}" class="btn" style="background-color: #eda22a" title="Información del tutorado con la matricula {{ $tutorado->university_id }}" style="margin: 5px;"><span style="color: white;" class="fas fa-info-circle"></span></a>
															<a href="{{ route('assignations.reassignation', ['id' => $tutorado->user_id]) }}" class="btn" style="background-color: #4e787a;" title="Reasignar el tutor actual del tutorado con la matricula {{ $tutorado->university_id }}" style="margin: 5px;"><span style="color: white;" class="fas fa-exchange-alt"></span></a>
														@else
															<a href="{{ route('students.show', ['id' => $tutorado->university_id]) }}" class="btn" style="background-color: #eda22a" title="Información del tutorado con la matricula {{ $tutorado->university_id }}" style="margin: 5px;"><span style="color: white;" class="fas fa-info-circle"></span></a>
														@endif
													</center>
												</td>
											</tr>
										@endforeach
									</tbody>
									<tfoot>
										<tr id="table_footer">
											<th style="padding-right: 2.8%" scope="col">No. Empleado</th>
											<th style="padding-right: 2.8%" scope="col">Nombre Completo</th>
											<th style="padding-right: 2.8%" scope="col">Email</th>
											<th style="padding-right: 2.8%" scope="col">Carrera</th>
											<th style="padding-right: 2.8%" scope="col">Situación Académica</th>
											<th style="padding-left: 1.7%" scope="col" style="width:0%;"></th>
										</tr>
									</tfoot>
							@else
									<center>
										<br />
										<div class="alert alert-warning icons-alert" id="alert_div">
											<strong>Alerta</strong>
											<p>El tutor seleccionado, no cuenta con tutorados asignados. Para asignarle tutorados haga clic
												<a style="color:blue" href="{{ route('assignations.create', ['id' => $tutor->id]) }}"><u> aquí.</u> </a></p>
										</div>
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
	var button = "";
	applyStyleToDatatable(button, 'Buscar en tutorados...',1);
</script>
@endsection
