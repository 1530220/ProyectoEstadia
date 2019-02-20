@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Medalla")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color:#5e1287;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Crear Medalla</h4>
						<span style="text-transform: none;">Llene los campos en la parte inferior para registrar una nueva medalla.</span>
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
						<li class="breadcrumb-item">Crear Medalla
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
						<form id="form" method="POST" action="{{ route('medals.list') }}">
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Medalla:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID de la Medalla">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Oracle ORO" value="{{ old('name') }}" title="Nombre de la Medalla">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="description">Descripción:</label>
								<div class="col-sm-10">
									<textarea rows="5" class="form-control" name="description" maxlength="500" placeholder="Ej. Medalla obtenida por acreditar asignaturas de base de datos con excelente promedio " value="{{ old('description') }}" title="Descripción de la Medalla"></textarea>
									@if ($errors->has('description'))
										<div class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									@endif
								</div>
							</div>
							<br>
							<div class="form-group row form-radio">
								<div class="col-sm-2 col-form-label">Medalla:</div>
								<div class="col-sm-10">
									<div class="radio radio-inverse radio-inline">
										<label>
											<input type="radio" name="medal_img" value="/img/medals/bronce1.jpg">
											<i class="helper"></i>
											<img src="/img/medals/bronce1.jpg" alt="medalla-bronce" width="215" title="Medalla de bronce" >

										</label>
									</div>
									<div class="radio radio-inverse radio-inline">
										<label>
											<input type="radio" name="medal_img" value="/img/medals/plata1.jpg">
											<i class="helper"></i>
											<img src="/img/medals/plata1.jpg" alt="medalla-plata" width="215" title="Medalla de plata" >
										</label>
									</div>
									<div class="radio radio-inverse radio-inline">
										<label>
											<input type="radio" name="medal_img" checked="checked" value="/img/medals/oro1.jpg">
											<i class="helper"></i>
											<img src="/img/medals/oro1.jpg" alt="medalla-oro" width="215" title="Medalla de oro">
										</label>
									</div>
								</div>
							</div>


							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Medalla</button>
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
		error_divs = [
			$('#error_id'),
		];
		verify_column($('#id'), 'id', 'medals', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'medals', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
	</script>
@endsection
