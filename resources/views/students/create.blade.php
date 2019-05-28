@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Alumno")

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
				<i class="fa fa-user-plus bg-c-pink"></i>
				<div class="d-inline">
					<h4 style="text-transform: none;">Crear Alumno</h4>
					<span style="text-transform: none;">Ingrese los campos solicitados en la parte inferior para el registro de un nuevo alumno.</span>
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
					<li class="breadcrumb-item"><a href="{{ route('students.list') }}">Alumnos</a>
					</li>
					<li class="breadcrumb-item">Crear Alumno
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
					<form id="form" method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="id">ID Estudiante:</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10 " value="{{ old('id') }}" title="ID del Alumno">
								@if ($errors->has('id'))
									<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
								@endif
								<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="matricula">Matricula:</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" id="matricula" name="matricula" placeholder="Ej. 1530001 " value="{{ old('matricula') }}" title="Matrícula del Alumno">
								@if ($errors->has('matricula'))
									<div class="col-form-label" style="color:red;">{{$errors->first('matricula')}}</div>
								@endif
								<div id="error_matricula" class="col-form-label" style="color:red; display:none;"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" placeholder="Ej. Daniel Alejandro" value="{{ old('name') }}" title="Nombre del Alumno">
								@if ($errors->has('name'))
									<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="last_name">Apellido Paterno:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="last_name" placeholder="Ej. López" value="{{ old('last_name') }}" title="Apellido Paterno del Alumno">
								@if ($errors->has('last_name'))
									<div class="col-form-label" style="color:red;">{{$errors->first('last_name')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="second_last_name">Apellido Materno:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="second_last_name" placeholder="Ej. López" value="{{ old('second_last_name') }}" title="Apellido Materno del Alumno">
								<div class="col-form-label"> * En caso, de solo tener un apellido, solo llene el campo de Apellido Paterno</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="username">Username:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="username" name="username" placeholder="Ej. 1530001" value="{{ old('username') }}" title="Username del Alumno">
								@if ($errors->has('username'))
									<div class="col-form-label" style="color:red;">{{$errors->first('username')}}</div>
								@endif
								<div id="error_username" class="col-form-label" style="color:red; display:none;"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="password">Contraseña:</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="{{ old('password') }}" title="Contraseña del Alumno">
								@if ($errors->has('password'))
									<div class="col-form-label" style="color:red;">{{$errors->first('password')}}</div>
								@endif
							</div>
						</div>

						<div class="form-group row">
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
											<span>Arrastre y suelte la imagen del alumno <span style="font-weight: bold; font-size:16px;"> aquí</span> o haga clic <span style="font-weight: bold; font-size:16px;"> aquí</span> para buscarla en su equipo.</span>
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
						
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="academic_situation">Situación Académica:</label>
							<div class="col-sm-10">
								<select name="academic_situation" class="select2_basic" title="Situación académica actual del alumno">
									<option value="{{ 0 }}" {{ (old("academic_situation_id") == 0 ? "selected":"") }}>Regular</option>
									<option value="{{ 1 }}" {{ (old("academic_situation_id") == 1 ? "selected":"") }}>Especial</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="career_id">Carrera:</label>
							<div class="col-sm-10">
								<select id="career_id" name="career_id" class="select2_basic" title="Carrera a la que pertenecerá el alumno">
									@foreach ($careers as $career)
										<option value="{{ $career->id }}" {{ (old("career_id") == $career->id ? "selected":"") }}>{{ $career->name }}</option>
									@endforeach
								</select>
								@if ($errors->has('career_id'))
									<div class="col-form-label" style="color:red;">{{$errors->first('career_id')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="tutor_user_id">Tutor Academico:</label>
							<div class="col-sm-10">
								<select id="tutor_user_id" name="tutor_user_id" class="select2_basic" title="Tutor academico que se le asignara al alumno y que pertenece a su carrera">
								</select>
								@if ($errors->has('tutor_user_id'))
									<div class="col-form-label" style="color:red;">{{$errors->first('tutor_user_id')}}</div>
								@endif
							</div>
						</div>
						<br>
						<center>
							<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" title="Regresar a la página anterior" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
							<button type="submit" title="Guardar el alumno" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Alumno</button>
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

		getTeachersFromCurrentCareer();

		error_divs = [
			$('#error_id'),
			$('#error_matricula'),
			$('#error_username'),
		];
		verify_column($('#id'), 'id', 'users', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');
		verify_column($('#matricula'), 'university_id', 'users', null, $('#error_matricula'),
			'* La matricula que esta intentando ingresar no esta disponible.');
		verify_column($('#username'), 'username', 'users', null, $('#error_username'),
			'* El usuario que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'users', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		$('#matricula').keyup(function(e) {
			verify_column($('#matricula'), 'university_id', 'users', null, $('#error_matricula'),
				'* La matricula que esta intentando ingresar no esta disponible.');
		});
		$('#username').keyup(function(e) {
			verify_column($('#username'), 'username', 'users', null, $('#error_username'),
				'* El usuario que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas

		//Se detecta si se selecciono otra carrera y se llena el select de los tutores
		//con los que pertenezcan a ella
		$('#career_id').change(function(e){
			getTeachersFromCurrentCareer();
		});

		//Obtiene los tutores qu epertenezcan a la carrera seleccionada del alumno
		function getTeachersFromCurrentCareer() {
			//Se prepara la solicitud agregando a la cabecera el token csrf
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			});

			//Se realiza la peticion y se manda en data, los valores requeridos
			//por la funcion
			$.ajax({
				url: '{{ route('teachers.get_career_teachers') }}',
				method: 'post',
				data: {
					id: $('#career_id').val(),
				},

				success: function(result) {
					//Se actualiza el select del tutor con los profesores de la carrera
					$("#tutor_user_id").empty();
					for(i=0;i<result['response'].length;i++){
						$("#tutor_user_id").append(new Option((result['response'][i]['title']==null?"":result['response'][i]['title'])+
							" "+result['response'][i]['first_name']+" "+result['response'][i]['last_name']+" "+
							(result['response'][i]['second_last_name']==null?"":result['response'][i]['second_last_name']), result['response'][i]['id']));
					}
				}
			});

		}
	});
</script>
@endsection
