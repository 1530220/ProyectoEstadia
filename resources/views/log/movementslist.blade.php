@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Historial de Movimientos")

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
						<h4 style="text-transform: none;">Historial de Movimientos</h4>
						<span style="text-transform: none;">Muestra el historial de movimientos de los usuarios registrados en la Bolsa de Trabajo.</span>
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
						<li class="breadcrumb-item">Historial de Movimientos
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
						<div class="dt-responsive table-responsive">
							<table style="width:100%;" id="custom_datatable" class="table table-striped table-bordered">
								@if ($sessions->isNotEmpty())
								<thead id="table_header">
									<tr>
										<th class="all" scope="col" style="width: 10;">ID</th>
										<th scope="col" style="width: 70%;">Mensaje</th>
										<th scope="col" style="width: 20%;">Fecha</th>
										<th class="all" scope="col" style="width: 0%;">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($sessions as $session)
									<tr>
											<th scope="row">{{ $session->id }}</th>
											<td>{{ $session->message }}</td>
											<td>{{ $session->date }}</td>
											<td>
											<center>
												<a href="{{ route('movements.show', ['id' => $session->id]) }}" class="btn btn-warning" title="Ver Detalles" style="margin: 5px;"><span class="icofont icofont-eye-alt"></span></a>
											</center>
											</td>
									</tr>
									@endforeach
								</tbody>
								@else
								<center>
										<p>No hay movimientos registrados</p>
								</center>
								@endif
								<tfoot>
									<tr id="table_footer">
										<th style="padding-right: 2.8%" scope="col">ID</th>
										<th style="padding-right: 2.8%" scope="col">Mensaje</th>
										<th style="padding-right: 2.8%" scope="col">Fecha</th>
										<th style="padding-right: 2.8%" scope="col">Acciones</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascriptcode')
<script>
	var button = ""{{--'<a href="{{ route('careers.create') }}"><button class="btn btn-success" style="float:right"><i class="fa fa-plus"></i>Agregar Carrera</button></a>'--}};
	applyStyleToDatatable(button, 'Buscar en historial de movimientos...',1,'desc');
</script>
@endsection
