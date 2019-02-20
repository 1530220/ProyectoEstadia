@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Usuario")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fas fa-user-plus" style="background-color:#ab7967"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Crear Usuario</h4>
						<span style="text-transform: none;">Llene los campos solicitados en la parte inferior para agregar un nuevo usuario.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('users.list') }}">Usuarios</a>
						</li>
						<li class="breadcrumb-item">Crear Usuario
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
						<form id="form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
							{!! csrf_field() !!}
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="type">Tipo de Usuario</label>
								<div class="col-sm-10">
									<select id="type" name="type" class="form-control">
										<option value="1" {{ (old("type") == 1 ? "selected":"") }}>Administrador</option>
										<option value="2" {{ (old("type") == 2 ? "selected":"") }}>Usuario / Empleado de la Universidad</option>
										<option value="3" {{ (old("type") == 3 ? "selected":"") }}>Alumno</option>
										<option value="4" {{ (old("type") == 4 ? "selected":"") }}>Profesor</option>
										<option value="5" {{ (old("type") == 5 ? "selected":"") }}>Tutor</option>
										<option value="6" {{ (old("type") == 6 ? "selected":"") }}>Salud</option>
										<option value="7" {{ (old("type") == 7 ? "selected":"") }}>Psicología</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" id="user_id_label" for="user_id"></label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="user_id" name="user_id" placeholder="" title="ID del Usuario" value="{{ old('user_id') }}">
									@if ($errors->has('user_id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('user_id')}}</div>
									@endif
									<div id="error_user_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" id="id_label" for="id">Num. Empleado:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="" title="Numero de Empleado del Nuevo Usuario" value="{{ old('id') }}">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div id="title" class="form-group row">
								<label class="col-sm-2 col-form-label" for="title">Titulo:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="title" placeholder="Ej. Dr." title="Titulo de Estudios del Usuario" value="{{ old('title') }}">
									<div class="col-form-label"> * En caso, de no contar con un titulo, puede dejar este campo vacío</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="first_name" placeholder="Nombre(s)" title="Nombre o Nombres del Usuario" value="{{ old('name') }}">
									@if ($errors->has('first_name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('first_name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="last_name">Apellido Paterno:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="last_name" placeholder="Apellido Paterno" title="Apellido Paterno del Usuario" value="{{ old('last_name') }}">
									@if ($errors->has('last_name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('last_name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="second_last_name">Apellido Materno:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="second_last_name" placeholder="Apellido Materno" title="Apellido Materno del Usuario" value="{{ old('second_last_name') }}">
									<div class="col-form-label"> * En caso, de solo tener un apellido, solo llene el campo de Apellido Paterno</div>
								</div>
							</div>
							<div id="academic_situation" class="form-group row">
								<label class="col-sm-2 col-form-label" for="academic_situation_id">Situación Académica:</label>
								<div class="col-sm-10">
									<select name="academic_situation_id" class="select2_basic">
										<option value="0" {{ (old("academic_situation_id") == 0 ? "selected":"") }}>Regular</option>
										<option value="1" {{ (old("academic_situation_id") == 1 ? "selected":"") }}>Especial</option>
									</select>
								</div>
							</div>
							<div id="career" class="form-group row">
								<label class="col-sm-2 col-form-label" for="career_id">Carrera:</label>
								<div class="col-sm-10">
									<select id="career_id" name="career_id" class="select2_basic">
										@foreach ($careers as $career)
											<option value="{{ $career->id }}" {{ (old("career_id") == $career->id ? "selected":"") }}>{{ $career->name }}</option>
										@endforeach
									</select>
									@if ($errors->has('career_id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('career_id')}}</div>
									@endif
								</div>

							</div>
							<div id="tutor" class="form-group row">
								<label class="col-sm-2 col-form-label" for="tutor_id">Tutor Academico:</label>
								<div class="col-sm-10">
									<select id="tutor_id" name="tutor_id" class="select2_basic"></select>
									@if ($errors->has('tutor_id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('tutor_id')}}</div>
									@endif
								</div>

							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="username">Username:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" title="Usuario Institucional del Nuevo Usuario" value="{{ old('username') }}">
									@if ($errors->has('username'))
										<div class="col-form-label" style="color:red;">{{$errors->first('username')}}</div>
									@endif
									<div id="error_username" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="password">Contraseña:</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="password" placeholder="Contraseña" title="Contraseña del Nuevo Usuario" value="{{ old('password') }}">
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
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Usuario</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

@section('javascriptcode')
<script>
	$(document).ready(function() {
		error_divs = [
			$('#error_user_id'),
			$('#error_id'),
			$('#error_username'),
		];

		var id_error_message=getErrorMessageForUniversityID();

		verify_column($('#user_id'), 'id', 'users', null, $('#error_user_id'),
			'* El id que esta intentando ingresar no esta disponible.');
		verify_column($('#id'), 'university_id', 'users', null, $('#error_id'),
			id_error_message);
		verify_column($('#username'), 'username', 'users', null, $('#error_username'),
			'* El usuario que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#user_id').keyup(function(e) {
			verify_column($('#user_id'), 'id', 'users', null, $('#error_user_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		$('#id').keyup(function(e) {
			var id_error_message=getErrorMessageForUniversityID();
			verify_column($('#id'), 'university_id', 'users', null, $('#error_id'),
				id_error_message);
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

		//Mostrando los elementos adecuados para el tipo de usuario
		showElementsForCurrentUserType();

		//Llenando los tutor de la carrera actual
		getTeachersFromCurrentCareer();
	});

	//Cada que cambie la opcion seleccionada en el select se ejecuta la funcion
	$("#type").change(function() {
		showElementsForCurrentUserType();
	});

	//Obtiene el mensaje de error que se mostrara en el div de error al ingresar
	//un id que ya ha sido utilizado
	function getErrorMessageForUniversityID(){
		var id_error_message="";
		switch ($("#type").val()) {
			case '1':
			case '2':
			case '4':
			case '5':
			case '6':
			case '7':
				id_error_message='* El numero de empleado que esta intentado ingresar no esta disponible.';
				break;
			case '3':
				id_error_message='* La matricula que esta intentado ingresar no esta disponible.';
				break;
		}
		return id_error_message;
	}

	//Muestra los elementos para el tipo actual, agregando animaciones de entrada
	//para cada elemento requerido dependiendo del tipo de usuario
	function showElementsForCurrentUserType() {
		switch ($("#type").val()) {
			case '1':
				$("#user_id_label").text("ID Administrador:");
				$("#user_id").attr("placeholder", "ID del Administrador");
				$("#id_label").text("Num. Empleado:");
				$("#id").attr("placeholder", "Numero de empleado del trabajador");
				$('#career').fadeOut(0);
				$('#academic_situation').fadeOut(0);
				$('#tutor').fadeOut(0);
				break;
			case '2':
				$("#user_id_label").text("ID Usuario:");
				$("#user_id").attr("placeholder", "ID del Usuario");
				$("#id_label").text("Num. Empleado:");
				$("#id").attr("placeholder", "Numero de empleado del trabajador");
				$('#career').fadeOut(0);
				$('#academic_situation').fadeOut(0);
				$('#tutor').fadeOut(0);
				break;
			case '3':
				$("#user_id_label").text("ID Estudiante:");
				$("#user_id").attr("placeholder", "ID del Estudiante");
				$("#id_label").text("Matricula:");
				$("#id").attr("placeholder", "Matricula del alumno");
				$('#career').fadeIn(200);
				$('#title').fadeOut(200);
				$('#academic_situation').fadeIn(200);
				$('#tutor').fadeIn(200);
				break;
			case '6':
				$("#user_id_label").text("ID Usuario:");
				$("#user_id").attr("placeholder", "ID del Usuario");
				$("#id_label").text("Num. Empleado:");
				$("#id").attr("placeholder", "Numero de empleado del trabajador");
				$('#career').fadeOut(0);
				$('#academic_situation').fadeOut(0);
				$('#tutor').fadeOut(0);
				break;
			case '7':
				$("#user_id_label").text("ID Usuario:");
				$("#user_id").attr("placeholder", "ID del Usuario");
				$("#id_label").text("Num. Empleado:");
				$("#id").attr("placeholder", "Numero de empleado del trabajador");
				$('#career').fadeOut(0);
				$('#academic_situation').fadeOut(0);
				$('#tutor').fadeOut(0);
				break;
			default:
				$("#user_id_label").text("ID Tutor / Profesor:");
				$("#user_id").attr("placeholder", "ID del Tutor / Profesor");
				$("#id_label").text("Num. Empleado:");
				$("#id").attr("placeholder", "Numero de empleado del usuario");
				$('#career').fadeIn(200);
				$('#academic_situation').fadeOut(0);
				$('#tutor').fadeOut(0);
		}
	}

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
				$("#tutor_id").empty();
				for(i=0;i<result['response'].length;i++){
					$("#tutor_id").append(new Option((result['response'][i]['title']==null?"":result['response'][i]['title'])+
						" "+result['response'][i]['first_name']+" "+result['response'][i]['last_name']+" "+
						(result['response'][i]['second_last_name']==null?"":result['response'][i]['second_last_name']), result['response'][i]['id']));
				}
			}
		});

	}
</script>

@endsection
