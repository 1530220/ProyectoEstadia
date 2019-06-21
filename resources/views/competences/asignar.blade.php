@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Asignar Competencia")


@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-check" style="background-color:darkcyan;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Asignar Competencias</h4>
                        <span style="text-transform: none;">Seleccione las competencias que desea asignar al estudiante con matricula <strong>{{$id}}</strong>.</span>
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
                        <li class="breadcrumb-item">Asignar Competencias</li>
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
						<form id="form" method="POST" action="{{ route('competences.guardarAsignaciones',['id' => $id]) }}">
							{!! csrf_field() !!}

                            <h6>Competencias asignadas anteriormente:</h6><br>
							@if ($num_student_competences == 0)
								<div class="alert alert-primary icons-alert">
									<p><strong>Sin Competencias</strong></p>
									<p>El estudiante no posee ninguna competencia.</p>
								</div>
							@endif
                            @foreach ($competences_asigned as $competences)
                                <div class="col-sm-5 checkbox-fade fade-in-disable">
                                    <label>
                                        <input type="checkbox" value="" name="" disabled checked="checked">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-default"></i>
                                        </span>
                                    <span> {{$competences->name}}</span>
                                    </label>
                                </div>
                            @endforeach
                            <br><br>
                            <h6>Competencias que pueden ser asignadas:</h6><br>
							@if (count($competences_not_asigned)==0)
								<div class="alert alert-primary icons-alert">
									<p><strong>Sin competencias disponibles</strong></p>
									<p>No existe alguna competencia que pueda ser asignada al estudiante.</p>
								</div>
                <center><a href="{{ route('competences.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>Agregar Competencias</a></center>
							@endif
                            @foreach ($competences_not_asigned as $competences)
                                <div class="col-sm-5 checkbox-fade fade-in-inverse">
                                    <label>
                                        <input type="checkbox" value="{{ $competences->id }}" name="competences_not_asigned[]">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-inverse"></i>
                                        </span>
                                    <span> {{$competences->name}}</span>
                                    </label>
                                </div>
                            @endforeach

							<br><br><br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								@if (count($competences_not_asigned)!=0)
									<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Asignar Competencias</button>
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

@section('bodyTutor')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-check" style="background-color:#70c068;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Asignar Competencias</h4>
                        <span style="text-transform: none;">Seleccione las competencias que desea asignar al tutorado con matricula <strong>{{$id}}</strong>.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('students.list') }}">Tutorados</a>
						</li>
                        <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $id])}}">Detalles de Tutorado</a>
                        </li>
                        <li class="breadcrumb-item">Asignar Competencias</li>
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
						<form id="form" method="POST" action="{{ route('competences.guardarAsignaciones',['id' => $id]) }}">
							{!! csrf_field() !!}

                            <h6>Competencias asignadas anteriormente:</h6><br>
							@if ($num_student_competences == 0)
								<div class="alert alert-primary icons-alert">
									<p><strong>Sin Competencias</strong></p>
									<p>El estudiante no posee ninguna competencia.</p>
								</div>
							@endif
                            @foreach ($competences_asigned as $competences)
                                <div class="col-sm-5 checkbox-fade fade-in-disable">
                                    <label>
                                        <input type="checkbox" value="" name="" disabled checked="checked">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-default"></i>
                                        </span>
                                    <span> {{$competences->name}}</span>
                                    </label>
                                </div>
                            @endforeach
                            <br><br>
                            <h6>Competencias que pueden ser asignadas:</h6><br>
							@if (count($competences_not_asigned)==0)
								<div class="alert alert-primary icons-alert">
									<p><strong>Sin competencias disponibles</strong></p>
									<p>No existe alguna competencia que pueda ser asignada al estudiante.</p>
								</div>
							@endif
                            @foreach ($competences_not_asigned as $competences)
                                <div class="col-sm-5 checkbox-fade fade-in-inverse">
                                    <label>
                                        <input type="checkbox" value="{{ $competences->id }}" name="competences_not_asigned[]">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-inverse"></i>
                                        </span>
                                    <span> {{$competences->name}}</span>
                                    </label>
                                </div>
                            @endforeach

							<br><br><br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								@if (count($competences_not_asigned)!=0)
									<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Asignar Competencias</button>
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
		verify_column($('#id'), 'id', 'students_competences', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'students_competences', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
	</script>
@endsection
