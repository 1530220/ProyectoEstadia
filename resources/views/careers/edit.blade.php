@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Carrera")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit bg-c-yellow"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Editar la Carrera: {{$career->name}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de carreras.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('careers.list') }}">Carreras</a>
						</li>
						<li class="breadcrumb-item">Modifcar Carrera
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
						@if($career->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Carrera Eliminada</strong></p>
								<p> Esta carrera esta actualmente eliminada, restaurela para que pueda hacer uso de ella en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("careers/{$career->id}") }}">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="career_id">ID Carrera:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="career_id" name="career_id" placeholder="Ej. 10" value="{{ old('career_id', $career->id) }}" title="ID de la Carrera">
									@if ($errors->has('career_id'))
										<div id="error_career_id" class="col-form-label" style="color:red;">{{$errors->first('career_id')}}</div>
									@else
										<div id="error_career_id" class="col-form-label" style="color:red; display:none;"></div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name" placeholder="Ej. Ingeniería en Sistemas" value="{{ old('name', $career->name) }}" title="Nombre de la Carrera">
									@if ($errors->has('name'))
										<div id="error_name" class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="abbreviation">Abreviatura</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="abbreviation" name="abbreviation" placeholder="Ej. ITI" value="{{ old('abbreviation', $career->abbreviation) }}" title="Abreviatura de la carrera">
									@if ($errors->has('abbreviation'))
										<div id="error_abbreviation" class="col-form-label" style="color:red;">{{$errors->first('abbreviation')}}</div>
									@endif
								</div>
							</div>
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Carrera</button>
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
			$('#name'),
			$('#career_id'),
			$('#abbreviation'),
		];

		original_values = [
			['id', $('#career_id').val()],
		];

		unique_elements = [
			[$('#career_id'), 'id', 'careers', original_values, $('#error_career_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_career_id'),
		]

		checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
	});
</script>
@endsection
