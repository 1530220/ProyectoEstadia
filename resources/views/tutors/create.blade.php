@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Tutor")

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
						<h4 style="text-transform: none;">Crear Nuevo Tutor</h4>
						<span style="text-transform: none;">Seleccione el tipo de tutor que desee y llene todos los campos solicitados en la parte inferior para crear un nuevo tutor.</span>
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
						<li class="breadcrumb-item">Crear Tutor
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Page-header end -->

	<!-- Page-body start -->
	<div class="page-body">
		<!-- Subscribe From card start -->
		<div class="card">
			<div class="card-block">
				<div class="wrapper wrapper">
					<div class="j-tabs-container">
						<!-- Comienza Tab Nuevo Tutor-->
						<input id="tab2" type="radio" name="tabs" checked>
						<label class="j-tabs-label" for="tab2" title="Login">
							<i class="fa fa-user-plus"></i>
							<span>Nuevo Tutor</span>
						</label>
						<!-- Termina Tab Nuevo Tutor -->
						<!-- Comienza Tab Profesor Registrado -->
						<input id="tab1" type="radio" name="tabs">
						<label class="j-tabs-label" for="tab1" title="Registration">
							<i class="icofont icofont-ui-user "></i>
							<span>Profesor Registrado en el SIITA</span>
						</label>
						<!-- Termina Tab Profesor Registrado -->
						<!-- Comienza Form Nuevo Tutor -->
						<div id="tabs-section-1" class="j-tabs-section">
							<form method="POST" action="{{ route('tutors.asign_tutor') }}" class="j-forms">
								{!! csrf_field() !!}
								<br /><br />
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="tutor_user_id">Seleccione un Profesor</label>
									<div class="col-sm-10">
										<select id="tutor_user_id" name="tutor_user_id" class="select2_basic">
											@foreach ($users as $user)
												<option value='{{ $user->id }}'>{{ $user->title }} {{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div id="teacher_details" class="form-group row" style="margin-left:20px; margin-right:20px;">
									<div class="col-sm-12">
										<h6 class="sub-title">Detalles del profesor seleccionado</h6>
									</div>
									<div class="col-sm-2">
										<h6 class="f-w-400 m-b-30"><i class="icofont icofont-id-card"></i>Num. empleado:</h6>
										<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-user"></i>Nombre:</h6>
										<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-email"></i>Email:</h6>
									</div>
									<div  class="col-sm-10">
										<div class="row">
											<div class="col-sm-8">
												<h6 style="font-weight: bold;" class="m-b-30" id="num_employee_details"></h6>
												<h6 class="m-b-30" id="name_details"></h6>
												<h6 class="m-b-30" id="email_details"></h6>
											</div>
											<div class="col-sm-3">
												<img id="modal_img" class="form-control" style="max-height:140px; max-width:140px" src="" alt="no_image" />
												<div id="modal_show_img" class="modal">
													<span class="close">&times;</span>
													<img class="modal-content" id="img_content">
													<div id="caption"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br>
								<center>
									<a href="{{ route('tutors.list') }}" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
									<button id="save_tt_btn" type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Tutor</button>
								</center>
								<br /><br />
							</form>
						</div>
						<!-- Termina Tab Nuevo Tutor -->
						<!-- Cominza Tab Profesor Registrado -->
						<div id="tabs-section-2" class="j-tabs-section">
							<form id="form" method="POST" action="{{ route('tutors.create_new') }}" class="j-forms" enctype="multipart/form-data">
								{!! csrf_field() !!}
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<br /><br />
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="id">ID Tutor:</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" title="ID del Tutor" value="{{ old('id') }}">
										@if ($errors->has('id'))
											<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
										@endif
										<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="num_employee">Num. Empleado:</label>
									<div class="col-sm-10">
										<input type="number" class="form-control" id="num_employee" name="num_employee" placeholder="Ej. 100" title="Número de Empleado del Tutor" value="{{ old('employee') }}">
										@if ($errors->has('num_employee'))
											<div class="col-form-label" style="color:red;">{{$errors->first('num_employee')}}</div>
										@endif
										<div id="error_num_employee" class="col-form-label" style="color:red; display:none;"></div>
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="title">Grado:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="title" placeholder="Ej. Dr." title="Grado de Titulación del Tutor" value="{{ old('title') }}">
										<div class="col-form-label"> * En caso, de no contar con un titulo, puede dejar este campo vacío</div>
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="name" placeholder="Ej. Daniel Alejandro" title="Nombre del Tutor" value="{{ old('name') }}">
										@if ($errors->has('name'))
											<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
										@endif
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="last_name">Apellido Paterno:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="last_name" placeholder="Ej. López" title="Apellido Paterno del Tutor" value="{{ old('last_name') }}">
										@if ($errors->has('last_name'))
											<div class="col-form-label" style="color:red;">{{$errors->first('last_name')}}</div>
										@endif
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="second_last_name">Apellido Materno:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="second_last_name" placeholder="Ej. López" title="Apellido Materno del Tutor" value="{{ old('second_last_name') }}">
										<div class="col-form-label"> * En caso, de solo tener un apellido, solo llene el campo de Apellido Paterno</div>
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="username">Username:</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="username" name="username" placeholder="Ej. dlopezl" title="Username del Tutor" value="{{ old('username') }}">
										@if ($errors->has('username'))
											<div class="col-form-label" style="color:red;">{{$errors->first('username')}}</div>
										@endif
										<div id="error_username" class="col-form-label" style="color:red; display:none;"></div>
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="password">Contraseña:</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" name="password" placeholder="Contraseña" value="">
										@if ($errors->has('password'))
											<div class="col-form-label" style="color:red;">{{$errors->first('password')}}</div>
										@endif
									</div>
								</div>
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
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
													<span>Arrastre y suelte la imagen del tutor <span style="font-weight: bold; font-size:16px;"> aquí</span> o haga clic <span style="font-weight: bold; font-size:16px;"> aquí</span> para buscarla en su equipo.</span>
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
								<div class="form-group row" style="margin-left:20px; margin-right:20px;">
									<label class="col-sm-2 col-form-label" for="career_id">Seleccione una Carrera:</label>
									<div class="col-sm-10">
										<select name="career_id" class="select2_basic">
											@foreach ($careers as $career)
												<option value="{{ $career->id }}" {{ (old("career_id") == $career->id ? "selected":"") }}>{{ $career->name }}</option>
											@endforeach
										</select>
										@if ($errors->has('career_id'))
											<div class="col-form-label" style="color:red;">{{$errors->first('career_id')}}</div>
										@endif
									</div>
								</div>
								<br>
								<center>
									<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
									<button id="save" type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Tutor</button>
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

		//Se verifica que exista al menos un tutor
		if(!$('#tutor_user_id').val()){
			$('#teacher_details').css('display','none');
			$("#save_tt_btn").prop('disabled', true);
		}
		else
			getDetailsFromSelectTeacher();

		//Cuando cambie el tutor seleccionado
		$('#tutor_user_id').change(function(e) {
			getDetailsFromSelectTeacher();
		});

		@if(isset($id))
			$('#tab1').trigger('click');
			$('#tutor_user_id').val('{{$id}}').trigger('change');
		@endif
	});

	//Se obtienen los detalles del tutor que este seleccionado actualmente en el
	//select
	function getDetailsFromSelectTeacher() {
		//Se prepara la solicitud agregando a la cabecera el token csrf
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			}
		});

		//Se realiza la peticion y se manda en data, los valores requeridos
		//por la funcion
		$.ajax({
			url: '{{ route('teachers.get_details') }}',
			method: 'post',
			data: {
				id: $('#tutor_user_id').val(),
			},

			success: function(result) {
				//Se actualizan todos los elementos de la interfaz con los detallos del profesor seleccionado
				$("#num_employee_details").text(result['response']['university_id']);
				$("#name_details").text(result['response']['title']+" "+result['response']['first_name']+" "+result['response']['last_name']+" "+result['response']['second_last_name']);
				$("#email_details").text(result['response']['email']);
				$("#modal_img").attr('src',base_img_url+result['response']['image_url']);
				$("#modal_img").attr("alt",$("#name").text());
			}
		});
	}
</script>
@endsection
