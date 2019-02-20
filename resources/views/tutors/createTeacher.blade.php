@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Profesor")

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
					<i class="fas fa-user-graduate bg-c-green"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Crear Profesor</h4>
						<span style="text-transform: none;">Formulario para el registro de profesores.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('teachers.list') }}">Profesores</a>
						</li>
						<li class="breadcrumb-item">Crear Profesor
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
						<h4 class="sub-title">Información General</h4>
							<form id="form" method="POST" action="{{ route('teachers.store') }}" enctype="multipart/form-data">
								{!! csrf_field() !!}
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group row">
									<label class="col-sm-2 col-form-label" for="id">ID Profesor:</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" title="ID del Profesor" value="{{ old('id') }}">
										@if ($errors->has('id'))
											<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
										@endif
										<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="num_employee">Num. Empleado:</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" id="num_employee" name="num_employee" placeholder="Ej. 100" title="Número de Empleado del Profesor" value="{{ old('num_employee') }}">
										@if ($errors->has('num_employee'))
											<div class="col-form-label" style="color:red;">{{$errors->first('num_employee')}}</div>
										@endif
										<div id="error_num_employee" class="col-form-label" style="color:red; display:none;"></div>
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="title">Grado:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="title" placeholder="Ej. Dr." title="Grado de Titulación del Profesor" value="{{ old('title') }}">
										<div class="col-form-label"> * En caso, de no contar con un titulo, puede dejar este campo vacío</div>
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="name" placeholder="Ej. Daniel Alejandro" title="Nombre del Profesor" value="{{ old('name') }}">
										@if ($errors->has('name'))
											<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
										@endif
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="last_name">Apellido Paterno:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="last_name" placeholder="Ej. López" title="Apellido Paterno del Profesor" value="{{ old('last_name') }}">
										@if ($errors->has('last_name'))
											<div class="col-form-label" style="color:red;">{{$errors->first('last_name')}}</div>
										@endif
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="second_last_name">Apellido Materno:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="second_last_name" placeholder="Ej. López" title="Apellido Materno del Profesor" value="{{ old('second_last_name') }}">
										<div class="col-form-label"> * En caso, de solo tener un apellido, solo llene el campo de Apellido Paterno</div>
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="username">Username:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="username" name="username" placeholder="Ej. dlopezl" title="Username del Profesor" value="{{ old('username') }}">
										@if ($errors->has('username'))
											<div class="col-form-label" style="color:red;">{{$errors->first('username')}}</div>
										@endif
										<div id="error_username" class="col-form-label" style="color:red; display:none;"></div>
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="password">Contraseña:</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" name="password" placeholder="Contraseña" value="">
										@if ($errors->has('password'))
											<div class="col-form-label" style="color:red;">{{$errors->first('password')}}</div>
										@endif
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label">Imagen:</label>
									<div class="col-sm-10">
										<div class="file-upload">
											<div class="image-upload-wrap">
												<input id="image_input" class="file-upload-input" type='file' name="image" onchange="readURL(this);" accept="image/*" />
												<div style="padding-top:40px" onclick="$('.file-upload-input').trigger('click' )">
													<center>
														<i style="font-size: 60px;" class="fas fa-cloud-upload-alt drag-icon"></i>
													</center>
												</div>
												<div class="drag-text">
													<span>Arrastre y suelte la imagen del profesor <span style="font-weight: bold; font-size:16px;"> aquí</span> o haga clic <span style="font-weight: bold; font-size:16px;"> aquí</span> para buscarla en su equipo.</span>
												</div>
											</div>
											<div class="file-upload-content">
												<img class="file-upload-image" src="#" alt="your image" />
												<div class="image-title-wrap">
													<button type="button" onclick="removeUpload()" class="remove-image">Remover Imagen</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-sm-2 col-form-label" for="career_id_2">Seleccione una Carrera:</label>
									<div class="col-sm-10">
										<select name="career_id_2" class="select2_basic">
											@foreach ($careers as $career)
												<option value="{{ $career->id }}" {{ (old("career_id_2") == $career->id ? "selected":"") }}>{{ $career->name }}</option>
											@endforeach
										</select>
										@if ($errors->has('career_id_2'))
											<div class="col-form-label" style="color:red;">{{$errors->first('career_id_2')}}</div>
										@endif
									</div>
								</div>
								<br>
								<center>
									<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
									<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Tutor</button>
								</center>
								<br /><br />
							</form>
						</div>
						<!-- Termina Tab Profesor Registrado -->
					</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascriptcode')
<script type="text/javascript">
	$(document).ready(function() {
		error_divs = [
			$('#error_id'),
			$('#error_num_employee'),
			$('#error_username'),
		];

		verify_column($('#id'), 'id', 'users', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');
		verify_column($('#num_employee'), 'university_id', 'users', null, $('#error_num_employee'),
			'* El numero de empleado que esta intentando ingresar no esta disponible.');
		verify_column($('#username'), 'username', 'users', null, $('#error_username'),
			'* El usuario que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'users', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		$('#num_employee').keyup(function(e) {
			verify_column($('#num_employee'), 'university_id', 'users', null, $('#error_num_employee'),
				'* El numero de empleado que esta intentando ingresar no esta disponible.');
		});
		$('#username').keyup(function(e) {
			verify_column($('#username'), 'username', 'users', null, $('#error_username'),
				'* El usuario que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas

	});

	function getDetailsFromSelectTeacher(){
		console.log($('tutor_user_id').val());
	}
</script>
@endsection
