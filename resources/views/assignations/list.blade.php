@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Asignaciones")

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
					<i class="icofont icofont-table" style="background-color:#5e1287"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Tutorados</h4>
						<span style="text-transform: none;">Permite la gestión de todos los tutorados registrados en el sistema.</span>
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
						<h4 class="sub-title">Ver todos los tutorados de tutor en especifico:</h4>
						<div class="form-group row">
							<label class="col-sm-1 col-form-label" for="tutor_user_id">Tutor:</label>
							<div class="col-sm-9">
								<select id="tutor_user_id" name="tutor_user_id" class="select2_basic" title="Tutor del que desee ver sus tutorados">
									@foreach ($teachers as $teacher)
										<option value='{{ $teacher->user_id }}'>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-2">
								<button title="Ver los tutorados del profesor seleccionado" style="width:100%; height:100%; font-size: 13px" id="button_tutorados" type="button" class="btn btn-purple"><i class="icofont icofont-users"></i>Ver Tutorados</button>
							</div>
						</div>
						<br />
						<h4 class="sub-title">Listado de todos los tutorados y de su tutor academico registrados en el sistema:</h4>
						<div class="dt-responsive table-responsive">
							<table style="width:100%;" id="custom_datatable" class="table table-striped table-bordered">
								@if ($students->isNotEmpty())
								<thead id="table_header">
									<tr>
										<th class="all" scope="col" style="width:10%;">Matrícula</th>
										<th scope="col" style="width:20%;">Tutorado</th>
										<th scope="col" style="width:25%;">Tutor</th>
										<th scope="col" style="width:20%;">Carrera</th>
										<th class="all" scope="col" style="width:25%;">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($students as $student)
									<tr>
										@if($student->deleted=='0')
											<td style="font-weight:bold">{{ $student->university_id }}</td>
											<td><a href="{{ route('students.show', ['id' => $student->university_id]) }}">{{ $student->userFirstName }} {{ $student->userLastName }} {{ $student->userSecondName }}</a></td>
											@if($student->tutor_user_id==4294967295)
												<td style="color:red">{{ $student->tutorTitle }} {{ $student->tutorFirstName }} {{ $student->tutorLastName }} {{ $student->tutorSecondName }}</a></td>
											@else
												<td><a href="{{ route('tutors.show', ['id' => $student->tutorUniversityId]) }}">{{ $student->tutorTitle }} {{ $student->tutorFirstName }} {{ $student->tutorLastName }} {{ $student->tutorSecondName }}</a></td>
											@endif
											<td>{{ $student->careerAb }}</td>
										@else
											<td style="color:red; font-weight:bold">{{ $student->university_id }}</td>
											<td style="color:red;"><a href="{{ route('students.show', ['id' => $student->university_id]) }}">{{ $student->userFirstName }} {{ $student->userLastName }} {{ $student->userSecondName }}</a></td>
											<td style="color:red;"><a style="color:red" href="{{ route('tutors.show', ['id' => $student->tutorUniversityId]) }}">{{ $student->tutorTitle }} {{ $student->tutorFirstName }} {{ $student->tutorLastName }} {{ $student->tutorSecondName }}</a></td>

											<td style="color:red;">{{ $student->careerAb }}</td>
										@endif
											<td>
												<center>
													<a href="{{ route('students.show', ['id' => $student->university_id]) }}" class="btn" style="background-color: #eda22a" title="Información del tutorado con la matricula {{ $student->university_id }}" style="margin: 5px;"><span style="color: white;" class="fas fa-info-circle"></span></a>
													<a href="{{ route('assignations.reassignation', ['id' => $student->student_user_id]) }}" class="btn" style="background-color: #4e787a;" title="Reasignar el tutor actual del tutorado con la matricula {{ $student->university_id }}" style="margin: 5px;"><span style="color: white;" class="fas fa-exchange-alt"></span></a>
													@if($student->tutor_user_id!=4294967295)
														<a onclick="removeTutor({{ $student->student_user_id }})" class="btn" style="background-color: #cc0404;" title="Quitar el tutor actual del tutorado con la matricula {{ $student->university_id }}" style="margin: 5px;"><span style="color: white;" class="fas fa-user-minus"></span></a>
													@endif
												</center>
											</td>
									</tr>
									@endforeach
								</tbody>
								@else
								<p>No hay alumnos registrados</p>
								@endif
								<tfoot>
									<tr id="table_footer">
										<th style="padding-right: 2.8%" scope="col" style="width:5%;">Tutor</th>
										<th style="padding-right: 2.8%" scope="col" style="width:5%;">Matrícula</th>
										<th style="padding-right: 2.8%" scope="col" style="width:20%;">Tutorado</th>
										<th style="padding-right: 2.8%" scope="col" style="width:15%;">Carrera</th>
										<th style="padding-left: 1.0%" scope="col" style="width:0%;"></th>
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

	var button='<a href="{{ route('assignations.create') }}" title="Asignar Tutorados"><button class="btn btn-success" style="float:right; width: 100%"><i class="fa fa-link"></i>Asignar Tutorados</button></a>';
	applyStyleToDatatable(button, 'Buscar en tutorados...');
	var base_url='{{url('')}}';

	$(document).ready(function(){
		$("#button_tutorados").click(function(){
			if($("#tutor_user_id").val()!=""){
				window.location.href = base_url+"/tutors/"+$("#tutor_user_id").val()+"/tutorados";
			}else{
				swal({
					icon: 'error',
					title: 'No se pueden abrir los tutorados del profesor seleccionado',
					text: 'El profesor seleccionado no tiene un id valido o es inexistente, intente de nuevo.',
					buttons: 'Aceptar',
				});
			}

		});
	});


	function removeTutor(id){
		var base_url='{{ url('') }}';
		swal({
			title: "Atención",
			text: "Esta a punto de quitar el tutor del alumno seleccionado, para dejarlo sin tutor asignado. ¿Esta seguro de que desea continuar?",
			icon: "warning",
			buttons: true,
			dangerMode: false,
			buttons: ["Cancelar", "Aceptar"],
			closeModal: false

		}).then((result) => {
			if (result) {
				window.location.href = base_url+"/assignations/remove/"+id;
			}
		});

	}


</script>
@endsection
