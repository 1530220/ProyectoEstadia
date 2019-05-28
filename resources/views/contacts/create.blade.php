@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Contacto")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color:seagreen;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Crear Contacto</h4>
						<span style="text-transform: none;">Llene los campos en la parte inferior para registrar un nuevo contacto.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('contacts.list') }}">Contactos</a>
						</li>
						<li class="breadcrumb-item">Crear Contacto
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
						<form id="form" method="POST" action="{{ route('contacts.list') }}">
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Contacto:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID del Contacto">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
              
							<div class="form-group row">
                <label class="col-sm-2 col-form-label" for="company">Empresa:</label>
                 <div class="col-sm-4">
                   <select name="company" class="form-control">
                   @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
                   @endforeach
                     </select>
								</div>
								
								<label class="col-sm-1 col-form-label" for="position">Cargo:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="position" placeholder="Ej. Jefe de sistemas" value="{{ old('position') }}" title="Cargo del Contacto">
									@if ($errors->has('position'))
										<div class="col-form-label" style="color:red;">{{$errors->first('position')}}</div>
									@endif
                </div>
             </div>
              
              <div class="form-group row">
								<label class="col-sm-2 col-form-label" for="nombre">Nombre(s) :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Mario Humberto" value="{{ old('nombre') }}" title="Nombre del Contacto">
									@if ($errors->has('nombre'))
										<div class="col-form-label" style="color:red;">{{$errors->first('nombre')}}</div>
									@endif
								</div>
							</div>
              
              <div class="form-group row">
								<label class="col-sm-2 col-form-label" for="paterno">Apellido Paterno :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="paterno" name="paterno" placeholder="Ej. Rodriguez" value="{{ old('paterno') }}" title="Apellido Paterno del Contacto">
									@if ($errors->has('paterno'))
										<div class="col-form-label" style="color:red;">{{$errors->first('paterno')}}</div>
									@endif
								</div>
							</div>
              
              <div class="form-group row">
								<label class="col-sm-2 col-form-label" for="materno">Apellido Materno :</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="materno" name="materno" placeholder="Ej. Chavez" value="{{ old('materno') }}" title="Apellido Materno del Contacto">
									@if ($errors->has('materno'))
										<div class="col-form-label" style="color:red;">{{$errors->first('materno')}}</div>
									@endif
                  <div class="col-form-label">* En caso de no poseer apellido materno, dejar este campo en blanco.</div>
								</div>
							</div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="phone">Teléfono :</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="phone" name="phone" placeholder="Ej. 834 1724895" value="{{ old('phone') }}" title="Telefono del Contacto">
									@if ($errors->has('phone'))
										<div class="col-form-label" style="color:red;">{{$errors->first('phone')}}</div>
									@endif
								</div>
                
								<label class="col-sm-1 col-form-label" for="email">E-mail :</label>
								<div class="col-sm-5">
									<input type="email" class="form-control" id="email" name="email" onkeyup="verificar_contacto_email()" placeholder="Ej. contacto1@gmail.com" value="{{ old('email') }}" title="Email del Contacto">
									@if ($errors->has('email'))
										<div class="col-form-label" style="color:red;">{{$errors->first('email')}}</div>
									@endif
                  <div id="error_email" class="col-form-label" style="color:red display:none;"></div>
								</div>
							</div>
              
              <div class="form-group row">
								<label class="col-sm-2 col-form-label" for="horario">Horario de Contacto:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="horario" rows="4" maxlength="1000" placeholder="Ej. Lunes a Viernes de 8:00 a 20:00" title="Horario de Contacto">{{ old('horario') }}</textarea>
									@if ($errors->has('horario'))
										<div class="col-form-label" style="color:red;">{{$errors->first('horario')}}</div>
									@endif
								</div>
							</div>
              
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" id="registroContacto" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Contacto</button>
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
		verify_column($('#id'), 'id', 'contacts', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'contacts', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
    
    
    function verificar_contacto_email() {
			var x = $("#email").val();

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			});
			$.ajax({
				url: '{{ route('contacts.verific_contact_email') }}',
				method: 'post',
				data: {
					id: x,
				},
				success: function(result) {

					contact = result['response'];

					if (contact!=null) {
						$("#error_email").text("* El email que esta intentando ingresar no esta disponible.");
						document.getElementById("error_email").style.color = "red";
						document.getElementById("error_email").style.display = "inline";
						document.getElementById("registroContacto").style.display = "none";
					}else{
						$("#error_email").text("");
						document.getElementById("error_email").style.display = "none";
						document.getElementById("registroContacto").style.display = "inline";
					}
				}
			});

		}
	</script>
@endsection
