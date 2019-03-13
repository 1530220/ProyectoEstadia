@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Vacante")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:tomato;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Editar la Vacante: {{$job->id}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de vacantes.</span>
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
						<li class="breadcrumb-item">Modificar Vacante
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
						@if($job->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Vacante Eliminada</strong></p>
								<p> Esta vacante esta actualmente eliminada, restaurela para que pueda hacer uso de ella en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("jobs/{$job->id}") }}">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="job_id">ID Vacante:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="job_id" name="job_id" placeholder="Ej. 10" value="{{ old('job_id', $job->id) }}" title="ID de la Vacante">
									@if ($errors->has('job_id'))
										<div id="error_job_id" class="col-form-label" style="color:red;">{{$errors->first('job_id')}}</div>
									@else
										<div id="error_job_id" class="col-form-label" style="color:red; display:none;"></div>
									@endif
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Programador BackEnd" value="{{ old('name', $job->name) }}" title="Nombre de la Vacante">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
              
							<div class="form-group row">
                <label class="col-sm-2 col-form-label" for="country">Contacto:</label>
                 <div class="col-sm-4">
                   <select name="contact" id="contact" class="form-control">
                   @foreach($contacts as $contact)
                    <option value="{{$contact->id}}">{{$contact->first_name}} {{$contact->last_name}} {{$contact->second_last_name}}</option>
                   @endforeach
                     </select>
								</div>
								
								<label class="col-sm-2 col-form-label" for="state">Sector:</label>
                <div class="col-sm-4">
                   <select name="sector" id="sector" class="form-control">
                   @foreach($sectors as $sector)
                    <option value="{{$sector->id}}">{{$sector->name}}</option>
                   @endforeach
                     </select>
                </div>
             </div>
              
              <div class="form-group row">
								<label class="col-sm-2 col-form-label" for="descripcion">Descripción de la Vacante:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="descripcion" rows="8" maxlength="5000" placeholder="Ej. Mantener actualizados los sitios web, innovación para la mejora de las herramientas que son utilizadas por nuestros clientes." title="Descripción de la Vacante">{{ old('descripcion', $job->description) }}</textarea>
									@if ($errors->has('descripcion'))
										<div class="col-form-label" style="color:red;">{{$errors->first('descripcion')}}</div>
									@endif
								</div>
							</div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" for="country">Salario Mensual:</label>
                 <div class="col-sm-4">
                   <select name="salary" id="salary" class="form-control">
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
                   <select name="type" id="type" class="form-control">
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
									<input type="text" class="form-control" name="zip" placeholder="Ej. 87000" value="{{ old('zip', $job->zip) }}" title="Codigo Postal">
									@if ($errors->has('zip'))
										<div class="col-form-label" style="color:red;">{{$errors->first('zip')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="colonia">Colonia:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="colonia" placeholder="Ej. Liberal" value="{{ old('colonia', $job->colony) }}" title="Colonia">
									@if ($errors->has('colonia'))
										<div class="col-form-label" style="color:red;">{{$errors->first('colonia')}}</div>
									@endif
								</div>
								<label class="col-sm-2 col-form-label" for="calle">Calle:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="calle" placeholder="Ej. Guerrero" value="{{ old('calle', $job->street) }}" title="Calle">
									@if ($errors->has('calle'))
										<div class="col-form-label" style="color:red;">{{$errors->first('calle')}}</div>
									@endif
								</div>
							</div>
              
              <div class="col-form-label"><strong> Favor de seleccionar las habilidades requeridas para la vacante.</strong></div><br>
               <div class="form-group row">
								<label class="col-sm-2 col-form-label" for="descripcion">Habilidades :</label>
								<div class="col-sm-10">
								  <div class="row">
                    @foreach($skills as $skill)
                    <div class="col-sm-5 checkbox-fade fade-in-primary">
                        <label>
                            <input type="checkbox" value="{{ $skill->id }}" name="skills_required[]"
                            @foreach($jobs_skills as $job_skill)
                                @if($skill->id == $job_skill->skill_id)
                                  checked="true"
                                @endif
                            @endforeach    
                            >
                            <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-inverse"></i>
                            </span>
                        <span> {{$skill->name}}</span>
                        </label>
                    </div>
                    @endforeach
                  </div>
								</div>
							</div>
              
              
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Vacante</button>
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
			$('#job_id'),
		];

		original_values = [
			['id', $('#job_id').val()],
		];

		unique_elements = [
			[$('#job_id'), 'id', 'jobs', original_values, $('#error_job_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_job_id'),
		]

		checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
    
    document.ready = document.getElementById("country").value = "{{$job->country}}";
    document.ready = document.getElementById("state").value = "{{$job->state}}";
    document.ready = document.getElementById("city").value = "{{$job->city}}";
    document.ready = document.getElementById("contact").value = "{{$job->id_contact}}";
    document.ready = document.getElementById("sector").value = "{{$job->id_sector}}";
    document.ready = document.getElementById("salary").value = "{{$job->salary}}";
    document.ready = document.getElementById("type").value = "{{$job->job_type}}";
	});
  
</script>
@endsection
