@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Habilidad")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:firebrick;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Editar la Habilidad: {{$skill->id}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de habilidades.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('skills.list') }}">Habilidades</a>
						</li>
						<li class="breadcrumb-item">Modificar Habilidad
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
						@if($skill->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Habilidad Eliminada</strong></p>
								<p> Esta habilidad esta actualmente eliminada, restaurela para que pueda hacer uso de ella en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("skills/{$skill->id}") }}">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="skill_id">ID Habilidad:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="skill_id" name="skill_id" placeholder="Ej. 10" value="{{ old('skill_id', $skill->id) }}" title="ID de la Habilidad">
									@if ($errors->has('skill_id'))
										<div id="error_skill_id" class="col-form-label" style="color:red;">{{$errors->first('skill_id')}}</div>
									@else
										<div id="error_skill_id" class="col-form-label" style="color:red; display:none;"></div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name" placeholder="Ej. Programacion web" value="{{ old('name', $skill->name) }}" title="Nombre de la Habilidad">
									@if ($errors->has('name'))
										<div id="error_name" class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
							
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Habilidad</button>
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
			$('#skill_id'),
			$('#abbreviation'),
		];

		original_values = [
			['id', $('#skill_id').val()],
		];

		unique_elements = [
			[$('#skill_id'), 'id', 'skills', original_values, $('#error_skill_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_skill_id'),
		]

		checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
	});
</script>
@endsection
