@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Postular Alumno a Vacante")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color:#FFB67F;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Postular Alumno a Vacante</h4>
						<span style="text-transform: none;">Realizar una postulación de un alumno a una vacante.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('status_job.list') }}">Postulaciones</a>
						</li>
						<li class="breadcrumb-item">Postular Alumno a Vacante
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
						<form id="form" method="POST" action="{{ route('status_job.list') }}">
							{!! csrf_field() !!}

              <h6><strong>Selecciona un estudiante para visualizar las vacantes.</strong> </h6> <br>
							<div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="matricula">Alumno :</label>
                  <div class="col-sm-10">
                      <select class="form-control" onchange="obtener_vacantes(this.value)" name="matricula" id="matricula">
                          @foreach ($students as $student)
                              <option value="{{ $student->university_id}}"> {{$student->university_id}} {{$student->first_name}} {{$student->last_name}} {{$student->second_last_name}}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <br><br>
              <div id="instruccions" class="form-group row">
                  
              </div>
              
              <!--<center>
                <div id="empresas" class="form-group row">
                    
                </div>
              </center>-->
              
              <div id="vacantes" style="display:none;" class="card-block table-border-style">
                <div class="table-responsive">
                  <table class="table table-hover">
                    @if ($jobs->isNotEmpty())
                      <thead>
                        <tr>
                          <th class="all" scope="col">ID</th>
                          <th scope="col" >Nombre</th>
                          <th scope="col" >Empresa</th>
                          <th scope="col" >Postulación</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($jobs as $job)
                          <tr>
                            <td>{{ $job->id }}</td>
                            <td><a href="{{ route('jobs.show',['id' => $job->id])}}">{{$job->name }}</a></td>
                            <td><a href="{{ route('companies.show',['id' => $job->id_company])}}">{{$job->name_company }}</a></td>
                            <td><a id="action{{$job->id}}"></a></td>
                          </tr>
                        @endforeach
                      </tbody>
                    @else
                      <center>
                        <div class="alert alert-primary icons-alert">
                          <strong>No existen evidencias en el Portafolio del estudiante</strong>
                          <p>El estudiante no ha subido ninguna evidencia.</p>
                        </div>
                      </center>
                    @endif
                  </table>
                </div>
              </div>

              
              
             
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary col-lg-3"><i class="icofont icofont-arrow-left"></i>Regresar</a>
                <!--<button type="submit" class="btn btn-success col-lg-3"><i class="icofont icofont-check-circled"></i>Realizar conexión</button>-->
							</center>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascriptcode')
	<script>
		
    
    function obtener_vacantes(matricula){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			});
			$.ajax({
				url: '{{ route('status_job.verific_jobs') }}',
				method: 'post',
				data: {
					student_id: matricula,
				},
				success: function(result) {

					data_jobs = result['response'];
          num_jobs_student = result['num_jobs_student'];
          data_status_job = result['data_status_job'];
          
          
          var r = document.getElementById("instruccions");
          while (r.hasChildNodes()){
            r.removeChild(r.firstChild);
          }
        
            ////  label /////////////////////////////////////////////////////////
            var label = document.createElement('label');
            label.append("Vacantes Registradas  :");
            
            var n = document.createElement("strong");
            n.className ="col-sm-6";
            n.appendChild(label);
            
            document.getElementById("instruccions").appendChild(n);
            document.getElementById("vacantes").style.display="block";
            ////////////////////////////////////////////////////////////////////
            var flag;
            data_jobs.forEach(function (job){
              var a = document.getElementById("action"+job.id);
              var flag = 0;
              data_status_job.forEach(function (status){
                if(status.id_job == job.id && status.status === "Pendiente"){
                  a.className = "btn btn-danger col-lg-6";
                  a.innerHTML= "<strong>Cancelar</strong>";
                  a.href="/status_job/postular/cancelar/"+status.id;
                  flag = 1;
                }
                if(status.id_job == job.id && status.status === "Aceptado"){
                  a.className = "btn btn-disabled disabled col-lg-6";
                  a.innerHTML= "<strong>Aceptado</strong>";
                  a.href="#";
                  flag = 1;
                }
              });
              if(flag == 0){
                a.className = "btn btn-success col-lg-6";
                a.innerHTML = "<strong>Postularme</strong>";
                a.href="/status_job/postular/"+job.id+"?matricula="+matricula;
              }
            });
					
				}
			});
    }
	</script>
@endsection
