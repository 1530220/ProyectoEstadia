@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Competencias Por Rankear")

@section('bodyTutor')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fas fa-bars" style="background-color:#98b766;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Competencias por Rankear</h4>
						<span style="text-transform: none;">Lista de todas las competencias no rankeadas de los tutorados.</span>
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
						<li class="breadcrumb-item">Competencias por Rankear
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
								@if ($competences_tutor->isNotEmpty())
								<thead id="table_header">
									<tr>
										<th class="all" scope="col">Matricula</th>
										<th scope="col">Alumno</th>
                    <th scope="col">Competencia</th>
										<th class="all" style="width:25%;" scope="col">Evaluar</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($competences_tutor as $competence)
									<tr>
                    <th scope="row">{{ $competence->university_id }}</th>
                    <td>{{ $competence->first_name }} {{ $competence->last_name }} {{ $competence->second_last_name }}</td>
                    <td>{{ $competence->nameCompetence}}</td>
										<td>
                      <center>
                        <a href="{{ route('competence.edit', ['id' => $competence->id_students_competences]) }}" class="btn btn-success col-lg-3" title="Rankear competencia {{$competence->nameCompetence}}" style="margin: 3px;"><span class="fas fa-edit"></span></a>
                      </center>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr id="table_footer">
										<th style="padding-right: 2.8%" scope="col">Matricula</th>
										<th style="padding-right: 2.8%" scope="col">Alumno</th>
                    <th style="padding-right: 2.8%" scope="col">Competencia</th>
										<th style="padding-left: 1.2%" scope="col" style="width:0%;"></th>
									</tr>
								</tfoot>
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Atención</strong>
											<p>No hay ninguna competencia registrada.</p>
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
        var button = '<a href="{{ route('competences.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-plus"></i>Agregar Competencia</button></a>';
        applyStyleToDatatable(button, 'Buscar en competencias...');
      </script>
      @endsection
    @break
    @case(5)
      @section('javascriptcode')
      <script>
        var button = '';
        applyStyleToDatatable(button, 'Buscar en competencias...');
      </script>
      @endsection
    @break
@endswitch