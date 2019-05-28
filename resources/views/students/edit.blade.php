@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Modificar Alumno")

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
				<i class="icofont icofont-ui-edit bg-c-pink"></i>
				<div class="d-inline">
					<h4 style="text-transform: none;">Modificar el Alumno con la Matricula: {{ $user->university_id }}</h4>
					<span style="text-transform: none;">Cambie los valores solicitados en la parte inferior para modificar los detalles del alumno.</span>
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
					<li class="breadcrumb-item">Modificar Alumno
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
					@if($user->deleted==1)
						<div class="alert alert-danger icons-alert">
							<p><strong>Usuario Eliminado</strong></p>
							<p> Este usuario esta actualmente eliminado, restaurelo para que pueda hacer uso de el en el sistema.</p>
						</div>
					@endif
					<form id="form" method="POST" files="true" action="{{ url("students/{$user->id}") }}" enctype="multipart/form-data">
						{{ method_field('PUT') }}
						{!! csrf_field() !!}

						<input type="text" hidden id="user_id" name="user_id" value="{{ $user->id }}">

						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="">ID Estudiante:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" disabled title="Id del Estudiante" value="{{ old('user_id')==""?$user->id: old('user_id') }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="">Matricula:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="university_id" name="university_id" placeholder="Ej. 1530000" value="{{ old('university_id')==""?$user->university_id:old('university_id') }}" title="Matricula del Alumno">
								@if ($errors->has('university_id'))
									<div class="col-form-label" style="color:red;">{{$errors->first('university_id')}}</div>
								@endif
								<div id="error_university_id" class="col-form-label" style="color:red; display:none;"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="name" name="name" placeholder="Ej. Daniel Alejandro" value="{{ old('first_name')==""?$user->first_name:old('first_name') }}" title="Nombre del Alumno">
								@if ($errors->has('name'))
									<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="last_name">Apellido Paterno:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ej. López" value="{{ old('last_name')==""?$user->last_name:old('last_name') }}" title="Apellido Paterno del Alumno">
								@if ($errors->has('last_name'))
									<div class="col-form-label" style="color:red;">{{$errors->first('last_name')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="second_last_name">Apellido Materno:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="second_last_name" name="second_last_name" placeholder="Ej. López" value="{{ $user->second_last_name}}" title="Apellido Materno del Alumno">
								<div class="col-form-label"> * En caso, de solo tener un apellido, solo llene el campo de Apellido Paterno</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="username">Username:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="username" name="username" placeholder="Ej. 1530001" value="{{ old('username')==""?$user->username:old('username') }}" title="Username del Alumno">
								@if ($errors->has('username'))
									<div class="col-form-label" style="color:red;">{{$errors->first('username')}}</div>
								@endif
								<div id="error_username" class="col-form-label" style="color:red; display:none;"></div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="password">Contraseña:</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="" title="Contraseña del Alumno">
								<div class="col-form-label"> * Si deja la contraseña en blanco, no se cambiará</div>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="phone">Teléfono:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="phone" name="phone" placeholder="Ej. 8341234567" value="{{ old('phone')==""?$user->phone:old('phone') }}" title="Teléfono del Alumno">
								@if ($errors->has('phone'))
									<div class="col-form-label" style="color:red;">{{$errors->first('phone')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="academic_situation">Situación Académica:</label>
							<div class="col-sm-10">
								<select id="academic_situation" name="academic_situation" class="select2_basic" title="Situación académica actual del alumno">
									<option value="0" {{ ((old("academic_situation") == '0') || (old("academic_situation")=="" && $students->academic_situation=="0")) ? "selected":"" }}>Regular</option>
									<option value="1" {{ ((old("academic_situation") == '1') || (old("academic_situation")=="" && $students->academic_situation=="1")) ? "selected":"" }} >Especial</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="tutor_user_id">Tutor:</label>
							<div class="col-sm-10">
								<select id="tutor_user_id" name="tutor_user_id" class="select2_basic" title="Tutor que se asignara al alumno">
									@foreach ($tutors as $teacher)
										@if(old('tutor_user_id')!="")
											@if (old('tutor_user_id') == $teacher->num_employee)
													<option selected value='{{ $teacher->num_employee }}'>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
											@else
												<option value='{{ $teacher->num_employee }}'>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
											@endif
										@else
											@if ($students->tutor_user_id == $teacher->num_employee)
													<option selected value='{{ $teacher->num_employee }}'>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
											@else
												<option value='{{ $teacher->num_employee }}'>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
											@endif
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="career_id">Carrera:</label>
							<div class="col-sm-10">
								<select id="career_id" name="career_id" class="select2_basic" title="Carrera a la que pertenecerá el alumno">
									@foreach ($careers as $career)
										@if(old('career_id')!="")
											@if (old('career_id') == $career->id)
													<option selected value='{{ $career->id }}'>{{ $career->name }}</option>
											@else
												<option value='{{ $career->id }}'>{{ $career->name }}</option>
											@endif
										@else
											@if ($students->career_id == $career->id)
													<option selected value='{{ $career->id }}'>{{ $career->name }}</option>
											@else
												<option value='{{ $career->id }}'>{{ $career->name }}</option>
											@endif
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Imagen:</label>
							<div style="margin-top:10px" class="col-sm-3">
								<img id="modal_img" style="border-radius: 15px; margin-top: 0px;width:100%;" src='{{ asset($user->image_url)}}' alt="{{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}" class="img-fluid p-b-10">
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
						<br>
						<center>
							<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left" title="Regresar a la página anterior"></i>Regresar</a>
							<button type="submit" title="Modificar el alumno" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Alumno</button>
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
		//Elementos a verificar sus modificaciones en la vista
		elements_id=[
			$('#university_id'),
			$('#first_name'),
			$('#last_name'),
			$('#second_last_name'),
			$('#username'),
			$('#password'),
			$('#academic_situation'),
			$('#tutor_user_id'),
			$('#career_id')
		];

		original_values = [
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
