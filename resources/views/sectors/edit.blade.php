@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Sector")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:slateblue;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Editar el Sector: {{$sector->id}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de sectores.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('sectors.list') }}">Sectores</a>
						</li>
						<li class="breadcrumb-item">Modificar Sector
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
						@if($sector->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Sector Eliminado</strong></p>
								<p> Este sector esta actualmente eliminado, restaurelo para que pueda hacer uso de el en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("sectors/{$sector->id}") }}">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="sector_id">ID Sector:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="sector_id" name="sector_id" placeholder="Ej. 10" value="{{ old('sector_id', $sector->id) }}" title="ID del Sector">
									@if ($errors->has('sector_id'))
										<div id="error_sector_id" class="col-form-label" style="color:red;">{{$errors->first('sector_id')}}</div>
									@else
										<div id="error_sector_id" class="col-form-label" style="color:red; display:none;"></div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name" placeholder="Ej. Ingenieria y Tecnologia" value="{{ old('name', $sector->name) }}" title="Nombre del Sector">
									@if ($errors->has('name'))
										<div id="error_name" class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="description">Descripción:</label>
								<div class="col-sm-10">
									<textarea rows="5" class="form-control" name="description" placeholder="Ej. Sector donde se aplica conocimiento obtenido a través de la ciencia produciendo resultados prácticos"  title="Descripción del Sector">{{ old('description', $sector->description) }}</textarea>
									@if ($errors->has('description'))
										<div id="error_description" class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									@endif
								</div>
							</div>
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Sector</button>
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
			$('#sector_id'),
			$('#description'),
		];

		original_values = [
			['id', $('#sector_id').val()],
		];

		unique_elements = [
			[$('#sector_id'), 'id', 'sectors', original_values, $('#error_sector_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_sector_id'),
		]

		checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
	});
</script>
@endsection
