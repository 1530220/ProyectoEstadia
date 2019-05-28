@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Listado de Postulaciones")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-user" style="background-color:#FFB67F;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Postulaciones</h4>
						<span style="text-transform: none;">Lista de estudiantes que estan postulados a una vacante en espera de una respuesta.</span>
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
						<li class="breadcrumb-item">Lista de Postulaciones
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
								@if ($status_job->isNotEmpty())
								<thead id="table_header">
									<tr>
                    <th class="all" scope="col">ID</th>
                    <th scope="col">Alumno</th>
                    <th scope="col">Vacante</th>
                    <th scope="col">Empresa</th>
										<th class="all" style="width:25%;" scope="col">Respuestas</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($status_job as $job)
									<tr>
                    <td scope="row"><strong>{{ $job->id }} </strong></td>
                    <td><a href="{{ route('students.show', ['id' => $job->matricula])}}"><strong>{{$job->matricula}}</strong> {{ucwords(strtolower($job->first_name))}} {{ucwords(strtolower($job->last_name))}} {{ucwords(strtolower($job->second_last_name))}}</a></td>
                    <td><a href="{{ route('jobs.show',['id' => $job->id_job])}}">{{$job->job }}</a></td>
                    <td><a href="{{ route('companies.show',['id' => $job->id_company])}}">{{$job->company }}</a></td>
										<td>                      
                      <center>
                          <a href="{{ route('status_job.answerAccepted', ['id' => $job->id]) }}" class="btn btn-success" title="Aceptar postulante" style="margin: 3px;"><span class="icofont icofont-ui-check"></span></a>
                          <a href="{{ route('status_job.answerRejected', ['id' => $job->id]) }}" class="btn btn-danger" title="Rechazar postulante" style="margin: 3px;"><span class="icofont icofont-ui-close"></span></a>
                      </center>
										</td>
									</tr>
									@endforeach
								</tbody>
								
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Sin postulaciones</strong>
											<p>No existen postulaciones actualmente.</p>
										</div>
                    <a href="{{ route('status_job.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-plus"></i>Postular Alumno a Vacante</button></a>
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

@section('javascriptcode')
<script>
	var button = '';
	applyStyleToDatatable(button, 'Buscar en listado de postulaciones...');
</script>
@endsection
