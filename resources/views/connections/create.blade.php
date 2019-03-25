@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Conexión")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color:cornflowerblue;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Crear Conexión</h4>
						<span style="text-transform: none;">Permitir que un alumno pueda seguir a una empresa.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('connections.list') }}">Conexiones</a>
						</li>
						<li class="breadcrumb-item">Crear Conexión
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
						<form id="form" method="POST" action="{{ route('connections.list') }}">
							{!! csrf_field() !!}

              <h6><strong>Selecciona un estudiante para visualizar las empresas que puede seguir.</strong> </h6> <br>
							<div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="matricula">Alumno :</label>
                  <div class="col-sm-10">
                      <select class="form-control" onchange="obtener_empresas(this.value)" name="matricula" id="matricula">
                          <option value="0"> Seleccionar estudiante</option>
                          @foreach ($students as $student)
                              <option value="{{ $student->university_id}}"> {{$student->university_id}} {{$student->first_name}} {{$student->last_name}} {{$student->second_last_name}}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <br><br>
              <div id="instruccions" class="form-group row">
                  
              </div>
              <center>
                <div id="empresas" class="form-group row">
                    
                </div>
              </center>
              
              <center>
                <div id="alerta" class="alert alert-warning icons-alert" style="display:none;">
                  <strong>Atención</strong>
                  <p>No existe alguna empresa disponible para que el estudiante seleccionado pueda conectarse.</p>
                </div>
              </center>
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary col-lg-3"><i class="icofont icofont-arrow-left"></i>Regresar</a>
                <button type="submit" class="btn btn-success col-lg-3"><i class="icofont icofont-check-circled"></i>Realizar conexión</button>
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
		error_divs = [
			$('#error_id'),
		];
		verify_column($('#id'), 'id', 'connections_companies', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'connections_companies', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
    
    
    function obtener_empresas(matricula){
      if(matricula != 0){
        
      
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			});
			$.ajax({
				url: '{{ route('connections.verific_companies') }}',
				method: 'post',
				data: {
					student_id: matricula,
				},
				success: function(result) {

					companies = result['response'];
          num_companies = result['num_companies'];
        
          var d = document.getElementById("empresas");
          while (d.hasChildNodes()){
            d.removeChild(d.firstChild);
          }
          
          var r = document.getElementById("instruccions");
          while (r.hasChildNodes()){
            r.removeChild(r.firstChild);
          }
					if (num_companies!=0) {
            document.getElementById("alerta").style.display = "none";
            
            var label = document.createElement('label');
            label.append("Selecciona la empresa a seguir :");
            
            
            var n = document.createElement("strong");
            n.className ="col-sm-6";
            n.appendChild(label);
            
            document.getElementById("instruccions").appendChild(n);
            
            
            companies.forEach(function (company){
              var iDiv = document.createElement('div');
              iDiv.id = 'block';
              
              var imagen = document.createElement('img');
              imagen.src = "http://165.227.53.211/"+company.image_url;
              imagen.width = 220; 
              
             
              var div_check = document.createElement("div");
              div_check.className= "col-sm-4 checkbox-fade fade-in-inverse";
              
              var label = document.createElement("label");
              var input = document.createElement("input");
              input.type = "checkbox";
              input.value = company.id;
              input.name = "companies_connect[]";
              
              var span = document.createElement("span");
              span.className="cr";
              
              var i = document.createElement("i");
              i.className ="cr-icon icofont icofont-ui-check txt-inverse";
            
              span.appendChild(i);
              
              label.appendChild(input);
              label.appendChild(span);
              
              div_check.appendChild(label);
              
              iDiv.appendChild(imagen);
              iDiv.appendChild(div_check);
              
              //<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Medalla</button>

              var dir = document.createElement('a');
              dir.href = "/companies/"+company.id;
              dir.className = "col-sm-4";
              dir.appendChild(iDiv);
              
              
              document.getElementById("empresas").appendChild(dir);
            });
					}else{
						document.getElementById("alerta").style.display = "block";
					}
				}
			});
    }else{
      document.getElementById("instruccions").style.display = "none";
      document.getElementById("empresas").style.display = "none";
    }
    }
	</script>
@endsection
