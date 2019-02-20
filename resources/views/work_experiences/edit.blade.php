@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Editar Experiencia Laboral")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit bg-c-yellow"></i>
					<div class="d-inline">
                        <h4 style="text-transform: none;">Editar Experiencia Laboral: {{$work_experience->id}}</h4>
						<span style="text-transform: none;">Formulario para la modificación de experiencia laboral.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('students.list') }}">Alumnos</a>
						</li>
						<li class="breadcrumb-item">Detalles de Alumno
                        </li>
                        <li class="breadcrumb-item">Modificar Experiencia Laboral
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
						@if($work_experience->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Experiencia Laboral Eliminada</strong></p>
								<p> Esta experiencia laboral esta actualmente eliminada, restaurela para que pueda hacer uso de el en el sistema.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("work_experiences/{$work_experience->id}") }}">
							{{ method_field('PUT') }}
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Experiencia Laboral:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id', $work_experience->id) }}" title="ID de Experiencia Laboral">
									@if ($errors->has('id'))
										<div id="error_we_id" class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@else
										<div id="error_we_id" class="col-form-label" style="color:red; display:none;"></div>
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
								<label class="col-sm-2 col-form-label" for="position">Cargo:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="position" placeholder="Ej. Practicante" value="{{ old('position', $work_experience->position) }}" title="Cargo ">
									@if ($errors->has('position'))
										<div class="col-form-label" style="color:red;">{{$errors->first('position')}}</div>
									@endif
								</div>
                            </div>

							<div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="company">Empresa / Institución:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company" placeholder="Oracle Corporation" value="{{ old('company',$work_experience->company) }}" title="Empresa o institución">
                                    @if ($errors->has('company'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('company')}}</div>
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
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="state">Estado:</label>
                                <div class="col-sm-4">
                                    {!! Form::select('state',$states,null,['id'=>'state','class'=>'form-control']) !!}
                                    @if ($errors->has('state'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('state')}}</div>
                                    @endif
                                </div>

                                <label class="col-sm-2 col-form-label" for="city">Ciudad:</label>
                                <div class="col-sm-4">
                                    {!! Form::select('city',$cities,null,['id'=>'city','class'=>'form-control']) !!}
                                    @if ($errors->has('city'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('city')}}</div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="inicio">Fecha Inicio:</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="date" name="inicio" title="Fecha de Inicio de Experiencia Laboral" value="{{$work_experience->start_date}}" required/>
                                    @if ($errors->has('inicio'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('inicio')}}</div>
                                    @endif
                                </div>

                                <label class="col-sm-2 col-form-label" for="fin">Fecha Finalización:</label>
                                <div class="col-sm-4">
                                    <input class="form-control" type="date" name="fin" title="Fecha de Finalización de Experiencia Laboral" value="{{$work_experience->finish_date}}" required/>
                                    @if ($errors->has('fin'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('fin')}}</div>
                                    @endif
                                </div>
                            </div>
                            

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="description">Descripción:</label>
								<div class="col-sm-10">
                                <textarea rows="5" class="form-control max-textarea" maxlength="500" name="description" placeholder="Ej. Se laboró como practicante realizando consultas y creando procedimientos en lenguaje procedural SQL" title="Descripción de experiencia laboral">{{old('description',$work_experience->description)}}</textarea>
									@if ($errors->has('description'))
										<div class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									@endif
								</div>
                            </div>


							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Experiencia Laboral</button>
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
			$('#id'),
			$('#description'),
		];

		original_values = [
			['id', $('#id').val()],
		];

		unique_elements = [
			[$('#id'), 'id', 'work_experiences', original_values, $('#error_we_id'),
				'* El id que esta intentando ingresar no esta disponible.'],
		];

		error_divs = [
			$('#error_we_id'),
		]

        checkIfChangesHaveBeenMadeIn(elements_id, unique_elements);
        

        document.ready = document.getElementById("matricula").value = "{{$work_experience->user_id}}";
        document.ready = document.getElementById("country").value = "{{$work_experience->country}}";
        document.ready = document.getElementById("state").value = "{{$work_experience->state}}";
        document.ready = document.getElementById("city").value = "{{$work_experience->city}}";
	});
</script>
@endsection
