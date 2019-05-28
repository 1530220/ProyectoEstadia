@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Conexiones")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fab fa-connectdevelop" style="background-color:cornflowerblue;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Listado de Conexiones</h4>
						<span style="text-transform: none;">Las conexiones representan seguimientos entre estudiantes y empresas.</span>
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
						<li class="breadcrumb-item">Conexiones
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
								@if ($connections->isNotEmpty())
								<thead id="table_header">
									<tr>
										<th class="all" scope="col">ID</th>
										<th scope="col">Matricula</th>
                    <th scope="col">Alumno</th>
                    <th scope="col">Empresa</th>
                    <th scope="col">Fecha Conexión</th>
										<th class="all" style="width:25%;" scope="col">Borrar Conexión</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($connections as $connection)
									<tr>
										@if($connection->deleted=='0')
											<th scope="row">{{ $connection->id }}</th>
                      <td scope="row">{{ $connection->student_id_login}}</td>
                      <td scope="row">{{$connection->first_name}} {{$connection->last_name}} {{$connection->second_last_name}}</td>
                      <td scope="row">{{ $connection->name}}</td>
											<td>{{ $connection->date }}</td>
										@else
											<th style="color:red" scope="row">{{ $connection->id }}</th>
                      <td style="color:red" scope="row">{{ $connection->student_id_login}}</td>
                      <td style="color:red" scope="row">{{$connection->first_name}} {{$connection->last_name}} {{$connection->second_last_name}}</td>
                      <td style="color:red" scope="row">{{ $connection->name}}</td>
											<td style="color:red">{{ $connection->date }}</td>
										@endif
										<td>
											@if($connection->deleted=='0')
												<form id="form" name="form" action="{{ route('connections.destroy', ['id' => $connection->id])}}" method="POST">
													{{ csrf_field() }}
													{{ method_field('DELETE') }}
											@else
												<form id="form" name="form" action="{{ route('connections.restore', ['id' => $connection->id]) }}" method="POST">
													{{ csrf_field() }}
											@endif
												<center>
													@if($connection->deleted=='0')
														<button type="submit" class="btn btn-danger" style="margin: 3px;" id="eliminar" name="eliminar" onclick="archiveFunction()" title="Eliminar conexion con el id {{ $connection->id }}"><span class="icofont icofont-ui-delete"></span></button>
													@else
														<button type="submit" class="btn btn-success" style="margin: 3px;" id="restaurar" name="restaurar" onclick="restoreFunction()" title="Restaurar conexion con el id {{ $connection->id }}"><span class="fas fa-reply"></span></a>
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
                    <th style="padding-right: 2.8%" scope="col">Matricula</th>
										<th style="padding-right: 2.8%" scope="col">Alumno</th>
                    <th style="padding-right: 2.8%" scope="col">Empresa</th>
                    <th style="padding-right: 2.8%" scope="col">Fecha Conexión</th>
										<th style="padding-left: 1.2%" scope="col" style="width:0%;"></th>
									</tr>
								</tfoot>
								@else
									<center>
										<div class="alert alert-warning icons-alert">
											<strong>Atención</strong>
											<p>No hay ninguna conexión realizada.</p>
										</div>
										<a href="{{ route('connections.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-plus"></i>Agregar Conexión</button></a>
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
	var button = '<a href="{{ route('connections.create') }}"><button class="btn btn-success" style="float:right;width:100%; min-width:150px"><i class="fa fa-plus"></i>Agregar Conexión</button></a>';
	applyStyleToDatatable(button, 'Buscar en conexiones...');
</script>
@endsection
