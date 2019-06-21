@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Asignar Medallas")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-check" style="background-color:#5e1287;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Asignar Medallas</h4>
                        <span style="text-transform: none;">Seleccione las medallas que desea asignar al estudiante con matricula <strong>{{$id}}</strong>.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('medals.list') }}">Alumnos</a>
						</li>
                        <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $id])}}">Detalles del Alumno</a>
                        </li>
                        <li class="breadcrumb-item">Asignar Medallas</li>
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
						<form id="form" method="POST" action="{{ route('medals.guardarAsignaciones',['id' => $id]) }}">
							{!! csrf_field() !!}

                            <h6>Medallas asignadas anteriormente:</h6><br>
                            @if (count($medals_asigned) == 0)
                                <div class="alert alert-primary icons-alert">
                                    <p><strong>Sin Medallas</strong></p>
                                    <p>El estudiante no posee ninguna medalla.</p>
                                </div>
                            @endif
                            @foreach ($medals_asigned as $medals)
                                <img src="{{$medals->image}}" alt="{{$medals->name}}" title="{{$medals->name}}" width="150">
                                <div class="col-sm-3 checkbox-fade fade-in-disable">
                                    <label>
                                        <input type="checkbox" value="" name="" disabled checked="checked">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-default"></i>
                                        </span>
                                    <span> {{$medals->name}}</span>
                                    </label>
                                </div>
                            @endforeach
                            <br><br>
							<h6>Medallas que pueden ser asignadas:</h6><br>
							@if (count($medals_not_asigned)==0)
								<div class="alert alert-primary icons-alert">
									<p><strong>Sin medallas disponibles</strong></p>
									<p>No existe alguna medalla que pueda ser asignada al estudiante.</p>
								</div>
              <center><a href="{{ route('medals.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>Agregar Medallas</a></center>
							@endif
                            @foreach ($medals_not_asigned as $medals)
                                <img src="{{$medals->image}}" alt="{{$medals->name}}" title="{{$medals->name}}" width="150">

                                <div class="col-sm-3 checkbox-fade fade-in-inverse">
                                    <label>
                                        <input type="checkbox" value="{{ $medals->id }}" name="medals_not_asigned[]">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-inverse"></i>
                                        </span>
                                    <span> {{$medals->name}}</span>
                                    </label>
                                </div>
                            @endforeach

							<br><br><br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								@if (count($medals_not_asigned)!=0)
									<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Asignar Medallas</button>
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
					<i class="fa fa-check" style="background-color:#fcb650;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Asignar Medallas</h4>
              <span style="text-transform: none;">Seleccione las medallas que desea asignar al tutorado con matricula <strong>{{$id}}</strong>.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('medals.list') }}">Tutorados</a>
						</li>
            <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $id])}}">Detalles de Tutorado</a>
            </li>
            <li class="breadcrumb-item">Asignar Medallas</li>
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
						<form id="form" method="POST" action="{{ route('medals.guardarAsignaciones',['id' => $id]) }}">
							{!! csrf_field() !!}

              <h6>Medallas asignadas anteriormente:</h6><br>
              @if (count($medals_asigned) == 0)
                  <div class="alert alert-primary icons-alert">
                      <p><strong>Sin Medallas</strong></p>
                      <p>El tutorado no posee ninguna medalla.</p>
                  </div>
              @endif
              @foreach ($medals_asigned as $medals)
                  <img src="{{$medals->image}}" alt="{{$medals->name}}" title="{{$medals->name}}" width="150">
                  <div class="col-sm-3 checkbox-fade fade-in-disable">
                      <label>
                          <input type="checkbox" value="" name="" disabled checked="checked">
                          <span class="cr">
                              <i class="cr-icon icofont icofont-ui-check txt-default"></i>
                          </span>
                      <span> {{$medals->name}}</span>
                      </label>
                  </div>
              @endforeach
              <br><br>
							<h6>Medallas que pueden ser asignadas:</h6><br>
							@if (count($medals_not_asigned)==0)
								<div class="alert alert-primary icons-alert">
									<p><strong>Sin medallas disponibles</strong></p>
									<p>No existe alguna medalla que pueda ser asignada al tutorado.</p>
								</div>
							@endif
                @foreach ($medals_not_asigned as $medals)
                    <img src="{{$medals->image}}" alt="{{$medals->name}}" title="{{$medals->name}}" width="150">

                    <div class="col-sm-3 checkbox-fade fade-in-inverse">
                        <label>
                            <input type="checkbox" value="{{ $medals->id }}" name="medals_not_asigned[]">
                            <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-inverse"></i>
                            </span>
                        <span> {{$medals->name}}</span>
                        </label>
                    </div>
                @endforeach

							<br><br><br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								@if (count($medals_not_asigned)!=0)
									<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Asignar Medallas</button>
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