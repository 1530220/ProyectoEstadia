@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Registrar Proyecto")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus bg-c-yellow"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Registrar Proyecto</h4>
						<span style="text-transform: none;">Llene los campos en la parte inferior para registrar un nuevo proyecto.</span>
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
						<li class="breadcrumb-item">Registrar Proyecto
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
						<form id="form" method="POST" action="{{ route('projects.list') }}">
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Proyecto:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID del Proyecto">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
									<label class="col-sm-2 col-form-label" for="matricula">Alumno:</label>
									<div class="col-sm-10">
										<select class="form-control" name="matricula" id="matricula">
											@foreach ($students as $student)
												<option value="{{ $student->university_id}}"> {{$student->university_id}} {{$student->first_name}} {{$student->last_name}} {{$student->second_last_name}}</option>
											@endforeach
										</select>
									</div>
								</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Diseño e implementación de base de datos Oracle" value="{{ old('name') }}" title="Nombre del Proyecto">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
                            </div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="inicio">Fecha Inicio:</label>
								<div class="col-sm-4">
									<input class="form-control" type="date" name="inicio" title="Fecha de Inicio del Proyecto" required/>
									@if ($errors->has('inicio'))
										<div class="col-form-label" style="color:red;">{{$errors->first('inicio')}}</div>
									@endif
								</div>

								<label class="col-sm-2 col-form-label" for="fin">Fecha Finalización:</label>
								<div class="col-sm-4">
									<input class="form-control" type="date" name="fin" title="Fecha de Finalización del Proyecto" required/>
									@if ($errors->has('fin'))
										<div class="col-form-label" style="color:red;">{{$errors->first('fin')}}</div>
									@endif
								</div>
                            </div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="description">Descripción:</label>
								<div class="col-sm-10">
									<textarea rows="5" class="form-control max-textarea" maxlength="500" name="description" placeholder="Ej. Proyecto donde se tuvo que analizar información que requiere una empresa para asi poder optar por un diseño de base de datos normalizada y proceder a implementarla" value="{{ old('description') }}" title="Descripción del Proyecto"></textarea>
									@if ($errors->has('description'))
										<div class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="lider">Líder del Proyecto:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="lider" placeholder="Ej. M.S.I. Mario Humberto Rodriguez" value="{{ old('lider') }}" title="Líder del Proyecto">
									@if ($errors->has('lider'))
										<div class="col-form-label" style="color:red;">{{$errors->first('lider')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="empresa">Empresa / Institución:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="empresa" placeholder="Ej. Universidad Politécnica de Victoria" value="{{ old('empresa') }}" title="Empresa o Institución">
									@if ($errors->has('empresa'))
										<div class="col-form-label" style="color:red;">{{$errors->first('empresa')}}</div>
									@endif
								</div>
							</div>
	
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Proyecto</button>
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
		verify_column($('#id'), 'id', 'projects', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'projects', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
	</script>
@endsection
