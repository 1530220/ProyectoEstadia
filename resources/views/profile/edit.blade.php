@extends('layouts.app')

@section('title',"Bolsa Trabajo - Usuario: {$user->university_id}")

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
	<!-- Page-body start -->
	<div class="page-body">
		<!--profile cover start-->
		<div class="row">
			<div class="col-lg-12">
				<div class="cover-profile">
					<div class="profile-bg-img">
						<img class="profile-bg-img img-fluid" src="{{asset('assets/images/user-profile/banner4.jpg')}}" style="width: 1660px; height: 300px;" alt="bg-img">
						<div class="card-block user-info">
							<div class="col-md-12">
								<div class="media-left">
									<a class="profile-image">
										<img id="modal_img" src='{{ asset($user->image_url)}}' alt="{{ asset($user->image_url)}} {{ $user->title }} {{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}" class="img-fluid p-b-10 rounded" style="width:150px; height: 150px;">
										<div id="modal_show_img" class="modal">
											<span class="close">&times;</span>
											<img class="modal-content" id="img_content">
											<div id="caption"></div>
										</div>
									</a>
								</div>
								<div class="media-body row">
									<div class="col-lg-12">
										<div class="user-title">
											<h2>{{ $user->title }} {{ $user->first_name }}</h2>
											<h2>{{ $user->last_name }} {{ $user->second_last_name }}</h2>
											@switch($user->type)
												@case(1)
												<span class="text-white">Administrador</span>
												@break
												@case(2)
												<span class="text-white">Usuario Dpto. Tutorías</span>
												@break
												@case(3)
												<span class="text-white">Alumno</span>
												@break
												@case(4)
												<span class="text-white">Profesor</span>
												@break
												@case(5)
												<span class="text-white">Tutor</span>
												@break
												@case(6)
												<span class="text-white">Usuario Dpto. Salud</span>
												@break
												@case(7)
												<span class="text-white">Usuario Dpto. Psicología</span>
												@break
												@endswitch
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--profile cover end-->
		<div class="row">
			<div class="col-lg-12">
				<!-- tab header end -->
				<!-- tab content start -->
				<div class="tab-content">
					<!-- tab panel personal start -->
					<div class="tab-pane active" id="personal" role="tabpanel">
						<!-- personal card start -->
						<div class="card">


							<div class="card-block">
								<h4 class="sub-title"><strong>Información General</strong></h4>
								<form id="form" method="POST" action="{{ route('profile.update_own_profile') }}" files="true" enctype="multipart/form-data">
									{{ method_field('PUT') }}
									{!! csrf_field() !!}



									<div class="view-info">
										<div class="row">
											@if($user->type!=3 && $user->type!=4 && $user->type!=5 && $user->type!=6 && $user->type!=7)
												<div class="col-lg-12 col-xl-6">
													<div class="table-responsive">
														<table class="table m-0">
															<tbody>
																@if (!(is_null($user->title)))
																<tr style="border-style:hidden;">
																	<th scope="row">Título: </th>
																	<td>{{ $user->title }}</td>
																</tr>
																<tr>
																	@else
																<tr style="border-top-style:hidden;">
																	@endif
																	<th scope="row">Nombre(s): </th>
																	<td>
																		<input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre(s)" value="{{ old('first_name', $user->first_name) }}">
																		@if ($errors->has('first_name'))
																		<div class="col-form-label" style="color:red;">{{$errors->first('first_name')}}</div>
																		@endif
																	</td>
																</tr>
																<tr>
																	<th scope="row">Apellido Paterno: </th>
																	<td>
																		<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido Paterno" value="{{ old('last_name', $user->last_name) }}">
																		@if ($errors->has('last_name'))
																		<div class="col-form-label" style="color:red;">{{$errors->first('last_name')}}</div>
																		@endif
																	</td>
																</tr>
																@if (!(is_null($user->second_last_name)))
																<tr>
																	<th scope="row">Apellido Materno: </th>
																	<td><input type="text" class="form-control" id="second_last_name" name="second_last_name" placeholder="Apellido Materno" value="{{ old('second_last_name', $user->second_last_name) }}">
																		<div class="col-form-label"> * En caso, de solo tener un apellido, solo llene el campo de Apellido Paterno</div>
																	</td>
																</tr>
																@endif
																@if ($user->type==4 || $user->type==5)
																<tr>
																	<th scope="row">Carrera: </th>
																	<td>{{ $career->name }}</td>
																</tr>
																@endif
															</tbody>
														</table>
													</div>
												</div>
											@endif
											<!-- end of table col-lg-6 -->
											@if($user->type==3 || $user->type==4 || $user->type==5 || $user->type==6 || $user->type==7)
												<div class="col-lg-12 col-xl-12">

											@else
												<div class="col-lg-12 col-xl-6">
											@endif
												<div class="table-responsive">
													<table class="table">
														<tbody>
															@if($user->type!=3 && $user->type!=4 && $user->type!=5 && $user->type!=6 && $user->type!=7 )
																<tr>
																	@if($user->type==3)
																		<th scope="row">Matricula: </th>
																	@else
																		<th scope="row">Num. Empleado: </th>
																	@endif
																		<td>
																			<input type="text" class="form-control" id="university_id" name="university_id" placeholder="Ej. 1530001" value="{{ old('university_id', $user->university_id) }}">
																			@if ($errors->has('university_id'))
																			<div class="col-form-label" style="color:red;">{{$errors->first('university_id')}}</div>
																			@endif
																			<div id="error_university_id" class="col-form-label" style="color:red; display:none;"></div>
																		</td>
																</tr>
															@endif
															@if($user->type==3)
																<tr style="border-top-style:hidden;">
															@else
																<tr>
															@endif
																<th scope="row">Username: </th>
																<td>
																	<input type="text" class="form-control" id="username" name="username" placeholder="Ej. erodriguezd" value="{{ old('username', $user->username) }}">
																	@if ($errors->has('username'))
																	<div class="col-form-label" style="color:red;">{{$errors->first('username')}}</div>
																	@endif
																	<div id="error_username" class="col-form-label" style="color:red; display:none;"></div>
																</td>
															</tr>
															<tr>
																<th scope="row">Contraseña: </th>
																<td>
																	<input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
																	@if ($errors->has('password'))
																	<div class="col-form-label" style="color:red;">{{$errors->first('password')}}</div>
																	@endif
																	<div class="col-form-label"> * Si deja la contraseña en blanco, no se cambiará</div>
																</td>
															</tr>
															<tr>
																<th scope="row">Tipo de Usuario: </th>
																@switch($user->type)
																	@case(1)
																	<td>Administrador</td>
																	@break
																	@case(2)
																	<td> Usuario Dpto. Tutorías</td>
																	@break
																	@case(3)
																	<td>Alumno</td>
																	@break
																	@case(4)
																	<td>Profesor</td>
																	@break
																	@case(5)
																	<td>Tutor</td>
																	@break
																	@case(6)
																	<td> Usuario Dpto. Salud </td>
																	@break
																	@case(7)
																	<td> Usuario Dpto. Psicología </td>
																	@break
																	@endswitch
															</tr>
														</tbody>
													</table>

												</div>

											</div>
											<!-- end of table col-lg-6 -->
											<table class="table m-0">
												<tr>
													<th scope="row"></th>
													<td>
														<img id="modal_img" style="border-radius: 15px; max-width:300px" src='{{ asset($user->image_url)}}' alt="{{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}" class="img-fluid p-b-10">
														<input type="text" name="image_2" class="form-control" hidden value="{{ $user->image_url }}">
														<div id="modal_show_img" class="modal">
															<span class="close">&times;</span>
															<img class="modal-content" id="img_content">
															<div id="caption"></div>
														</div>
														<div class="col-form-label" style="align:justify;"> * Vista de la imagen actual.</div>
													</td>
													<td>
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
													</td>
												</tr>
											</table>
										</div>
										<!-- end of row -->
									</div><hr>
									<!-- end of general info -->
									<center>
									<div class="row">
										<div class="col-lg-2"></div>
										<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn col-lg-3 btn-inverse"><i class="icofont icofont-arrow-left"></i>Regresar</a>
										<div class="col-lg-1"></div>
										<button type="submit" class="btn  col-lg-3  btn-success"><i class="icofont icofont-refresh"></i>Actualizar Perfil</button>
									</div>
									</center>
								</form>
							</div>
							<!-- end of col-lg-12 -->
						</div>
						<!-- end of row -->
					</div>
					<!-- end of view-info -->
				</div>
				<!-- end of card-block -->
			</div>
		</div>
		<!-- tab pane personal end -->
	</div>
	<!-- Page-body end -->

	@endsection
