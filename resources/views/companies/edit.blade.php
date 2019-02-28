@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Empresa")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:lightseagreen;"></i>
					<div class="d-inline">
                        <h4 style="text-transform: none;">Editar Empresa: {{$company->rfc}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de una empresa.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('companies.list') }}">Empresas</a>
						</li>
						<li class="breadcrumb-item">Editar Empresa
                        </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Page-header end -->

	<div class="page-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-block">
						@if($company->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Empresa Eliminada</strong></p>
								<p> Esta empresa esta actualmente eliminada, restaurela para que pueda hacer uso de ella en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("companies/{$company->id}") }}" files="true" enctype="multipart/form-data">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}


							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Empresa:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id',$company->id) }}" title="ID de la Empresa">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="rfc">RFC:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="rfc_input" name="rfc" placeholder="Ej. XAXX010101000" value="{{ old('rfc',$company->rfc) }}" title="RFC de la Empresa" disabled>
									@if ($errors->has('rfc'))
										<div class="col-form-label" style="color:red;">{{$errors->first('rfc')}}</div>
									@endif
									<div  class="col-form-label" id="resultado" style="display:none;"></div>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Oracle" value="{{ old('name',$company->name) }}" title="Nombre de la Empresa">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="telefono">Teléfono:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="telefono" placeholder="Ej. 8349874563" value="{{ old('telefono',$company->phone) }}" title="Telefono de la Empresa">
									@if ($errors->has('telefono'))
										<div class="col-form-label" style="color:red;">{{$errors->first('telefono')}}</div>
									@endif
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
                                    {!! Form::select('state',$states,null,['id'=>'state','class'=>'form-control']) !!}
                                    @if ($errors->has('state'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('state')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="city">Ciudad:</label>
                                <div class="col-sm-4">
                                    {!! Form::select('city',$cities,null,['id'=>'city','class'=>'form-control']) !!}
                                    @if ($errors->has('city'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('city')}}</div>
                                    @endif
								</div>

								<label class="col-sm-2 col-form-label" for="zip">Código Postal:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="zip" placeholder="Ej. 87000" value="{{ old('zip',$company->zip) }}" title="Codigo Postal">
									@if ($errors->has('zip'))
										<div class="col-form-label" style="color:red;">{{$errors->first('zip')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="colonia">Colonia:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="colonia" placeholder="Ej. Liberal" value="{{ old('colonia',$company->colony) }}" title="Colonia">
									@if ($errors->has('colonia'))
										<div class="col-form-label" style="color:red;">{{$errors->first('colonia')}}</div>
									@endif
								</div>
								<label class="col-sm-2 col-form-label" for="calle">Calle:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="calle" placeholder="Ej. Guerrero" value="{{ old('calle',$company->street) }}" title="Calle">
									@if ($errors->has('calle'))
										<div class="col-form-label" style="color:red;">{{$errors->first('calle')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="horario">Horario de la Empresa:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="horario" rows="3" maxlength="500" placeholder="Ej. Lunes a Viernes de 8:00 a 20:00" title="Horario de la Empresa">{{ old('horario',$company->schedule) }}</textarea>
									@if ($errors->has('horario'))
										<div class="col-form-label" style="color:red;">{{$errors->first('horario')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="descripcion">Descripción de la Empresa:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="descripcion" rows="5" maxlength="1000" placeholder="Ej. Oracle Corporation es una compañía especializada en el desarrollo de soluciones de nube y locales" title="Descripción de la Empresa">{{ old('descripcion',$company->description) }}</textarea>
									@if ($errors->has('descripcion'))
										<div class="col-form-label" style="color:red;">{{$errors->first('descripcion')}}</div>
									@endif
								</div>
							</div>

						


                            

							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Empresa</button>
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
			$('#id'),
		];

		original_values = [
			['id', $('#id').val()],
		];

		unique_elements = [
			[$('#id'), 'id', 'companies', original_values, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_id'),
		]

        checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
        

        document.ready = document.getElementById("country").value = "{{$company->country}}";
        document.ready = document.getElementById("state").value = "{{$company->state}}";
        document.ready = document.getElementById("city").value = "{{$company->city}}";

	});
</script>
@endsection
