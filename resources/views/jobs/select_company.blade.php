@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Vacantes")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color:tomato;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Seleccionar Empresa</h4>
						<span style="text-transform: none;">Favor de seleccionar la empresa para proceder a publicar su vacante.</span>
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
						<li class="breadcrumb-item">Vacantes
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
            <div class="row">
						@foreach($companies as $company)
              <div class="col-sm-4">
                <a href="{{ route('jobs.create', ['id' => $company->id]) }}">
                 <div class="card bg-info text-white widget-visitor-card">
                      <div class="card-block-small text-center">
                          <h2>{{$company->name}}</h2>
                          <i class="fa fa-briefcase"></i>
                      </div>
                  </div>
                </a>
                 
              </div>
            @endforeach
              </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


