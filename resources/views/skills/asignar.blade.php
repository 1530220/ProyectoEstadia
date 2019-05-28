@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Asignar Habilidades")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-check" style="background-color:firebrick;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Asignar Habilidades</h4>
                        <span style="text-transform: none;">Seleccione las habilidades que desea asignar al estudiante con matricula <strong>{{$id}}</strong>.</span>
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
                        <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $id])}}">Detalles del Alumno</a>
                        </li>
                        <li class="breadcrumb-item">Asignar Habilidades</li>
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
						<form id="form" method="POST" action="{{ route('skills.guardarAsignaciones',['id' => $id]) }}">
							{!! csrf_field() !!}

                            <h6>Habilidades asignadas anteriormente:</h6><br>
                            @if ($num_student_skills == 0)
                                <div class="alert alert-primary icons-alert">
                                    <p><strong>Sin habilidades</strong></p>
                                    <p>El estudiante no posee ninguna habilidad.</p>
                                </div>
                            @endif
                            @foreach ($skills_asigned as $skills)
                                <div class="col-sm-5 checkbox-fade fade-in-disable">
                                    <label>
                                        <input type="checkbox" value="" name="" disabled checked="checked">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-default"></i>
                                        </span>
                                    <span> {{$skills->name}}</span>
                                    </label>
                                </div>
                            @endforeach
                            <br><br>
							<h6>Habilidades que pueden ser asignadas:</h6><br>
							@if (count($skills_not_asigned)==0)
								<div class="alert alert-primary icons-alert">
									<p><strong>Sin habilidades disponibles</strong></p>
									<p>No existe alguna habilidad que pueda ser asignada al estudiante.</p>
								</div>
							@endif
                            @foreach ($skills_not_asigned as $skills)
                                <div class="col-sm-5 checkbox-fade fade-in-inverse">
                                    <label>
                                        <input type="checkbox" value="{{ $skills->id }}" name="skills_not_asigned[]">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-inverse"></i>
                                        </span>
                                    <span> {{$skills->name}}</span>
                                    </label>
                                </div>
                            @endforeach

							<br><br><br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								@if (count($skills_not_asigned)!=0)
									<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Asignar Habilidades</button>
								@endif
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
		verify_column($('#id'), 'id', 'students_skills', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'students_skills', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
	</script>
@endsection
