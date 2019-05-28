@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Detalles de Experiencia Laboral: {$work_experience->id}")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-eye-alt bg-c-yellow" ></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Detalles de experiencia laboral: {{$work_experience->id}}</h4>
						<span style="text-transform: none;">Formulario para la visualización de datos de experiencia laboral.</span>
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
                        <li class="breadcrumb-item">Detalles del Alumno
						</li>
						<li class="breadcrumb-item">Detalles de Experiencia Laboral
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
                                    @if($work_experience->deleted==1)
										<div class="alert alert-danger icons-alert">
											<p><strong>Experiencia Laboral Eliminada</strong></p>
											<p> Esta experiencia laboral esta actualmente eliminada, restaurela para que pueda hacer uso de el en el sistema.</p>
										</div>
									@endif

									<div class="row">
										<div class="col-sm-12 user-detail">
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-v-card"></i>ID :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30"><strong>{{ $work_experience->id }}</strong></h6>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Cargo :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->position }}</h6>
												</div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-building-alt"></i>Empresa :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->company }}</h6>
												</div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-calendar"></i>Fecha de inicio :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->start_date }}</h6>
												</div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-calendar"></i>Fecha de finalización :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->finish_date }}</h6>
												</div>
                                            </div>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="fa fa-bars"></i>Descripción :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->description }}</h6>
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
										</div>
									</div>
								</div>
							</div>
						</div>
						<center>
							@if($work_experience->deleted==0)
								<form id="form" name="form" action="{{ route('work_experiences.destroy', ['id' => $work_experience->id])}}" method="POST">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>

									<a href="{{ route('work_experiences.edit', ['id' => $work_experience->id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
									<button onclick="archiveFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Eliminar"><span class="icofont icofont-ui-delete"></span></button>
								</form>
							@else
								<form id="form" name="form" action="{{ route('work_experiences.restore', ['id' => $work_experience->id]) }}" method="POST">
									{{ csrf_field() }}

									<a style="color:white;" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>

									<a href="{{ route('work_experiences.edit', ['id' => $work_experience->id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i> Modificar</button></a>
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

@section('bodyTutor')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-eye-alt" style="background-color:red;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Detalles de experiencia laboral: {{$work_experience->id}}</h4>
						<span style="text-transform: none;">Formulario para la visualización de datos de experiencia laboral.</span>
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
            <li class="breadcrumb-item">Detalles de Tutorado
						</li>
						<li class="breadcrumb-item">Detalles de Experiencia Laboral
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
                @if($work_experience->deleted==1)
										<div class="alert alert-danger icons-alert">
											<p><strong>Experiencia Laboral Eliminada</strong></p>
											<p> Esta experiencia laboral esta actualmente eliminada, solicite al administrador su restauración si asi lo desea.</p>
										</div>
									@endif

									<div class="row">
										<div class="col-sm-12 user-detail">
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-v-card"></i>ID :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30"><strong>{{ $work_experience->id }}</strong></h6>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Cargo :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->position }}</h6>
												</div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-building-alt"></i>Empresa :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->company }}</h6>
												</div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-calendar"></i>Fecha de inicio :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->start_date }}</h6>
												</div>
                                            </div>
                                            <div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-calendar"></i>Fecha de finalización :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->finish_date }}</h6>
												</div>
                                            </div>
											<div class="row">
												<div class="col-sm-4">
													<h6 class="f-w-400 m-b-30"><i class="fa fa-bars"></i>Descripción :</h6>
												</div>
												<div class="col-sm-8">
													<h6 class="m-b-30">{{ $work_experience->description }}</h6>
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
										</div>
									</div>
								</div>
							</div>
						</div>
						<center><br>
							<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" class="btn btn-primary col-lg-3"><i class="icofont icofont-arrow-left"></i>Regresar</a>
							<br /><br />
						</center>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection