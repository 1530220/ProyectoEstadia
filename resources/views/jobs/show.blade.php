@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Detalles de la Vacante: {$job->name}")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-eye-alt" style="background:tomato;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Detalles de la Vacante: {{$job->name}}</h4>
						<span style="text-transform: none;">Formulario para la visualización de datos de una vacante.</span>
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
						<li class="breadcrumb-item">Detalles de vacante
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
				<!-- Basic Form Inputs card start -->
				<div class="card">
					<div class="card-block">
						<h4 class="sub-title">Información General</h4>

						<div class="row">
							<div class="col-md-12 col-xl-12 ">
								<div class="card-block user-detail-card">
									@if($job->deleted==1)
										<div class="alert alert-danger icons-alert">
											<p><strong>Vacante Eliminada</strong></p>
											<p> Esta vacante esta actualmente eliminada, restaurela para que pueda hacer uso de ella en el sistema.</p>
										</div>
									@endif

									<div class="row">
										<div class="col-sm-12 user-detail">
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-v-card"></i>ID :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30"><strong>{{ $job->id }}</strong></h6>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Puesto :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $job->name }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Empresa :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $company->name }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Sector :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $sector->name }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Descripción :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $job->description }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Salario Mensual :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $job->salary }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Tipo de vacante :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $job->job_type }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Contacto :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">Nombre: {{ $contact->first_name }} {{ $contact->last_name }} {{ $contact->second_last_name }}</h6>
												</div><br><br>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
													<h6 class="m-b-30">Email: <strong>{{ $contact->email}}</strong></h6>
												</div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
													<h6 class="m-b-30">Telefono:  <strong>{{ $contact->phone}}</strong></h6>
												</div>
											</div>
                      
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-world"></i>País :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $name_pais }}</h6>
												</div>
                      </div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-map"></i>Estado :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $name_estado }}</h6>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-map"></i>Ciudad :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $name_ciudad  }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Codigo Postal :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $job->zip }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Colonia :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $job->colony }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Calle :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $job->street }}</h6>
												</div>
											</div>
                      <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Habilidades Requeridas :</h6>
												</div>
												<div class="col-sm-8">
                          @foreach($jobs_skills as $skill)
													  <h6 class="m-b-30"><strong> * {{ $skill->name }} </strong></h6>
                          @endforeach
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<center>
							@if($job->deleted==0)
								<form id="form" name="form" action="{{ route('jobs.destroy', ['id' => $job->id])}}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>

									<a href="{{ route('jobs.edit', ['id' => $job->id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
									<button onclick="archiveFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Eliminar"><span class="icofont icofont-ui-delete"></span></button>
								</form>
							@else
								<form id="form" name="form" action="{{ route('jobs.restore', ['id' => $job->id]) }}" method="POST">
									{{ csrf_field() }}

									<a style="color:white;" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>

									<a href="{{ route('jobs.edit', ['id' => $job->id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i> Modificar</button></a>
									<button onclick="restoreFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Restaurar"><span class="fas fa-reply"></span> Restaurar</button>
								</form>
							@endif
							<br /><br />
						</center>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection
