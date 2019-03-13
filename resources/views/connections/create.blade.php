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
						<span style="text-transform: none;">Llene los campos en la parte inferior para crear una nueva conexión.</span>
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

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Conexión :</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID de Conexión">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
              
							<div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="matricula">Alumno :</label>
                  <div class="col-sm-10">
                      <select class="form-control" onchange="obtener_empresas(this.value)" name="matricula" id="matricula">
                          @foreach ($students as $student)
                              <option value="{{ $student->university_id}}"> {{$student->university_id}} {{$student->first_name}} {{$student->last_name}} {{$student->second_last_name}}</option>
                          @endforeach
                      </select>
                  </div>
              </div>
              <br><br>
              
              <div id="empresas" class="form-group row">
              </div>
							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Conexión</button>
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
          
          var d = document.getElementById("empresas");
          while (d.hasChildNodes()){
            d.removeChild(d.firstChild);
          }
            
					if (companies!=null) {
            console.log(companies);
            
            companies.forEach(function (company){
              var iDiv = document.createElement('div');
              iDiv.id = 'block'+company;
              
              //iDiv.className = 'block';

              var imagen = document.createElement('img');
              imagen.src = "http://165.227.53.211/"+company.image_url;
              imagen.width = 200; 
              imagen.height = 200;
              iDiv.appendChild(imagen);
              
              var dir = document.createElement('a');
              dir.href = "/companies/"+company.id;
              dir.appendChild(iDiv);
              dir.className = "col-sm-3";
              /*
                <a
                  <div>  //iDiv
                      <img>
                      
                  </div>
                >
                
              */
              document.getElementById("empresas").appendChild(dir);
            });
					}else{
              console.log("No existen empresas");
						/*$("#error_id").text("");
						document.getElementById("error_id").style.display = "none";
						document.getElementById("registroEmpresa").style.display = "inline";*/
					}
				}
			});
    }
	</script>
@endsection
