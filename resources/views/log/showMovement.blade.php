@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Detalles: {$log[0]->id}")

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
					<i class="fa fa-history" style="background-color:#7f0000;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Detalles de Tipo Movimiento</h4>
						<span style="text-transform: none;">Formulario para la visualización de datos de un movimiento.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('log.movementslist') }}">Historial de Movimientos</a>
						</li>
						<li class="breadcrumb-item">Detalles del Movimiento
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Page-header end -->

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
										<div class="row">
											<div class="col-sm-12 user-detail">
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-barcode"></i>ID de Registro:</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30"><strong>{{ $log[0]->id }}</strong></h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-v-card"></i>ID de Usuario:</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $user->id }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-id-card"></i>Número de Empleado:</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $user->university_id }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-user"></i>Nombre de Usuario:</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30"><a href="{{ route('users.show', ['id' => $user->id]) }}">{{ $user->first_name }} {{ $user->last_name }} {{ $user->second_last_name }}</a></h6>
													</div>
												</div>
												<div class="row">
														@switch($log[0]->action)
															@case(3)
															<div class="col-sm-4">
																<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-add"></i>Acción :</h6>
															</div>
															<div class="col-sm-8">
																<h6 class="m-b-30">Agregar</h6>
															@break
															@case(4)
															<div class="col-sm-4">
																<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-edit"></i>Acción :</h6>
															</div>
															<div class="col-sm-8">
																<h6 class="m-b-30">Modificar</h6>
															@break
															@case(5)
															<div class="col-sm-4">
																<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-delete"></i>Acción :</h6>
															</div>
															<div class="col-sm-8">
																<h6 class="m-b-30">Eliminar</h6>
															@break
															@case(6)
															<div class="col-sm-4">
																<h6 class="f-w-400 m-b-30"><i class="icofont icofont-share-alt"></i>Acción :</h6>
															</div>
															<div class="col-sm-8">
																<h6 class="m-b-30">Restaurar</h6>
															@break
														@endswitch
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-clock-time"></i>Fecha y Hora :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $log[0]->date }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-messaging"></i>Mensaje :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $log[0]->message }}</h6>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<center>
							<br /><br />
							<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
						</center>
					</div>
@endsection
