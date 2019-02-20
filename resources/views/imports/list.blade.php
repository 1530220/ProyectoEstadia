@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Importar")

@section('style')

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/steps.css') }}" />

@endsection

@section('body')



<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card" style="margin-top: 0px;">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fas fa-file-import" style="background-color: #13a57c;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Importar CSV</h4>
						<span style="text-transform: none;">Importe los registros de las opciones inferior mediante un archivo .csv</span>
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
						<li class="breadcrumb-item">Importar</li>
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
				<!-- Design Wizard card start -->
				<div class="card">
					<div class="card-block">
						<section>
							<div class="wizard" style="background-color:transparent; margin-top: -40px;">
								<div class="wizard-inner">
									<div class="connecting-line"></div>
									<ul class="nav nav-tabs" role="tablist">

										<li id="tab-1" role="presentation" class="active" aria-expanded="false">
											<a id="a-1" href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1" class="active" aria-expanded="true">
												<span class="round-tab">
													<i class="glyphicon glyphicon-folder-open"></i>
												</span>
											</a>
										</li>

										<li id="tab-2" role="presentation" class="" aria-expanded="false">
											<a id="a-2" href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2" class="active" aria-expanded="true">
												<span class="round-tab">
													<i class="glyphicon glyphicon-pencil"></i>
												</span>
											</a>
										</li>
										<li id="tab-3" role="presentation" class="">
											<a id="a-3" href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3" class="" aria-expanded="false">
												<span class="round-tab">
													<i class="glyphicon glyphicon-picture"></i>
												</span>
											</a>
										</li>

										<li id="tab-4" role="presentation" class="">
											<a id="a-4" href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete" class="active" aria-expanded="true">
												<span class="round-tab">
													<i class="glyphicon glyphicon-ok"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>

								<form id="form" method="POST" action="{{ route('imports.store') }}" enctype="multipart/form-data">
									{{ csrf_field() }}
									<input type="text" name="actual_importation" id="actual_importation" hidden />
									<input type="text" name="importation_type" id="importation_type" hidden />
									<input type="text" name="table" id="table" hidden />
									<input type="text" name="second_table" id="second_table" hidden />
									<div id="content" style="margin:25px" class="tab-content">

										<div class="clearfix"></div>
									</div>
								</form>
							</div>
						</section>

					</div>
				</div>
				<!-- Design Wizard card end -->
			</div>
		</div>
	</div>
	<div hidden>
		<div class="tab-pane active" role="tabpanel" id="step1">
			<div class="form-group row" style="margin-top: -20px; margin-left:20px; margin-right:20px;">
				<h4><strong>Seleccione el tipo de importación que desee realizar:</strong></h4>
				<br />
			</div>
			<div class="page-body">
				<div class="row">
					<!-- card1 start -->
					<!-- user card start -->
					<div class="col-sm-4">
						<div class="card bg-c-yellow text-white widget-visitor-card" style="cursor:pointer">
							<div class="card-block-small text-center" id="import_careers_btn">
								<h2 id="import_careers_text" class="noselect">Carreras</h2>
								<br />
								<h6></h6>
								<i id="import_careers_icon" class="fa fa-cubes"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-white widget-visitor-card" style="background-color:#9b0946" >
							<div class="card-block-small text-center" id="import_classes_btn" style="cursor:pointer">
								<h2 id="import_classes_text" class="noselect">Materias</h2>
								<br />
								<h6></h6>
								<i id="import_classes_icon" class="fas fa-book-open"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-white widget-visitor-card" style="background-color:#ab7967" >
							<div class="card-block-small text-center" id="import_users_btn" style="cursor:pointer">
								<h2 id="import_users_text" class="noselect">Usuarios</h2>
								<br />
								<h6></h6>
								<i id="import_users_icon" class="fa fa-users"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="card bg-c-green text-white widget-visitor-card" style="max-height:143px; cursor:pointer">
							<div class="card-block-small text-center" id="import_tutors_btn">
								<h2 id="import_tutors_text" class="noselect">Tutores y Profesores</h2>
								<br />
								<h6></h6>
								<i id="import_tutors_icon" class="fas fa-user-graduate"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card bg-c-pink text-white widget-visitor-card" style="cursor:pointer">
							<div class="card-block-small text-center" id="import_students_btn">
								<h2 id="import_students_text" class="noselect">Alumnos</h2>
								<br />
								<h6></h6>
								<i id="import_students_icon" class="fa fa-user"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card text-white widget-visitor-card" style="background-color:#5E1287" >
							<div class="card-block-small text-center" id="import_assignation_btn" style="cursor:pointer">
								<h2 id="import_assignation_text" class="noselect">Asignacion</h2>
								<br />
								<h6></h6>
								<i id="import_assignation_icon" class="fas fa-link"></i>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="tab-pane" role="tabpanel" id="step2">
			<div class="form-group row" style="margin-top: -20px; margin-left:20px; margin-right:20px;">
				<strong><h4>Instrucciones para importar <span style="font-weight: bold; font-size: 20px" id="instructions_title"></span></h4></strong>
			</div>
			<div class="form-group row" style="margin-left:20px; margin-right:20px;">
				<h6 id="instructions_text">dedfasfas</h6>
			</div>
			<div style=padding-top:30px>
				<button id="tab_2_continue" style="float:right" type="button" class="btn btn-primary"><i id="tab_2_icon_continue" class="far fa-arrow-alt-circle-right"></i>Continuar</button>
				<button id="tab_2_return" style="float:left" type="button" class="btn btn-primary"><i id="tab_2_icon_return" class="far fa-arrow-alt-circle-left"></i>Regresar</button>
			</div>
		</div>
		<div class="tab-pane" role="tabpanel" id="step3">
				<div class="form-group row" style="margin-top: -20px; margin-left:20px; margin-right:20px;">
					<strong><h4>Adjunte el archivo CSV de los registros de <span style="font-weight: bold; font-size: 20px" id="tab_3_title"></span></h4></strong>
					<br />
				</div>
				<div class="form-group row">
					<div class="col-sm-12">
						<div class="file-upload">
							<div class="image-upload-wrap">
								<input id="csv_input" class="file-upload-input" type='file' name="csv_input" onchange="readURLForImportation(this);" accept=".csv" />
								<div style="padding-top:40px" onclick="$('.file-upload-input').trigger('click' )">
									<center>
										<i style="font-size: 60px;" class="fas fa-cloud-upload-alt drag-icon"></i>
									</center>
								</div>
								<div class="drag-text">
									<span>Arrastre y suelte la imagen del alumno <span style="font-weight: bold; font-size:16px;"> aquí</span> o haga clic <span style="font-weight: bold; font-size:16px;"> aquí</span> para buscarla en su equipo.</span>
								</div>
							</div>
							<div class="file-upload-content">
								<img class="file-upload-image" src="#" alt="your image" />
								<div class="image-title-wrap">
									<button type="button" onclick="removeUpload()" class="remove-image">Remover CSV</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style=padding-top:30px>
					<button id="upload_file" style="float:right" type="submit" class="btn btn-success"><i id="upload_file_icon" class="icofont icofont-check-circled"></i>Mandar Archivo y Continuar</button>
					<button id="tab_3_return" style="float:left" type="button" class="btn btn-primary"><i id="tab_3_icon_return" class="far fa-arrow-alt-circle-left"></i>Regresar</button>
				</div>

		</div>
		<div class="tab-pane" role="tabpanel" id="step4">
			<div class="form-group row" style="margin-top: -20px; margin-left:20px; margin-right:20px;">
				<h4><strong>Resultados: </strong></h4>
			</div>
			<div class="form-group row" style="margin-left:20px; margin-right:20px;">
				<div class="dt-responsive table-responsive">
					<table style="width:100%" id="datatable_results" class="table table-striped table-bordered">
						<thead id="table_header">
							<tr>
								<th class="all" scope="col" style="width: 5%">ID</th>
								<th class="all" scope="col" style="width: 15%">Tipo</th>
								<th class="all" scope="col" style="width: 90%">Mensaje</th>
								<th class="none">Valores del Registro</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot>
				            <tr>
				                <th>ID</th>
				                <th>Tipo</th>
				                <th>Mensaje</th>
				                <th>Valores del Registro</th>
				            </tr>
				        </tfoot>
					</table>
				</div>
			</div>
			<div style=padding-top:0px>
				<button id="tab_4_return" style="float:left" type="button" class="btn btn-primary"><i id="tab_4_icon_return" class="far fa-arrow-alt-circle-left"></i>Regresar al Inicio</button>
			</div>

		</div>
	</div>

	<!-- Modal -->
	<div id="loading_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div style="padding-top:9%" class="loader-block">
			 <svg id="loader2" viewBox="0 0 100 100">
			 <circle id="circle-loader2" cx="50" cy="50" r="45"></circle>
			 </svg>
	 	</div>
		<center>
			<h4 id="myModalLabel" style="color:white;">Cargando archivo .csv</h4>
			<h5 style="color:white;">Por favor espere...</h5>

		</center>
	</div>

	<!-- Page body end -->
	@endsection

	@section('javascriptcode')
	<script>

		var dt_reports;
		var wrong_csv=false;

		var actual_importation="";
		var importation_from_get="";
		@if(Request::get('type')!=null)
			importation_from_get="@php echo(Request::get('type')) @endphp";
		@endif
		@if($is_uploaded=="true")
			actual_importation="SI";
			var row_result = @php echo(json_encode($row_result)) @endphp;
			var results=true;
		@elseif($is_uploaded=="false")
			var results=false;
		@elseif($is_uploaded=="wrong")
			wrong_csv=true;
			actual_importation="@php echo($actual_importation) @endphp";
			var results=false;
		@endif

		if(importation_from_get!=""){
			switch(importation_from_get){
				case 'students':
					actual_importation="Alumnos";
					break;
				case 'tutors':
					actual_importation="Tutores";
					break;
				case 'careers':
					actual_importation="Carreras";
					break;
				case 'asignation':
					actual_importation="Asignacion";
					break;
				case 'classes':
					actual_importation="Materias";
					break;
				case 'users':
					actual_importation="Usuarios";
					break;
			}
		}
		var instructions_for=[];

		instructions_for['Alumnos']=' <div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/students.png')}}" class="img-fluid p-b-10 rounded"></div></div><div class="row"> <div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo requiere de la importación de carreras y la importación de tutores.</strong></p> <div class="col-sm-12 col-xl-6"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_alumno</li> <li style="margin-left: 20px;"><strong> - </strong>Matricula</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>AP_Paterno</li> <li style="margin-left: 20px;"><strong> - </strong>AP_Materno</li> <li style="margin-left: 20px;"><strong> - </strong>Username</li> <li style="margin-left: 20px;"><strong> - </strong>Password</li> <li style="margin-left: 20px;"><strong> - </strong>ID_carrera</li> <li style="margin-left: 20px;"><strong> - </strong>ID_tutor</li> </ul> <br /> <p><strong>ID_alumno:</strong> es el identificador de cada alumno con respecto a otros usuarios de la institución.</p> <p><strong>Matricula:</strong> es el identificador de los alumnos de la institución.</p> <p><strong>Nombre:</strong> es el nombre o nombres del alumno.</p> </div> <div class="col-sm-12 col-xl-6"> <p><strong>AP_Paterno:</strong> contiene el apellido paterno de los alumnos a importar.</p> <p><strong>AP_Materno:</strong> es el apellido materno de los alumnos, en caso de no tener, simplemente dejarlo vacío.</p> <p><strong>Username:</strong> es el nombre de usuario con el cual podrá ingresar al sistema.</p> <p><strong>Password:</strong> es la clave para acceder al sistema de acuerdo a un nombre de usuario.</p> <p><strong>ID_carrera:</strong> es una clave foránea a la tabla de carreras, es decir, a la que pertenece el alumno.</p> <p><strong>ID_tutor:</strong> es una forma de identificar al tutor del alumno, mediante una llave foránea a la tabla de tutores.</p> </div> </div> </div> <div class="row" style="margin-left:20px"> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/students.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo csv de ejemplo</a></h6> </div> ';
		instructions_for['Tutores']='<div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/tutors.png')}}" class="img-fluid p-b-10 rounded"></div></div> <div class="row"> <div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo requiere de la importación de carreras.</strong></p> <div class="col-sm-12 col-xl-6"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_profesor</li> <li style="margin-left: 20px;"><strong> - </strong>Num_empleado</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>AP_Paterno</li> <li style="margin-left: 20px;"><strong> - </strong>AP_Materno</li> <li style="margin-left: 20px;"><strong> - </strong>Username</li> <li style="margin-left: 20px;"><strong> - </strong>Password</li> <li style="margin-left: 20px;"><strong> - </strong>ID_carrera</li> <li style="margin-left: 20px;"><strong> - </strong>Tutor</li> </ul> <br /> <p><strong>ID_profesor:</strong> es el identificador de cada profesor o tutor con respecto a otros usuarios de la institución.</p> <p><strong>Num_empleado:</strong> es el identificador de cada empleado de la institución.</p> <p><strong>Nombre:</strong> es el nombre o nombres del tutor o profesor.</p> </div> <div class="col-sm-12 col-xl-6"> <p><strong>AP_Paterno:</strong> contiene el apellido paterno de los tutores o profesores a importar.</p> <p><strong>AP_Materno:</strong> es el apellido materno de los tutores o profesores, en caso de no tener, simplemente dejarlo vacío.</p> <p><strong>Username:</strong> es el nombre de usuario con el cual podrá ingresar al sistema.</p> <p><strong>Password:</strong> es la clave para acceder al sistema de acuerdo a un nombre de usuario.</p> <p><strong>ID_carrera:</strong> es una clave foránea a la tabla de carreras, es decir, a la que pertenece el profesor o tutor.</p> <p><strong>Tutor:</strong> es una forma de identificar si el profesor es tutor o no.</p></div> </div> <div class="row" style="margin-left: 20px;"> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/tutors.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo .csv de ejemplo</a></h6></div></div>';
		instructions_for['Carreras']='<div class="form-group row" style="margin-left:20px; margin-right:20px;"> <!--<h6 id="instructions_text"></h6>--> <br> <div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/careers.png')}}" class="img-fluid p-b-10 rounded"></div></div> <div class="row"> <div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado sin realizar revisiones previas.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_carrera</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>Abreviacion</li> </ul> <br /> <p><strong>ID_carrera</strong> es el identificador de cada carrera de la institución.</p> <p><strong>Nombre</strong> es el nombre completo de cada carrera de la institución.</p> <p><strong>Abreviacion</strong> es una forma de identificar a una carrera sin recurrir al nombre.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/careers.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo csv de ejemplo</a></h6></div> </div> </div> <br> </div>';
		instructions_for['Materias']=' <div class="row"> <div class="col-sm-12 col-xl-6"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_materia</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> </ul> <br /> <p><strong>ID_materia</strong> es el identificador de cada materia registrada en el sistema.</p> <p><strong>Nombre</strong> es el nombre completo de cada materia que se imparte en la institución.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/classes.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo .csv de ejemplo</a></h6> </div> </div> <div class="col-sm-12 col-xl-6"> <img src="{{asset('import_help/images/classes.png')}}" alt="CSV" class="img-fluid p-b-10 rounded"> </div> </div>';
		instructions_for['Asignacion']='<div class="row"> <div class="col-sm-12 col-xl-9"> <p><strong>NOTA: Este módulo requiere de la importación de alumnos y la importación de tutores.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_alumno</li> <li style="margin-left: 20px;"><strong> - </strong>ID_tutor</li> </ul> <br /> <p><strong>ID_alumno</strong> es el identificador de cada alumno registrado en el sistema.</p> <p><strong>ID_tutor</strong> es el identificador de cada tutor registrado en el sistema.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/assignation.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo csv de ejemplo</a></h6> </div> </div> <div class="col-sm-12 col-xl-3"> <img src="{{asset('import_help/images/assignations.png')}}" alt="CSV de Alumnos" class="img-fluid p-b-10 rounded" > </div> </div>';
		instructions_for['Usuarios']=' <div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/users.png')}}" class="img-fluid p-b-10 rounded"></div></div> <div class="row"> <div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado.</strong></p> <div class="col-sm-12 col-xl-6"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_usuario</li> <li style="margin-left: 20px;"><strong> - </strong>Num_empleado</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>AP_Paterno</li> <li style="margin-left: 20px;"><strong> - </strong>AP_Materno</li> <li style="margin-left: 20px;"><strong> - </strong>Username</li> <li style="margin-left: 20px;"><strong> - </strong>Password</li> <li style="margin-left: 20px;"><strong> - </strong>Tipo_usuario</li> </ul> <br /> <p><strong>ID_usuario:</strong> es el identificador de cada empleado con respecto a otros usuarios de la institución.</p> <p><strong>Num_empleado:</strong> es el identificador de cada empleado de la institución.</p> <p><strong>Nombre:</strong> es el nombre o nombres del empleado.</p> </div> <div class="col-sm-12 col-xl-6"> <p><strong>AP_Paterno:</strong> contiene el apellido paterno de un empleado a importar.</p> <p><strong>AP_Materno:</strong> es el apellido materno de un empleado, en caso de no tener, simplemente dejarlo vacío.</p> <p><strong>Username:</strong> es el nombre de usuario con el cual podrá ingresar al sistema.</p> <p><strong>Password:</strong> es la clave para acceder al sistema de acuerdo a un nombre de usuario.</p> <p><strong>Tipo_usuario:</strong> es un identificador para conocer a que departamento pertenece tal empleado (Tutorías, Salud o Psicología)..</p> </div> </div> </div> <div class="row" style="margin-left:20px"> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/users.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo csv de ejemplo</a></h6> </div>';

		function resetClass() {
			$("#tab-1").removeClass('active');
			$("#tab-2").removeClass('active');
			$("#tab-3").removeClass('active');
			$("#tab-4").removeClass('active');
		}

		function first_tab(){
			actual_importation="";
			$("#actual_importation").val("");
			results=false;
			resetClass();
			$("#content").html('<div class="tab-pane active" role="tabpanel"' + $("#step1").html() + "</div>");
			$("#tab-1").addClass('active');
		}
		function second_tab(){
			if(actual_importation!=""){
				resetClass();
				$("#content").html('<div class="tab-pane active" role="tabpanel"' + $("#step2").html() + "</div>");
				$("#tab-2").addClass('active');
				if(actual_importation!=""){
					$("#instructions_title").text(actual_importation);
					console.log(instructions_for[actual_importation]);
					$("#instructions_text").html(instructions_for[actual_importation]);
				}
			}else{
				$("#content").html('<div class="tab-pane active" role="tabpanel"' + $("#step1").html() + "</div>");
				$("#tab-1").addClass('active');
			}
		}

		function third_tab(){
			if(actual_importation!=""){
				resetClass();
				$("#content").html('<div class="tab-pane active" role="tabpanel"' + $("#step3").html() + "</div>");
				$("#tab-3").addClass('active');
				$("#tab_3_title").text(actual_importation);
			}else{
				$("#content").html('<div class="tab-pane active" role="tabpanel"' + $("#step1").html() + "</div>");
				$("#tab-1").addClass('active');
			}
		}

		function fourth_tab(){
			if(actual_importation!="" && results==true){
				resetClass();
				$("#content").html('<div class="tab-pane active" role="tabpanel"' + $("#step4").html() + "</div>");
				$("#tab-4").addClass('active');
				dt_reports = $('#datatable_results').DataTable({
					columns: [
						{title: "ID"},
						{title: "Tipo"},
						{title: "Mensaje"},
						{title: "Valores del Registro"},
					],
					responsive: true,
					dom: 'frtip',
				});
				dt_reports.clear().draw();
				for (var i = 0; i < row_result.length; i++) {


					var siz=Object.keys(row_result[i][2])[0];
					var details_table_html='<table style="width:100%"><thead><tr>';
					for(var j=0;j<row_result[i][2][siz].length;j++){
						details_table_html=details_table_html+"<td>"+row_result[i][2][siz][String(j)]["1"]+"</td>";
					}

					details_table_html=details_table_html+'</tr></thead><tbody><tr>';
					for(var j=0;j<row_result[i][2][siz].length;j++){
						details_table_html=details_table_html+"<td>"+row_result[i][2][siz][String(j)]["0"]+"</td>";
					}
					details_table_html=details_table_html+'</tr></tbody></table>';
					type_html="";
					switch(row_result[i][0]){
						case 'Error':
							type_html='<i style="color:red" class="fas fa-times-circle"></i> Error';
							break;
						case 'Stays':
							type_html='<i style="color:blue" class="fas fa-info-circle"></i> Informacion';
							break;
						case 'Update':
							type_html='<i style="color:#e29528" class="fas fa-chevron-circle-up"></i> Actualizacion';
							break;
						case 'Correct':
							type_html='<i style="color:green" class="fas fa-check-circle"></i> Registrado';
							break;
					}


					dt_reports.row.add([
						row_result[i][2][siz]["0"]["0"],
						type_html,
						row_result[i][1],
						details_table_html
					]).draw();
				}
			}else{
				$("#content").html('<div class="tab-pane active" role="tabpanel"' + $("#step1").html() + "</div>");
				$("#tab-1").addClass('active');
			}
		}

		function is_selected_importation_type(){
			if(actual_importation==""){
				swal({
		            icon: 'error',
		            title: 'No puede ingresar a la seccion',
		            text: 'Para ingresar primero seleccione el tipo de importacion que desee realizar',
		            buttons: 'Aceptar',
		        })
			}
		}

		function is_updated_csv(){
			if(results==false){
				swal({
		            icon: 'error',
		            title: 'No puede ingresar a la seccion',
		            text: 'Para ingresar primero carge y envie el archivo .csv al sistema',
		            buttons: 'Aceptar',
		        })
				third_tab();
				return false;
			}
			return true;
		}

		function after_uploading(){
			if(results==true){
				swal({
		            icon: 'error',
		            title: 'Seccion no disponible',
		            text: 'Esta seccion no esta disponible actualmente, termine o comience una nueva importacion para acceder aqui',
		            buttons: 'Aceptar',
		        })
				fourth_tab();
			}
		}

		$(document).ready(function() {

			if(!wrong_csv){
				if(results){
					fourth_tab();
				}else{
					if(importation_from_get!=""){
						second_tab();
					}else{
						first_tab();
					}
				}
			}else{
				swal({
		            icon: 'error',
		            title: 'Csv con formato incorrecto',
		            text: 'El archivo .csv que subio, no tiene el formato correcto. Intente subir el archivo nuevamente con el formato requerido para la importacion de '+actual_importation.toLowerCase(),
		            buttons: 'Aceptar',
		        })
				third_tab();
			}



			$("#content").click(function(e){
				console.log(e.target.id);
				switch(e.target.id){
					case 'import_students_btn':
					case 'import_students_text':
					case 'import_students_icon':
						actual_importation="Alumnos";
						$("#actual_importation").val("Alumnos");
						second_tab();
						break;
					case 'import_tutors_btn':
					case 'import_tutors_text':
					case 'import_tutors_icon':
						actual_importation="Tutores";
						$("#actual_importation").val("Tutores");
						second_tab();
						break;
					case 'import_careers_btn':
					case 'import_careers_text':
					case 'import_careers_icon':
						actual_importation="Carreras";
						$("#actual_importation").val("Carreras");
						second_tab();
						break;
					case 'import_classes_btn':
					case 'import_classes_text':
					case 'import_classes_icon':
						actual_importation="Materias";
						$("#actual_importation").val("Materias");
						second_tab();
						break;
					case 'import_assignation_btn':
					case 'import_assignation_text':
					case 'import_assignation_icon':
						actual_importation="Asignacion";
						$("#actual_importation").val("Asignacion");
						second_tab();
						break;
					case 'import_users_btn':
					case 'import_users_text':
					case 'import_users_icon':
						actual_importation="Usuarios";
						$("#actual_importation").val("Usuarios");
						second_tab();
						break;
					case 'tab_3_return':
					case 'tab_3_icon_return':
						second_tab();
						break;
					case 'upload_file':
					case 'upload_file_icon':
						//send_file();
						//fourth_tab();
						//results=true;
						break;
					case 'tab_2_return':
					case 'tab_2_icon_return':
						first_tab();
						actual_importation=""
						$("#actual_importation").val("");
						break;
					case 'tab_2_continue':
					case 'tab_2_icon_continue':
						third_tab();
						break;
					case 'tab_4_return':
					case 'tab_4_icon_return':
						first_tab();
						actual_importation=""
						$("#actual_importation").val("");
						results=false;
						break;
				}
			});



		});

		$("#form").submit(function(e){

			if(!$("#csv_input").val()){
				swal({
		            icon: 'error',
		            title: 'Archivo .csv requerido',
		            text: 'Por favor, cargue el archivo .csv para continuar',
		            buttons: 'Aceptar',
		        })
				e.preventDefault();
			}else{
				if($("#importation_type").val()==null){
					e.preventDefault();
				}else{
					$('#loading_modal').modal('show');
					switch(actual_importation){
						case 'Alumnos':
							$("#importation_type").val('import_students');
							$("#table").val('users');
							$("#second_table").val('students');
							$("#form").submit();
							break;
						case 'Carreras':
							$("#importation_type").val('import_careers');
							$("#table").val('careers');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Tutores':
							$("#importation_type").val('import_teachers');
							$("#table").val('users');
							$("#second_table").val('teachers');
							$("#form").submit();
							break;
						case 'Materias':
							$("#importation_type").val('import_classes');
							$("#table").val('student_classes');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Asignacion':
							$("#importation_type").val('assignation');
							$("#table").val('students');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Usuarios':
							$("#importation_type").val('import_users');
							$("#table").val('users');
							$("#second_table").val('');
							$("#form").submit();
							break;
					}
				}
			}
		});

		$("#tab-1").click(function() {
			first_tab();
		});
		$("#tab-2").click(function() {
			second_tab();
			is_selected_importation_type();
			after_uploading();
		});
		$("#tab-3").click(function() {
			third_tab();
			is_selected_importation_type();
			after_uploading();
		});
		$("#tab-4").click(function() {
			fourth_tab();
			is_selected_importation_type();
			is_updated_csv();
		});

		$("#a-1").click(function() {
			first_tab();
		});
		$("#a-2").click(function() {
			second_tab();
		});
		$("#a-3").click(function() {
			third_tab();
		});
		$("#a-4").click(function() {
			fourth_tab();
		});



	</script>
	@endsection
