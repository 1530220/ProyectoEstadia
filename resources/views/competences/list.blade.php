@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Competencias")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fas fa-star" style="background-color:darkcyan;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Competencias</h4>
						<span style="text-transform: none;">Lista de todas las competencias registradas en el sistema.</span>
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
						<li class="breadcrumb-item">Competencias
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
								@if ($competences->isNotEmpty())
								<thead id="table_header">
									<tr>
										<th class="all" scope="col">ID</th>
										<th scope="col">Nombre</th>
										<th class="all" style="width:25%;" scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($competences as $competence)
									<tr>
										@if($competence->deleted=='0')
											<th scope="row">{{ $competence->id }}</th>
											<td>{{ $competence->name }}</td>
										@else
											<th style="color:red" scope="row">{{ $competence->id }}</th>
											<td style="color:red">{{ $competence->name }}</td>
										@endif
										<td>
											@if($competence->deleted=='0')
												<form id="form" name="form" action="{{ route('competences.destroy', ['id' => $competence->id])}}" method="POST">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
											@else
												<form id="form" name="form" action="{{ route('competences.restore', ['id' => $competence->id]) }}" method="POST">
													{{ csrf_field() }}
											@endif
												<center>
													<a href="{{ route('competences.show', ['id' => $competence->id]) }}" class="btn btn-warning" title="Ver detalles de la competencia con el id {{ $competence->id }}" style="margin: 3px;"><span class="icofont icofont-eye-alt"></span></a>
													<a href="{{ route('competences.edit', ['id' => $competence->id]) }}" class="btn btn-primary" title="Editar competencia con el id {{ $competence->id }}" style="margin: 3px;"><span class="icofont icofont-ui-edit"></span></a>

													@if($competence->deleted=='0')
														<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar competencia con el id {{ $competence->id }}"><span class="icofont icofont-ui-delete"></span></button>
													@else
														<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar competencia con el id {{ $competence->id }}"><span class="fas fa-reply"></span></a>
													@endif
												</center>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr id="table_footer">
										<th style="padding-right: 2.8%" scope="col">ID</th>
										<th style="padding-right: 2.8%" scope="col">Nombre</th>
										<th style="padding-left: 1.2%" scope="col" style="width:0%;"></th>
									</tr>
								</tfoot>
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Atención</strong>
											<p>No hay ninguna competencia registrada.</p>
										</div>
										<a href="{{ route('competences.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-plus"></i>Agregar Competencia</button></a>
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
					<i class="fas fa-star" style="background-color:#98b766;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Competencias</h4>
						<span style="text-transform: none;">Lista de todas las competencias registradas en el sistema.</span>
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
						<li class="breadcrumb-item">Competencias
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
										<th class="all" scope="col">ID</th>
										<th scope="col">Nombre</th>
										<th class="all" style="width:25%;" scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($competences_tutor as $competence)
									<tr>
                    <th scope="row">{{ $competence->id }}</th>
                    <td>{{ $competence->name }}</td>
										
										<td>
                      <center>
                        <a href="{{ route('competences.show', ['id' => $competence->id]) }}" class="btn btn-warning" title="Ver detalles de la competencia con el id {{ $competence->id }}" style="margin: 3px;"><span class="icofont icofont-eye-alt"></span></a>
                      </center>
										</td>
									</tr>
									@endforeach
								</tbody>
								<tfoot>
									<tr id="table_footer">
										<th style="padding-right: 2.8%" scope="col">ID</th>
										<th style="padding-right: 2.8%" scope="col">Nombre</th>
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