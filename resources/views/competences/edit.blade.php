@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Competencia")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:darkcyan;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Editar la Competencia: {{$competence->id}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de competencias.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('competences.list') }}">Competencias</a>
						</li>
						<li class="breadcrumb-item">Modificar Competencia
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
						@if($competence->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Competencia Eliminada</strong></p>
								<p> Esta competencia esta actualmente eliminada, restaurela para que pueda hacer uso de ella en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("competences/{$competence->id}") }}">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="competence_id">ID Competencia:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="competence_id" name="competence_id" placeholder="Ej. 10" value="{{ old('competence_id', $competence->id) }}" title="ID de la Competencia">
									@if ($errors->has('competence_id'))
										<div id="error_competence_id" class="col-form-label" style="color:red;">{{$errors->first('competence_id')}}</div>
									@else
										<div id="error_competence_id" class="col-form-label" style="color:red; display:none;"></div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name" placeholder="Ej. Liderazgo" value="{{ old('name', $competence->name) }}" title="Nombre de la Competencia">
									@if ($errors->has('name'))
										<div id="error_name" class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
							
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Competencia</button>
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
			$('#competence_id'),
			$('#abbreviation'),
		];

		original_values = [
			['id', $('#competence_id').val()],
		];

		unique_elements = [
			[$('#competence_id'), 'id', 'competences', original_values, $('#error_competence_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_competence_id'),
		]

		checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
	});
</script>
@endsection
