@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Vacante")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color:tomato;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Crear Vacante</h4>
						<span style="text-transform: none;">Llene los campos en la parte inferior para registrar una nueva vacante.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('jobs.list') }}">Vacantes</a>
						</li>
						<li class="breadcrumb-item">Crear Vacante
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
						<form id="form" method="POST" action="{{ route('jobs.list') }}">
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Vacante:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID de la Vacante">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
              
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Programador BackEnd" value="{{ old('name') }}" title="Nombre de la Vacante">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
              
							<div class="form-group row">
                <label class="col-sm-2 col-form-label" for="country">Contacto:</label>
                 <div class="col-sm-4">
                   <select name="contact" class="form-control">
                   @foreach($contacts as $contact)
                    <option value="{{$contact->id}}">{{$contact->first_name}} {{$contact->last_name}} {{$contact->second_last_name}}</option>
                   @endforeach
                     </select>
								</div>
								
								<label class="col-sm-2 col-form-label" for="state">Sector:</label>
                <div class="col-sm-4">
                   <select name="sector" class="form-control">
                   @foreach($sectors as $sector)
                    <option value="{{$sector->id}}">{{$sector->name}}</option>
                   @endforeach
                     </select>
                </div>
             </div>
              
              <div class="form-group row">
								<label class="col-sm-2 col-form-label" for="descripcion">Descripción de la Vacante:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="descripcion" rows="8" maxlength="5000" placeholder="Ej. Mantener actualizados los sitios web, innovación para la mejora de las herramientas que son utilizadas por nuestros clientes." title="Descripción de la Vacante">{{ old('descripcion') }}</textarea>
									@if ($errors->has('descripcion'))
										<div class="col-form-label" style="color:red;">{{$errors->first('descripcion')}}</div>
									@endif
								</div>
							</div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="country">Salario Mensual:</label>
                 <div class="col-sm-4">
                   <select name="salary" class="form-control">
                     <option value="No mostrado por la empresa">No mostrado por la empresa</option>
                     <option value="Hasta $5,000">Hasta $5,000</option>
                     <option value="$5,001 - $10,000">$5,001 - $10,000</option>
                     <option value="$10,001 - $20,000">$10,001 - $20,000</option>
                     <option value="$20,001 - $30,000">$20,001 - $30,000</option>
                     <option value="$30,001 - $40,000">$30,001 - $40,000</option>
                     <option value="$40,001 - $50,000">$40,001 - $50,000</option>
                     <option value="$50,001 - $65,000">$50,001 - $65,000</option>
                     <option value="$65,001 - $80,000">$65,001 - $80,000</option>
                     <option value="$80,001 o más">$80,001 o más</option>
                  </select>
								</div>
								
								<label class="col-sm-2 col-form-label" for="state">Tipo de Vacante:</label>
                <div class="col-sm-4">
                   <select name="type" class="form-control">
                     <option value="Tiempo Completo">Tiempo Completo</option>
                     <option value="Medio Tiempo">Medio Tiempo</option>
                  </select>
                </div>
             </div>
              
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="country">País:</label>
                 <div class="col-sm-4">
                    {!! Form::select('country',$countries,null,['id'=>'country','class'=>'form-control']) !!}
                    @if ($errors->has('country'))
                        <div class="col-form-label" style="color:red;">{{$errors->first('country')}}</div>
                    @endif
								</div>
								
								<label class="col-sm-2 col-form-label" for="state">Estado:</label>
                <div class="col-sm-4">
                    {!! Form::select('state',['placeholder'=>'Favor de seleccionar un país'],null,['id'=>'state','class'=>'form-control']) !!}
                    @if ($errors->has('state'))
                        <div class="col-form-label" style="color:red;">{{$errors->first('state')}}</div>
                    @endif
                </div>
             </div>

             <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="city">Ciudad:</label>
                <div class="col-sm-4">
                    {!! Form::select('city',['placeholder'=>'Favor de seleccionar un estado'],null,['id'=>'city','class'=>'form-control']) !!}
                    @if ($errors->has('city'))
                        <div class="col-form-label" style="color:red;">{{$errors->first('city')}}</div>
                    @endif
								</div>

								<label class="col-sm-2 col-form-label" for="zip">Código Postal:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="zip" placeholder="Ej. 87000" value="{{ old('zip') }}" title="Codigo Postal">
									@if ($errors->has('zip'))
										<div class="col-form-label" style="color:red;">{{$errors->first('zip')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="colonia">Colonia:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="colonia" placeholder="Ej. Liberal" value="{{ old('colonia') }}" title="Colonia">
									@if ($errors->has('colonia'))
										<div class="col-form-label" style="color:red;">{{$errors->first('colonia')}}</div>
									@endif
								</div>
								<label class="col-sm-2 col-form-label" for="calle">Calle:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="calle" placeholder="Ej. Guerrero" value="{{ old('calle') }}" title="Calle">
									@if ($errors->has('calle'))
										<div class="col-form-label" style="color:red;">{{$errors->first('calle')}}</div>
									@endif
								</div>
							</div>

							
              
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Vacante</button>
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
		verify_column($('#id'), 'id', 'jobs', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'jobs', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
	</script>
@endsection
