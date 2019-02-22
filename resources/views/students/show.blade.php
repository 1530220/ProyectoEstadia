@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Detalles del Alumno: {$student->university_id}")

@switch(Auth::user()->type)
	@case(1)
		@section('body')
		@break
	@case(2)
		@section('bodyUsuario')
		@break
	@case(3)
		@section('bodyStudent')
		@break
	@case(4)
		@section('bodyTeacher')
		@break
	@case(5)
		@section('bodyTutor')
		@break
	@case(6)
		@section('bodyUserSalud')
		@break
	@case(7)
		@section('bodyUserPsicologia')
		@break
@endswitch

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-eye-alt bg-c-pink"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Detalles del Alumno con la Matricula: {{ $student->university_id }} </h4>
						<span style="text-transform: none;">Mostrando todos los detalles del alumno seleccionado.</span>
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
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Page-header end -->

	<!-- Page body start -->
	<div class="page-body">
		<div class="row">
			<div class="col-sm-12">
				<!-- Basic Form Inputs card start -->
				<div class="card">
					<div class="card-block">
						<h4 class="sub-title">Información General</h4>
						<div class="page-body">
							<div class="row">
								<div class="col-md-12 col-xl-12 ">
									<div class="card-block user-detail-card">
										@if($student->deleted==1)
											<div class="alert alert-danger icons-alert">
												<p><strong>Usuario Eliminado</strong></p>
												<p> Este usuario esta actualmente eliminado, restaurelo para que pueda hacer uso de el en el sistema.</p>
											</div>
										@endif
										<div class="row">
											<div class="col-sm-3">
												<center>
													<img id="modal_img" src='{{ asset($student->image)}}' alt="{{ $student->first_name }} {{ $student->last_name }} {{ $student->second_last_name }}" class="img-fluid p-b-10 rounded" style="width:100%;max-width:300px">
													<div id="modal_show_img" class="modal">
														<span class="close">&times;</span>
														<img class="modal-content" id="img_content">
														<div id="caption"></div>
													</div>
													<div class="contact-icon">
														@if($student->deleted==0)
															@if (Auth::user()->type == 1 || Auth::user()->type == 2)
																<form id="form" name="form" action="{{ route('students.destroy', ['id' => $student->user_id])}}" method="POST">
																	{{ csrf_field() }}
																	{{ method_field('DELETE') }}
																	<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i></button></a>
																	<a href="{{ route('students.edit', ['matricula' => $student->user_id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
																	<button onclick="archiveFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Eliminar"><span class="icofont icofont-ui-delete"></span></button>
																	<a href="{{ route('assignations.reassignation', ['id' => $student->user_id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Cambiar Tutor Asignado"><i class="fas fa-exchange-alt"></i></i></button></a>
																</form>
															@else
																<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i>Regresar</button></a>
															@endif
														@else
															@if (Auth::user()->type == 1 || Auth::user()->type == 2)
																<form id="form" name="form" action="{{ route('students.restore', ['id' => $student->user_id]) }}" method="POST">
																	{{ csrf_field() }}

																	<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i></button></a>
																	<a href="{{ route('students.edit', ['matricula' => $student->user_id]) }}"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="icofont icofont-edit m-0"></i></button></a>
																	<button onclick="restoreFunction()" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" type="submit" title="Restaurar"><span class="fas fa-reply"></span></button>
																</form>
															@else
																<a style="color:white; " onclick="returnURL('{{ url()->previous() }}')"><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Regresar"><i class="icofont icofont-arrow-left m-0"></i>Regresar</span></button></a>
															@endif
														@endif
													</div>
												</center>
											</div>
											<div class="col-sm-9 user-detail">
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-id-card"></i>Matrícula :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30"><strong>{{ $student->university_id }}</strong></h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-user"></i>Nombre :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $student->first_name }} {{ $student->last_name }} {{ $student->second_last_name }}</h6>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-cube"></i>Carrera :</h6>
													</div>
													<div class="col-sm-8">
														@if($student->name=='Sin Asignar')
															<h6 class="m-b-30" style="color:red">{{ $student->name }}</h6>
														@else
															<h6 class="m-b-30">{{ $student->name }}</h6>
														@endif
													</div>
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-chart-bar-graph"></i>Situación Académica :</h6>
													</div>
													@if ($student->academic_situation == 0)
														<div class="col-sm-8">
															<h6 class="m-b-30">Regular</h6>
														</div>
													@else
														<div class="col-sm-8">
															<h6 class="m-b-30" style="color:red">Especial</h6>
														</div>
													@endif
												</div>
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-ui-email"></i>Email :</h6>
													</div>
													<div class="col-sm-8">
														<h6 class="m-b-30">{{ $student->email }}</h6>
													</div>
												</div>
												<!--<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="fa fa-phone-square"></i>Teléfono :</h6>
													</div>
													<div class="col-sm-8">
													<h6 class="m-b-30"> /*$student->phone */}}</h6>
													</div>
												</div>-->
												<div class="row">
													<div class="col-sm-4">
														<h6 class="f-w-400 m-b-30"><i class="icofont icofont-users-alt-5"></i>Tutor :</h6>
													</div>
													<div class="col-sm-8">
														@if (Auth::user()->type == 4 || Auth::user()->type == 5)
															<h6 class="m-b-30">{{ $student->title }} {{ $student->tutorFirstName }} {{ $student->tutorLastName }} {{ $student->tutorSecondName }}</h6>
														@else
															<h6 class="m-b-30">{{ $student->title }} {{ $student->tutorFirstName }} {{ $student->tutorLastName }} {{ $student->tutorSecondName }}</h6>
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">

			<div class="col-sm-12">
				<div class="card">
					<div class="card-block">
						<h4 class="sub-title">Habilidades que posee el estudiante</h4>

						@if ($skills->isNotEmpty())
							<div class="row">
								<div class="col-sm-2">
									<h6><strong>Habilidad</strong></h6>
								</div>
								<div class="col-sm-2">
									<h6><strong>Ultima Actualización</strong></h6>
								</div>
								<div class="col-sm-6">
									<h6><strong>Puntuación</strong></h6>
								</div>
								
								<div class="col-sm-2">
									<center><h6><strong>Eliminar</strong></h6></center>
								</div>
							</div>
							@foreach ($skills as $skill)
								<div class="row">
									<div class="col-sm-2">
										<p>{{$skill->name}}</p>
									</div>
									<div class="col-sm-2">
										<p>{{$skill->updated_at}}</p>
									</div>
									<div class="col-sm-5">
										<div class="progress progress-xl">
											<div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar" style="width: {{$skill->score}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>	
									<div class="col-sm-1">
										<h6><strong>{{$skill->score}}%</strong></h6>
									</div>
								
									<div class="col-sm-2">
											@if($skill->deleted=='0')
												<form id="form" name="form" action="{{ route('skill.destroy', ['id' => $skill->id])}}" method="POST">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
											@else
												<form id="form" name="form" action="{{ route('skill.restore', ['id' => $skill->id]) }}" method="POST">
													{{ csrf_field() }}
											@endif
												<center>
													@if($skill->deleted=='0')
														<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar habilidad del estudiante"><span class="icofont icofont-ui-delete"></span></button>
													@else
														<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar habilidad del estudiante"><span class="fas fa-reply"></span></a>
													@endif
												</center>
											</form>
									</div>	
								</div>
							@endforeach	
						@else
						<center>
							<div class="alert alert-primary icons-alert">
								<p><strong>Sin habilidades</strong></p>
								<p>El estudiante no posee ninguna habilidad.</p>
							</div>

						</center>
						@endif	
					</div>
					<div class="card-footer">
						@if ($skills->isNotEmpty())
							<div class="row">
								<div class="col-sm-4"></div>
								<a href="{{ route('skill.edit', ['id' => $student->university_id]) }}" class="col-sm-4 btn btn-primary"><strong> Modificar Puntuaciones</strong></a>
							</div><br>
						@endif
						<div class="row">
							<div class="col-sm-4"></div>
							<a href="{{ route('skills.asignar', ['id' => $student->university_id]) }}" class="col-sm-4 btn btn-inverse"><strong> Asignar Habilidades</strong></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-block">
					<h4 class="sub-title">Competencias que posee el estudiante</h4>

					@if ($competences->isNotEmpty())
						<div class="row">
							<div class="col-sm-3">
								<h6><strong>Competencia</strong></h6>
							</div>
							<div class="col-sm-2">
								<h6><strong>Ultima Actualización</strong></h6>
							</div>
							<div class="col-sm-5">
								<h6><strong>Puntuación</strong></h6>
							</div>
							
							<div class="col-sm-2">
								<center><h6><strong>Acciones</strong></h6></center>
							</div>
						</div>
						@foreach ($competences as $competence)
							<div class="row">
								<div class="col-sm-3">
									<p>{{$competence->name}}</p>
								</div>
								<div class="col-sm-2">
									<p>{{$competence->updated}}</p>
								</div>
								<div class="col-sm-4">
									<div class="progress progress-xl">
										<div class="progress-bar progress-bar-striped progress-bar-warning" role="progressbar" style="width: {{$competence->score}}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>	
								<div class="col-sm-1">
									<h6><strong>{{$competence->score}}%</strong></h6>
								</div>
							
								<div class="col-sm-2">
										@if($competence->deleted=='0')
											<form id="form" name="form" action="{{ route('competence.destroy', ['id' => $competence->id])}}" method="POST">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
										@else
											<form id="form" name="form" action="{{ route('competence.restore', ['id' => $competence->id]) }}" method="POST">
												{{ csrf_field() }}
										@endif
											<center>
												<a href="{{ route('competence.edit', ['id' => $competence->id]) }}" class="btn btn-primary" title="Editar puntuación de la competencia {{$competence->name}}" style="margin: 3px;"><span class="icofont icofont-ui-edit"></span></a>

												@if($competence->deleted=='0')
													<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar competencia del estudiante"><span class="icofont icofont-ui-delete"></span></button>
												@else
													<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar competencia del estudiante"><span class="fas fa-reply"></span></a>
												@endif
											</center>
										</form>
								</div>	
							</div>
						@endforeach	
					@else
					<center>
						<div class="alert alert-primary icons-alert">
							<p><strong>Competencias no asignadas</strong></p>
							<p>El estudiante no posee ninguna competencia asignada.</p>
						</div>

					</center>
					@endif	
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-sm-4"></div>
							<a href="{{ route('competences.asignar', ['id' => $student->university_id]) }}" class="col-sm-4 btn btn-inverse"><strong> Asignar Competencias</strong></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-block">
							<h4 class="sub-title">Proyectos en los que ha colaborado el estudiante</h4>
						<div class="dt-responsive table-responsive">
							<table id="simpletable-1" class="table table-striped table-bordered nowrap">
								@if ($projects->isNotEmpty())
									<thead id="table_header">
										<tr>
											<th class="all" scope="col">ID</th>
											<th scope="col" >Nombre</th>
											<th scope="col" >Fecha de Inicio</th>
											<th scope="col" >Fecha de Finalización</th>
											<th scope="col" >Empresa</th>
											<th scope="col" >Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($projects as $project)
											<tr>
												@if($project->deleted=='0')
													<td style="font-weight:bold">{{ $project->id }}</td>
													<td>{{ $project->name }}</td>
													<td>{{ $project->start_date}}</td>
													<td>{{ $project->finish_date}}</td>
													<td>{{ $project->company}}</td>
												@else
													<td style="color:red; font-weight:bold">{{ $project->id }}</td>
													<td>{{ $project->name }}</td>
													<td>{{ $project->start_date}}</td>
													<td>{{ $project->finish_date}}</td>
													<td>{{ $project->company}}</td>
												@endif
												<td>
													@if($project->deleted=='0')
														<form id="form" name="form" action="{{ route('projects.destroy', ['id' => $project->id])}}" method="POST">
															{{ csrf_field() }}
															{{ method_field('DELETE') }}
													@else
														<form id="form" name="form" action="{{ route('projects.restore', ['id' => $project->id]) }}" method="POST">
															{{ csrf_field() }}
													@endif
														<center>
															<a href="{{ route('projects.show', ['id' => $project->id]) }}" class="btn btn-warning" title="Ver detalles del proyecto con el id {{ $project->id }}" style="margin: 3px;"><span class="icofont icofont-eye-alt"></span></a>
															<a href="{{ route('projects.edit', ['id' => $project->id]) }}" class="btn btn-primary" title="Editar proyecto con el id {{ $project->id }}" style="margin: 3px;"><span class="icofont icofont-ui-edit"></span></a>

															@if($project->deleted=='0')
																<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar proyecto con el id {{ $project->id }}"><span class="icofont icofont-ui-delete"></span></button>
															@else
																<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar proyecto con el id {{ $project->id }}"><span class="fas fa-reply"></span></a>
															@endif
														</center>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								@else
									<center>
										<div class="alert alert-primary icons-alert">
											<strong>No existen registros</strong>
											<p>El estudiante no ha registrado ningún proyecto.</p>
										</div>

									</center>
								@endif

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			

		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-block">
							<h4 class="sub-title">Reconocimientos que posee el alumno</h4>

						<div class="dt-responsive table-responsive">
							<table id="simpletable-2" class="table table-striped table-bordered nowrap">
								@if ($acknowledgments->isNotEmpty())
									<thead id="table_header">
										<tr>
											<th class="all" scope="col">ID</th>
											<th scope="col" >Titulo</th>
											<th scope="col" >Emisor</th>
											<th scope="col" >Fecha</th>
											<th scope="col" >Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($acknowledgments as $acknowledgment)
											<tr>
												@if($acknowledgment->deleted=='0')
													<td style="font-weight:bold">{{ $acknowledgment->id }}</td>
													<td>{{ $acknowledgment->title }}</td>
													<td>{{ $acknowledgment->transmitter}}</td>
													<td>{{ $acknowledgment->date}}</td>
												@else
													<td style="color:red; font-weight:bold">{{ $acknowledgment->id }}</td>
													<td>{{ $acknowledgment->title }}</td>
													<td>{{ $acknowledgment->transmitter}}</td>
													<td>{{ $acknowledgment->date}}</td>
												@endif
												<td>
													@if($acknowledgment->deleted=='0')
														<form id="form" name="form" action="{{ route('acknowledgments.destroy', ['id' => $acknowledgment->id])}}" method="POST">
															{{ csrf_field() }}
															{{ method_field('DELETE') }}
													@else
														<form id="form" name="form" action="{{ route('acknowledgments.restore', ['id' => $acknowledgment->id]) }}" method="POST">
															{{ csrf_field() }}
													@endif
														<center>
															<a href="{{ route('acknowledgments.show', ['id' => $acknowledgment->id]) }}" class="btn btn-warning" title="Ver detalles del reconocimiento con el id {{ $acknowledgment->id }}" style="margin: 3px;"><span class="icofont icofont-eye-alt"></span></a>
															<a href="{{ route('acknowledgments.edit', ['id' => $acknowledgment->id]) }}" class="btn btn-primary" title="Editar reconocimiento con el id {{ $acknowledgment->id }}" style="margin: 3px;"><span class="icofont icofont-ui-edit"></span></a>

															@if($acknowledgment->deleted=='0')
																<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar reconocimiento con el id {{ $acknowledgment->id }}"><span class="icofont icofont-ui-delete"></span></button>
															@else
																<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar reconocimiento con el id {{ $acknowledgment->id }}"><span class="fas fa-reply"></span></a>
															@endif
														</center>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								@else
									<center>
										<div class="alert alert-primary icons-alert">
											<strong>No existen registros</strong>
											<p>El estudiante no ha registrado ningún reconocimiento.</p>
										</div>

									</center>
								@endif

							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			




		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-block">
							<h4 class="sub-title">Experiencia laboral que posee el alumno</h4>

						<div class="dt-responsive table-responsive">
							<table id="simpletable-3" class="table table-striped table-bordered nowrap">
								@if ($work_experiences->isNotEmpty())
									<thead id="table_header">
										<tr>
											<th class="all" scope="col">ID</th>
											<th scope="col" >Cargo</th>
											<th scope="col" >Empresa</th>
											<th scope="col" >Fecha de Inicio</th>
											<th scope="col" >Fecha de Finalización</th>
											<th scope="col" >Acciones</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($work_experiences as $work_experience)
											<tr>
												@if($work_experience->deleted=='0')
													<td style="font-weight:bold">{{ $work_experience->id }}</td>
													<td>{{ $work_experience->position }}</td>
													<td>{{ $work_experience->company}}</td>
													<td>{{ $work_experience->start_date}}</td>
													<td>{{ $work_experience->finish_date}}</td>
												@else
													<td style="color:red; font-weight:bold">{{ $work_experience->id }}</td>
													<td>{{ $work_experience->position }}</td>
													<td>{{ $work_experience->company}}</td>
													<td>{{ $work_experience->start_date}}</td>
													<td>{{ $work_experience->finish_date}}</td>
												@endif
												<td>
													@if($work_experience->deleted=='0')
														<form id="form" name="form" action="{{ route('work_experiences.destroy', ['id' => $work_experience->id])}}" method="POST">
															{{ csrf_field() }}
															{{ method_field('DELETE') }}
													@else
														<form id="form" name="form" action="{{ route('work_experiences.restore', ['id' => $work_experience->id]) }}" method="POST">
															{{ csrf_field() }}
													@endif
														<center>
															<a href="{{ route('work_experiences.show', ['id' => $work_experience->id]) }}" class="btn btn-warning" title="Ver detalles de experiencia laboral con el id {{ $work_experience->id }}" style="margin: 3px;"><span class="icofont icofont-eye-alt"></span></a>
															<a href="{{ route('work_experiences.edit', ['id' => $work_experience->id]) }}" class="btn btn-primary" title="Editar experiencia laboral con el id {{ $work_experience->id }}" style="margin: 3px;"><span class="icofont icofont-ui-edit"></span></a>

															@if($work_experience->deleted=='0')
																<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar experiencia laboral con el id {{ $work_experience->id }}"><span class="icofont icofont-ui-delete"></span></button>
															@else
																<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar experiencia laboral con el id {{ $work_experience->id }}"><span class="fas fa-reply"></span></a>
															@endif
														</center>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								@else
									<center>
										<div class="alert alert-primary icons-alert">
											<strong>No existen registros</strong>
											<p>El estudiante no ha registrado ninguna experiencia laboral.</p>
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



