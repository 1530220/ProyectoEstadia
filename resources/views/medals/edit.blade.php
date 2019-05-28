@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Medalla")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:#5e1287;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Editar la Medalla: {{$medal->id}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de medallas.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('medals.list') }}">Medallas</a>
						</li>
						<li class="breadcrumb-item">Modificar Medalla
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
						@if($medal->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Medalla Eliminada</strong></p>
								<p> Esta medalla esta actualmente eliminada, restaurela para que pueda hacer uso de el en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("medals/{$medal->id}") }}">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="sector_id">ID Medalla:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="medal_id" name="medal_id" placeholder="Ej. 10" value="{{ old('sector_id', $medal->id) }}" title="ID de la Medalla">
									@if ($errors->has('medal_id'))
										<div id="error_medal_id" class="col-form-label" style="color:red;">{{$errors->first('medal_id')}}</div>
									@else
										<div id="error_medal_id" class="col-form-label" style="color:red; display:none;"></div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name" placeholder="Ej. Oracle ORO" value="{{ old('name', $medal->name) }}" title="Nombre de la Medalla">
									@if ($errors->has('name'))
										<div id="error_name" class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="description">Descripción:</label>
								<div class="col-sm-10">
									<textarea rows="5" class="form-control" name="description" placeholder="Ej. Medalla obtenida por acreditar asignaturas de base de datos con excelente promedio"  title="Descripción de la Medalla">{{ old('description', $medal->description) }}</textarea>
									@if ($errors->has('description'))
										<div id="error_description" class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									@endif
								</div>
							</div>
							<br>
							<div class="form-group row form-radio">
								<div class="col-sm-2 col-form-label">Medalla:</div>
								<div class="col-sm-10">
									<div class="radio radio-inverse radio-inline">
										<label>
											<input type="radio" name="medal_img" 
											@if ($medal->image =='/img/medals/bronce1.jpg')
												checked = "checked"
											@endif
											value="/img/medals/bronce1.jpg">
											<i class="helper"></i>
											<img src="/img/medals/bronce1.jpg" alt="medalla-bronce" width="215" title="Medalla de bronce" >

										</label>
									</div>
									<div class="radio radio-inverse radio-inline">
										<label>
											<input type="radio" name="medal_img" 
											@if ($medal->image =='/img/medals/plata1.jpg')
												checked = "checked"
											@endif
											value="/img/medals/plata1.jpg">
											<i class="helper"></i>
											<img src="/img/medals/plata1.jpg" alt="medalla-plata" width="215" title="Medalla de plata" >
										</label>
									</div>
									<div class="radio radio-inverse radio-inline">
										<label>
											<input type="radio" name="medal_img"
											@if ($medal->image =='/img/medals/oro1.jpg')
												checked = "checked"
											@endif
											value="/img/medals/oro1.jpg">
											<i class="helper"></i>
											<img src="/img/medals/oro1.jpg" alt="medalla-oro" width="215" title="Medalla de oro">
										</label>
									</div>
								</div>
							</div>
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Medalla</button>
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
			$('#medal_id'),
			$('#description'),
		];

		original_values = [
			['id', $('#medal_id').val()],
		];

		unique_elements = [
			[$('#medal_id'), 'id', 'medals', original_values, $('#error_medal_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_medal_id'),
		]

		checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
	});
</script>
@endsection
