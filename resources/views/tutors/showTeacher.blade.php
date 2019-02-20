@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Profesor: {$teacher->university_id}")

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
					<i class="icofont icofont-eye-alt bg-c-green"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Detalles del Profesor: {{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</h4>
						<span style="text-transform: none;">Se muestran los detalles del profesor con numero de empleado: {{ $teacher->university_id }}.</span>
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
						<li class="breadcrumb-item">Detalles de Profesor
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Page-header end -->


	<!-- Page body start -->
	<div class="page-body">
		<div class="row">
			<div class="col-sm-12">
				<!-- Basic Form Inputs card start -->
				<div class="card">
					<div class="card-block">
						<h4 class="sub-title">Información General</h4>
						<div class="page-body">
							<div class="row">
								<div class="col-md-12 col-xl-12 ">
									<div class="card-block user-detail-card">
										@if($teacher->user_deleted==1)
											<div class="alert alert-danger icons-alert">
												<p><strong>Profesor Eliminado</strong></p>
												<p> Este profesor esta actualmente eliminado, restaurelo para que pueda hacer uso de el en el sistema.</p>
											</div>
										@endif
										<div class="row">
											<div class="col-sm-4">
												<center>
													<img id="modal_img" src='{{ asset($teacher->image)}}' alt="{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}" class="img-fluid p-b-10 rounded" style="width:100%;max-width:300px">

													<div id="modal_show_img" class="modal">
														<span class="close">&times;</span>
														<img class="modal-content" id="img_content">
														<div id="caption"></div>
													</div>
													<div class="contact-icon">
														@if($teacher->user_deleted=="0")
															<form id="form" name="form" action="{{ route('teachers.destroy', ['id' => $teacher->user_id])}}" method="POST">
																{{ csrf_field() }}
																{{ method_field('DELETE') }}
																<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i></button></a>
																<a href="{{ route('teachers.edit', ['id' => $teacher->user_id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
																<button onclick="archiveFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Eliminar"><span class="icofont icofont-ui-delete"></span></button>

																<a href="{{ route('tutors.create', ['id' => $teacher->user_id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Asignar Como Tutor"><i class="fas fa-level-up-alt"></i></i></button></a>
															</form>
														@else
															<form id="form" name="form" action="{{ route('teachers.restore', ['id' => $teacher->user_id]) }}" method="POST">
																{{ csrf_field() }}
																<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i></button></a>
																<a href="{{ route('teachers.edit', ['id' => $teacher->user_id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
																<button onclick="restoreFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Restaurar"><span class="fas fa-reply"></span></button>

																<a href="{{ route('tutors.create', ['id' => $teacher->user_id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Asignar Como Tutor"><i class="fas fa-level-up-alt"></i></i></button></a>
															</form>
														@endif
													</div>
												</center>
											</div>
											<div class="col-sm-8 user-detail">
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-id-card"></i>Num. de Empleado :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30"><strong>{{ $teacher->university_id }}</strong></h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-user"></i>Nombre :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Carrera :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $teacher->name }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-keyboard"></i>Username :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $teacher->username }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-email"></i>Email:</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $teacher->email }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-users-alt-5"></i>Tipo de Usuario :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">Profesor</h6>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
