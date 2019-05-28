@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Modificar Puntuaciones de Habilidades")

@section('body')

<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="icofont icofont-ui-edit" style="background:firebrick;"></i>
					<div class="d-inline">
                        <h4 style="text-transform: none;">Modificar puntuaciones de habilidades</h4>
                        <span style="text-transform: none;">Puntuaciones de habilidades para el estudiante con matricula <strong>{{$id}}</strong>.</span>
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
                        <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $id])}}">Detalles del Alumno</a>
                        </li>
                        <li class="breadcrumb-item">Modificar Puntuaciones de Habilidades</li>
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
                        <form id="form" method="POST" action="{{ url("skill/{$id}") }}">
                            {{ method_field('PUT') }}
                            {!! csrf_field() !!}

                            @if ($num_skills == 0)
                                <div class="alert alert-primary icons-alert">
                                    <p><strong>Sin Habilidades</strong></p>
                                    <p>El estudiante no posee ninguna habilidad.</p>
                                </div>
                            @endif
                            <br>
                            <div class="row">
                                @foreach ($skills as $skill)
                                    <div class="col-lg-6 col-xl-4">
                                      <center>  
                                        <h5>{{$skill->name}}</h5><br>
                                        <h6>Puntuación actual: <strong>{{$skill->score}}</strong></h6>
                                        <h6>Ajustar nueva puntuación</h6>
                                
                                        <input type="text" class="dial" name="{{$skill->id}}" value="{{$skill->score}}" data-width="200" data-height="200" data-fgColor="firebrick" data-skin="tron" data-thickness=".1" data-angleOffset="180">
                                      </center>
                                    </div>
                                @endforeach
                            </div>

                            <br>
                            <center>
                                <a style="color:white" onclick="confirmationOnReturn('{{ url()->previous() }}')" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
                                @if ($num_skills != 0)
                                    <button type="submit" class="btn btn-success"><i class="icofont icofont-refresh"></i>Actualizar Puntuaciones</button>
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
