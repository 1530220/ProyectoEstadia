@extends('layouts.app')

@section('title',"SIITA - Editar Perfil")

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
					<i class="icofont icofont-ui-edit" style="background-color:#ab7967"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Editar Perfil del Usuario: {{$user->id}}</h4>
						<span style="text-transform: none;">Ingrese los valores solicitados en la parte inferior para editar el perfil de usuario.</span>
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
						<li class="breadcrumb-item">Modificar Perfil de Usuario
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
						<form id="form" method="POST" action="{{ route('profile.update', ['user'=>$user->id]) }}" files="true" enctype="multipart/form-data">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<input type="hidden" id="type" name="type" value="{{ old('type', $user->type) }}">
							<input type="hidden" id="id" name="id" value="{{ old('id', $user->id) }}">

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="user_id">ID Usuario:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" disabled id="user_id" name="user_id" placeholder="" value="{{ old('user_id', $user->id) }}">
								</div>
							</div>
							<div class="form-group row">
								@if($user->type==3)
									<label class="col-sm-2 col-form-label" for="university_id">Matricula</label>
								@else
									<label class="col-sm-2 col-form-label" for="university_id">Num. Empleado:</label>
								@endif
								<div class="col-sm-10">
									<input type="text" class="form-control" id="university_id" name="university_id" placeholder="Ej. 1530001" value="{{ old('university_id', $user->university_id) }}">
									@if ($errors->has('university_id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('university_id')}}</div>
									@endif
									<div id="error_university_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="first_name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre(s)" value="{{ old('first_name', $user->first_name) }}">
									@if ($errors->has('first_name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('first_name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="last_name">Apellido Paterno:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido Paterno" value="{{ old('last_name', $user->last_name) }}">
									@if ($errors->has('last_name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('last_name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="second_last_name">Apellido Materno:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="second_last_name" name="second_last_name" placeholder="Apellido Materno" value="{{ old('second_last_name', $user->second_last_name) }}">
									<div class="col-form-label"> * En caso, de solo tener un apellido, solo llene el campo de Apellido Paterno</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="username">Username:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username', $user->username)}}">
									@if ($errors->has('username'))
										<div class="col-form-label" style="color:red;">{{$errors->first('username')}}</div>
									@endif
									<div id="error_username" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="password">Contraseña:</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="{{ old('password') }}">
									<div class="col-form-label"> * Si deja la contraseña en blanco, no se cambiará</div>
								</div>
							</div>
							@if ($user->type == 1 || $user->type == 2)
								<div class="form-group row" hidden>
									<label class="col-sm-2 col-form-label" for="career_id">Carrera:</label>
									<div class="col-sm-10">
										<select id="career_id" name="career_id" class="select2_basic" title="Carrera a la que pertenecerá el alumno">
											@foreach ($careers as $career)
												@if (($user->type == 3 && $student->career_id == $career->id) || (($user->type == 4 || $user->type == 5) && $teacher->career_id == $career->id))
													<option selected value='{{ $career->id }}'>{{ $career->name }}</option>
												@else
													<option value='{{ $career->id }}'>{{ $career->name }}</option>
												@endif
											@endforeach
										</select>
									</div>
								</div>
						@else
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="career_id">Carrera:</label>
								<div class="col-sm-10">
									<select id="career_id" name="career_id" class="select2_basic" title="Carrera a la que pertenecerá el alumno">
										@foreach ($careers as $career)
											@if (($user->type == 3 && $student->career_id == $career->id) || (($user->type == 4 || $user->type == 5) && $teacher->career_id == $career->id))
												<option selected value='{{ $career->id }}'>{{ $career->name }}</option>
											@else
												<option value='{{ $career->id }}'>{{ $career->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>
							@endif
							<br>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Imagen:</label>
								<div style="margin-top:10px" class="col-sm-3">
									<img id="modal_img" style="border-radius: 15px;width:100%;" src='{{ asset($user->image_url)}}' alt="{{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}" class="img-fluid p-b-10">
									<input type="text" name="image_2" class="form-control" hidden value="{{ $user->image_url }}">
									<div id="modal_show_img" class="modal">
										<span class="close">&times;</span>
										<img class="modal-content" id="img_content">
										<div id="caption"></div>
									</div>
									<div class="col-form-label" style="align:justify;"> * Vista de la imagen actual.</div>
								</div>
								<div style="margin-top:10px" class="col-sm-7">
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
									<div class="col-form-label" style="align:justify;"> * Si desea cambiarla, agregue una nueva imagen.</div>
								</div>
							</div>
							<br />
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Perfil</button>
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
		//Elementos a verificar sus modificaciones en la vista
		elements_id = [
			$('#type'),
			$('#university_id'),
			$('#first_name'),
			$('#last_name'),
			$('#second_last_name'),
			$('#username'),
			$('#password'),
			$('#career_id'),
			$('#career_id_2')
		];

		var original_values = [
			['university_id', $('#university_id').val()],
			['username', $('#username').val()],
		];

		unique_elements = [
			[$('#university_id'), 'university_id', 'users', original_values, $('#error_university_id'),
				'* La matricula que esta intentando ingresar no esta disponible.'],
			[$('#username'), 'username', 'users', original_values, $('#error_username'),
				'* El username que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_university_id'),
			$('#error_username'),
		]

		checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
	});
</script>
@endsection
