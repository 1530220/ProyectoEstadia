@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Solicitudes de competencias")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-check-square" style="background-color:darkcyan;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Solicitudes de Competencias</h4>
						<span style="text-transform: none;">Solicitudes de estudiantes que desean tener las competencias en su perfil.</span>
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
						<li class="breadcrumb-item">Solicitudes de Competencias
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
						<div class="dt-responsive table-responsive">
							<table style="width:100%;" id="custom_datatable" class="table table-striped table-bordered">
								@if ($students_competences->isNotEmpty())
								<thead id="table_header">
									<tr>
                    <th class="all" scope="col">Matricula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Competencia</th>
                    <th scope="col">Fecha solicitud</th>
										<th class="all" style="width:25%;" scope="col">Respuestas</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($students_competences as $competence)
									<tr>
                    <td scope="row"><strong>{{ $competence->student_id }} </strong></td>
                    <td>{{ucwords(strtolower($competence->first_name))}} {{ucwords(strtolower($competence->last_name))}} {{ucwords(strtolower($competence->second_last_name))}}</td>
                    <td>{{ $competence->name }}</td>
                    <td>{{$competence->created_at}}</td>
										<td>
                                            
                      <center>
                          <a href="{{ route('competences.answerAccepted', ['id' => $competence->id]) }}" class="btn btn-success" title="Aceptar solicitud de la competencia" style="margin: 3px;"><span class="icofont icofont-ui-check"></span></a>
                          <a href="{{ route('competences.answerRejected', ['id' => $competence->id]) }}" class="btn btn-danger" title="Rechazar solicitud de la competencia" style="margin: 3px;"><span class="icofont icofont-ui-close"></span></a>
                      </center>
										</td>
									</tr>
									@endforeach
								</tbody>
								
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Sin solicitudes</strong>
											<p>No existen solicitudes actualmente.</p>
										</div>
									</center>
								@endif

							</table>
						</div>
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
					<i class="fa fa-check-square" style="background-color:#98b766;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Solicitudes de Competencias</h4>
						<span style="text-transform: none;">Solicitudes de tutorados que desean tener las competencias en su perfil.</span>
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
						<li class="breadcrumb-item">Solicitudes de Competencias
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
						<div class="dt-responsive table-responsive">
							<table style="width:100%;" id="custom_datatable" class="table table-striped table-bordered">
								@if ($students_competences->isNotEmpty())
								<thead id="table_header">
									<tr>
                    <th class="all" scope="col">Matricula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Competencia</th>
                    <th scope="col">Fecha solicitud</th>
										<th class="all" style="width:25%;" scope="col">Respuestas</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($students_competences as $competence)
									<tr>
                    <td scope="row"><strong>{{ $competence->student_id }} </strong></td>
                    <td>{{ucwords(strtolower($competence->first_name))}} {{ucwords(strtolower($competence->last_name))}} {{ucwords(strtolower($competence->second_last_name))}}</td>
                    <td>{{ $competence->name }}</td>
                    <td>{{$competence->created_at}}</td>
										<td>
                                            
                      <center>
                          <a href="{{ route('competences.answerAccepted', ['id' => $competence->id]) }}" class="btn btn-success" title="Aceptar solicitud de la competencia" style="margin: 3px;"><span class="icofont icofont-ui-check"></span></a>
                          <a href="{{ route('competences.answerRejected', ['id' => $competence->id]) }}" class="btn btn-danger" title="Rechazar solicitud de la competencia" style="margin: 3px;"><span class="icofont icofont-ui-close"></span></a>
                      </center>
										</td>
									</tr>
									@endforeach
								</tbody>
								
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Sin solicitudes</strong>
											<p>No existen solicitudes actualmente.</p>
										</div>
									</center>
								@endif

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


@switch(Auth::user()->type)
    @case(1)
      @section('javascriptcode')
        <script>
          var button = '';
          applyStyleToDatatable(button, 'Buscar en solicitudes de competencias...');
        </script>
        @endsection
    @break
    @case(5)
      @section('javascriptcode')
        <script>
          var button = '';
          applyStyleToDatatable(button, 'Buscar en solicitudes de competencias...');
        </script>
        @endsection
    @break
@endswitch
