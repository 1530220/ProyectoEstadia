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
										<img id="modal_img" src='{{ asset($user->image_url)}}' alt="{{ $user->title }} {{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}" class="img-fluid p-b-10 rounded" style="width:150px; height: 150px;">
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
												
												@case(3)
												<span class="text-white">Alumno</span>
												@break
												
												@case(5)
												<span class="text-white">Tutor</span>
												@break
												
												@endswitch
										</div>
									</div>
									<div>
										<div class="pull-right cover-btn">
											<a href="{{ route('profile.edit') }}" title="Editar Perfil"><button type="button" class="btn btn-inverse m-r-10 m-b-5"><i class="icofont icofont-ui-edit"></i> Editar Perfil</button></a>
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
							<div class="card-header">
								<h4 class="sub-title"><strong>Información General</strong></h4>
							</div>
							<div class="card-block">
								<div class="view-info">
									<div class="row">
										<div class="col-lg-12">
											<div class="general-info">
												<div class="row">
													<div class="col-lg-12 col-xl-6">
														<div class="table-responsive">
															<table class="table m-0">
																<tbody>
																	@if (!(is_null($user->title)))
																	<tr>
																		<th scope="row">Título: </th>
																		<td>{{ $user->title }}</td>
																	</tr>
																	@endif
																	<tr>
																		<th scope="row">Nombre(s): </th>
																		<td>{{ $user->first_name }}</td>
																	</tr>
																	<tr>
																		<th scope="row">Apellido Paterno: </th>
																		<td>{{ $user->last_name }}</td>
																	</tr>
																	@if (!(is_null($user->second_last_name)))
																	<tr>
																		<th scope="row">Apellido Materno: </th>
																		<td>{{ $user->second_last_name }}</td>
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
													<!-- end of table col-lg-6 -->
													<div class="col-lg-12 col-xl-6">
														<div class="table-responsive">
															<table class="table">
																<tbody>
																	<tr>
																		@if($user->type==3)
																			<th scope="row">Matricula: </th>
																			@else
																			<th scope="row">Num. Empleado: </th>
																			@endif
																			<td>{{ $user->university_id }}</td>
																	</tr>
																	<tr>
																		<th scope="row">Correo Electrónico: </th>
																		<td>{{ $user->email }}</td>
																	</tr>
																	<tr>
																		<th scope="row">Username: </th>
																		<td>{{ $user->username }}</td>
																	</tr>
																	<tr>
																		<th scope="row">Tipo de Usuario: </th>
																		@switch($user->type)
																			@case(1)
																			<td>Administrador</td>
																			@break
																			@case(2)
																			<td>Usuario Dpto. Tutorías</td>
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
																			<td>Usuario Dpto. Salud</td>
																			@break
																			@case(7)
																			<td>Usuario Dpto. Psicología</td>
																			@break
																			@endswitch
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<!-- end of table col-lg-6 -->
												</div>
												<!-- end of row -->
											</div>
											<!-- end of general info -->
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
				<!-- tab content end -->
			</div>
		</div>
	</div>
	<!-- Page-body end -->

	@endsection
