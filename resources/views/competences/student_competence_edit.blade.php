@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Modificar Puntuación")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:darkcyan;"></i>
					<div class="d-inline">
                        <h4 style="text-transform: none;">Modificar puntuación</h4>
                        <span style="text-transform: none;">Puntuación de la competencia <strong>{{$data_competence->name}}</strong> para estudiante con matricula <strong>{{$data_competence->matricula}}</strong>.</span>
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
                        <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $data_competence->matricula])}}">Detalles del Alumno</a>
                        </li>
                        <li class="breadcrumb-item">Modificar Puntuación</li>
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
                        @if($data_competence->evaluated==0)
							<div class="alert alert-warning icons-alert">
								<p><strong>Competencia no rankeada</strong></p>
								<p> La puntuación mostrada es una puntuación por defecto, no ha sido rankeada.</p>
							</div>
						@endif
						@if($data_competence->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Competencia no asignada al alumno</strong></p>
								<p> Esta competencia esta actualmente eliminada del alumno.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("competence/{$data_competence->id}") }}">
							{{ method_field('PUT') }}
                            {!! csrf_field() !!}
                            
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-3">
                                    <h6><strong>Nombre de la Competencia:</strong></h6>                                
                                </div>
                                <div class="col-sm-8">
                                    <h6>{{$data_competence->name}}</h6>   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-3">
                                    <h6><strong>Matricula del Estudiante:</strong></h6>                                
                                </div>
                                <div class="col-sm-8">
                                    <h6>{{$data_competence->matricula}}</h6>   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-3">
                                    <h6><strong>Puntuación Actual:</strong></h6>                                
                                </div>
                                <div class="col-sm-8">
                                    <h6>{{$data_competence->score}}</h6>   
                                </div>
                            </div>       
                            <div class="row">
                                    <div class="col-sm-1"></div>
                                <div class="col-sm-3">
                                    <h6><strong>Ultima Actualización:</strong></h6>                                
                                </div>
                                <div class="col-sm-8">
                                    <h6>{{$data_competence->updated}}</h6>   
                                </div>
                            </div>
                            
                            <hr>
                            <div class="col-lg-12">
                                Utiliza la siguiente grafica para modificar la puntuación de la competencia. La puntuación mostrada es la que posee actualmente el estudiante.
                            </div>   <br>
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="col-lg-6 col-xl-4">
                                    <input type="text" class="dial" name="points" value="{{$data_competence->score}}" data-width="300" data-height="300" data-fgColor="green" data-skin="tron" data-thickness=".1" data-angleOffset="180">
                                </div>
                            </div>
							
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Puntuación</button>
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
					<i class="icofont icofont-ui-edit" style="background:#70c068;"></i>
					<div class="d-inline">
            <h4 style="text-transform: none;">Modificar puntuación</h4>
            <span style="text-transform: none;">Puntuación de la competencia <strong>{{$data_competence->name}}</strong> para tutorado con matricula <strong>{{$data_competence->matricula}}</strong>.</span>
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
            <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $data_competence->matricula])}}">Detalles de Tutorado</a>
            </li>
            <li class="breadcrumb-item">Modificar Puntuación</li>
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
                        @if($data_competence->evaluated==0)
							<div class="alert alert-warning icons-alert">
								<p><strong>Competencia no rankeada</strong></p>
								<p> La puntuación mostrada es una puntuación por defecto, no ha sido rankeada.</p>
							</div>
						@endif
						@if($data_competence->deleted==1)
							<div class="alert alert-danger icons-alert">
								<p><strong>Competencia no asignada al alumno</strong></p>
								<p> Esta competencia esta actualmente eliminada del alumno.</p>
							</div>
						@endif
						<form id="form" method="POST" action="{{ url("competence/{$data_competence->id}") }}">
							{{ method_field('PUT') }}
              {!! csrf_field() !!}

              <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-3">
                      <h6><strong>Nombre de la Competencia:</strong></h6>                                
                  </div>
                  <div class="col-sm-8">
                      <h6>{{$data_competence->name}}</h6>   
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-3">
                      <h6><strong>Matricula del Tutorado:</strong></h6>                                
                  </div>
                  <div class="col-sm-8">
                      <h6>{{$data_competence->matricula}}</h6>   
                  </div>
              </div>
              <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-3">
                      <h6><strong>Puntuación Actual:</strong></h6>                                
                  </div>
                  <div class="col-sm-8">
                      <h6>{{$data_competence->score}}</h6>   
                  </div>
              </div>       
              <div class="row">
                      <div class="col-sm-1"></div>
                  <div class="col-sm-3">
                      <h6><strong>Ultima Actualización:</strong></h6>                                
                  </div>
                  <div class="col-sm-8">
                      <h6>{{$data_competence->updated}}</h6>   
                  </div>
              </div>

              <hr>
              <div class="col-lg-12">
                  Utiliza la siguiente grafica para modificar la puntuación de la competencia. La puntuación mostrada es la que posee actualmente el estudiante.
              </div>   <br>
              <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-lg-6 col-xl-4">
                      <input type="text" class="dial" name="points" value="{{$data_competence->score}}" data-width="300" data-height="300" data-fgColor="green" data-skin="tron" data-thickness=".1" data-angleOffset="180">
                  </div>
              </div>
							
							<br>
							<center>
								<a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Puntuación</button>
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

