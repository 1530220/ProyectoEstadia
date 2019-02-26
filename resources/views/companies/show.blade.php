@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Detalles de Empresa: {$company->name}")

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
					<i class="icofont icofont-eye-alt bg-c-pink"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Detalles de la Empresa: {{ $company->name }} </h4>
						<span style="text-transform: none;">Mostrando todos los detalles de la empresa seleccionada.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('companies.list') }}">Empresas</a>
						</li>
						<li class="breadcrumb-item">Detalles de Empresa
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
										@if($company->deleted==1)
											<div class="alert alert-danger icons-alert">
												<p><strong>Empresa Eliminada</strong></p>
												<p> Esta empresa esta actualmente eliminada, restaurela para que pueda hacer uso de el en el sistema.</p>
											</div>
										@endif
										<div class="row">
											<div class="col-sm-3">
												<center>
													<img id="modal_img" src='{{ asset($company->image_url)}}' alt="{{ asset($company->image_url) }}" class="img-fluid p-b-10 rounded" style="width:100%;max-width:300px">
													<div id="modal_show_img" class="modal">
														<span class="close">&times;</span>
														<img class="modal-content" id="img_content">
														<div id="caption"></div>
													</div>
													<div class="contact-icon">
														@if($company->deleted==0)
															@if (Auth::user()->type == 1 || Auth::user()->type == 2)
																<form id="form" name="form" action="{{ route('companies.destroy', ['id' => $company->id])}}" method="POST">
																	{{ csrf_field() }}
																	{{ method_field('DELETE') }}
																	<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i></button></a>
																	<a href="{{ route('companies.edit', ['id' => $company->id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
																	<button onclick="archiveFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Eliminar"><span class="icofont icofont-ui-delete"></span></button>
																</form>
															@else
																<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i>Regresar</button></a>
															@endif
														@else
															@if (Auth::user()->type == 1 || Auth::user()->type == 2)
																<form id="form" name="form" action="{{ route('companies.restore', ['id' => $company->id]) }}" method="POST">
																	{{ csrf_field() }}

																	<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i></button></a>
																	<a href="{{ route('companies.edit', ['id' => $company->id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
																	<button onclick="restoreFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Restaurar"><span class="fas fa-reply"></span></button>
																</form>
															@else
																<a style="color:white; " onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i>Regresar</span></button></a>
															@endif
														@endif
													</div>
												</center>
											</div>
											<div class="col-sm-9 user-detail">
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-id-card"></i>ID :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30"><strong>{{ $company->id }}</strong></h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-user"></i>Nombre :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $company->name }} </h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Telefono :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $company->phone }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-chart-bar-graph"></i>Código Postal :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $company->zip }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-email"></i>Colonia :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $company->colony }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="fa fa-phone-square"></i>Calle :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $company->street }}</h6>
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



