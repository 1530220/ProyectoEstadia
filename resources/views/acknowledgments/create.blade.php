@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Registrar Reconocimiento")

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
                        <h4 style="text-transform: none;">Registrar Reconocimiento</h4>
						<span style="text-transform: none;">Llene los campos en la parte inferior para registrar un nuevo reconocimiento.</span>
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
						<li class="breadcrumb-item">Registrar Reconocimiento
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
						<form id="form" method="POST" action="{{ route('acknowledgments.list') }}">
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Reconocimiento:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID del Reconocimiento">
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
								<label class="col-sm-2 col-form-label" for="name">Titulo:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Reconocimiento por excelencia en conocimientos Oracle" value="{{ old('name') }}" title="Titulo del reconocimiento">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
                            </div>

							<div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="emisor">Emisor:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="emisor" placeholder="Oracle Corporation" value="{{ old('emisor') }}" title="Emisor">
                                    @if ($errors->has('emisor'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('emisor')}}</div>
                                    @endif
                                </div>

								<label class="col-sm-1 col-form-label" for="fecha">Fecha:</label>
								<div class="col-sm-4">
									<input class="form-control" type="date" name="fecha" title="Fecha " required/>
									@if ($errors->has('fecha'))
										<div class="col-form-label" style="color:red;">{{$errors->first('fecha')}}</div>
									@endif
                                </div>
                            </div>
                            
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="description">Descripción:</label>
								<div class="col-sm-10">
									<textarea rows="5" class="form-control max-textarea" maxlength="500" name="description" placeholder="Ej. Reconocimiento obtenido por destacar en conocimientos de programación PLSQL" value="{{ old('description') }}" title="Descripción del Reconocimiento"></textarea>
									@if ($errors->has('description'))
										<div class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									@endif
								</div>
							</div>
	
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Reconocimiento</button>
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
		verify_column($('#id'), 'id', 'acknowledgments', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'acknowledgments', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
	</script>
@endsection
