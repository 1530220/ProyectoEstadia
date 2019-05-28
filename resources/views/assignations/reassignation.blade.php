@extends('layouts.app')

@section('title',"SIITA - Crear Alumno")

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

<!-- Page-header start -->
<div class="page-header card">
	<div class="row align-items-end">
		<div class="col-lg-8">
			<div class="page-header-title">
				<i class="fas fa-link" style="background-color:#5e1287"></i>
				<div class="d-inline">
					<h4 style="text-transform: none;">Reasignación de Tutor al Tutorado con la Matrícula: {{ $student[0]->university_id }}</h4>
					<span style="text-transform: none;">Reasignación de tutor al alumno: {{ $student[0]->first_name }} {{ $student[0]->last_name }} {{ $student[0]->second_last_name }}.</span>
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
					<li class="breadcrumb-item"><a href="{{ route('assignations.list') }}">Tutorados</a>
					</li>
					<li class="breadcrumb-item">Reasignación de Tutor
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
			<div class="card">
				<div class="card-block">
					<form id="form" method="POST" action="{{ route('assignations.changeTutor', $student[0]->id) }}" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<input type="text" hidden class="form-control" name="id" value="{{ $student[0]->id }}" title="Nombre del Alumno">
						<input type="text" hidden class="form-control" name="id_old_tutor" value="{{ $student[0]->tutor_user_id }}" title="Nombre del Alumno">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="name">Nombre del Alumno:</label>
							<div class="col-sm-10">
								<input type="text" disabled class="form-control" name="name" value="{{ $student[0]->first_name }} {{ $student[0]->last_name }} {{ $student[0]->second_last_name }}" title="Nombre del Alumno">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="tutor_name">Tutor Actual:</label>
							<div class="col-sm-10">
								<input type="text" disabled class="form-control" name="tutor_name" value="{{ $student[0]->tutor_first_name }} {{ $student[0]->tutor_last_name }} {{ $student[0]->tutor_second_last_name }}" title="Nombre del Tutor Actual">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="tutor_user_id">Nuevo Tutor Academico:</label>
							<div class="col-sm-10">
								<select name="tutor_user_id" class="select2_basic" title="Tutor que se asignara al alumno">
									@foreach ($tutors as $teacher)
										@if (is_null($teacher->title))
										<option value="{{ $teacher->user_id }}" {{ (old("tutor_user_id") == $teacher->user_id ? "selected":"") }}>{{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
										@else
										<option value="{{ $teacher->user_id }}" {{ (old("tutor_user_id") == $teacher->user_id ? "selected":"") }}>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<br>
						<center>
							<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" title="Regresar a la página anterior" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
							<button type="submit" title="Reasignar Tutor" class="btn btn-success"><i class="icofont icofont-link"></i>Reasignar Tutor</button>
						</center>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('javascriptcode')
<script type="text/javascript">
	$(document).ready(function() {

		//Se verifica que se cumplan las reglas para el ingreso del registro
		$("#form").submit(function(e) {
			if (!can_continue)
				e.preventDefault();
		});
		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#matricula').keyup(function(e) {
			e.preventDefault();
			verify_column($('#matricula'), 'university_id', 'users')
		});
		$('#id').keyup(function(e) {
			e.preventDefault();
			verify_column($('#id'), 'id', 'users')
		});
		$('#username').keyup(function(e) {
			e.preventDefault();
			verify_column($('#username'), 'username', 'users')
		});
		$('#email').keyup(function(e) {
			e.preventDefault();
			verify_column($('#email'), 'email', 'users')
		});
		//* Termina verificacion de columnas unicas
	});
</script>
@endsection
