@extends('layouts.app')

@section('title',"SIITA - Carreras")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-download" style="background-color:gray;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Reportes de Tutorados</h4>
						<span style="text-transform: none;">Realizar reportes mediante filtros.</span>
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
						<li class="breadcrumb-item">Reportes de Tutorados
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
						<h4 class="sub-title"><i class="icofont icofont-filter"></i> Filtros</h4>
						<form id="form" method="POST" action="{{ route('reports.tutorados') }}">
							{!! csrf_field() !!}

							<div class="row">
								<div class="col-sm-12 col-xl-4">
										<p>Carrera: </p>
										<select id="career_id" name="career_id" class="select2_basic" title="Carrera a la que pertenecerá el alumno">
											@foreach ($careers as $career)
												<option value="{{ $career->id }}" {{ (old("career_id") == $career->id ? "selected":"") }}>{{ $career->name }}</option>
											@endforeach
										</select>
								</div>
								<div class="col-sm-12 col-xl-4">
										<p>Rango de Fecha: </p>
										<div class="input-daterange input-group" id="datepicker">
												<input type="text" style="height: 46px;" class="input-sm form-control" name="start" />
												<span class="input-group-addon">to</span>
												<input type="text" style="height: 46px;" class="input-sm form-control" name="end" />
										</div>
								</div>
									<div class="col-sm-12 col-xl-4">
											<p>Rango de Fecha: </p>
											<div class="input-daterange input-group" id="datepicker">
													<input type="text" style="height: 46px;" class="input-sm form-control" name="start" />
													<span class="input-group-addon">to</span>
													<input type="text" style="height: 46px;" class="input-sm form-control" name="end" />
											</div>
									</div>
							</div>

							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Carrera</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
