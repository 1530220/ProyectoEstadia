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
											<a id="a-1" href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Seleccionar tipo de importación" class="active" aria-expanded="true">
												<span class="round-tab">
													<i class="glyphicon glyphicon-folder-open"></i>
												</span>
											</a>
										</li>

										<li id="tab-2" role="presentation" class="" aria-expanded="false">
											<a id="a-2" href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Instrucciones" class="active" aria-expanded="true">
												<span class="round-tab">
													<i class="glyphicon glyphicon-pencil"></i>
												</span>
											</a>
										</li>
										<li id="tab-3" role="presentation" class="">
											<a id="a-3" href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Subir archivo CSV" class="" aria-expanded="false">
												<span class="round-tab">
													<i class="glyphicon glyphicon-picture"></i>
												</span>
											</a>
										</li>

										<li id="tab-4" role="presentation" class="">
											<a id="a-4" href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Completado" class="active" aria-expanded="true">
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
				<h4><strong>Seleccione el tipo de importación que desea realizar:</strong></h4>
				<br />
			</div>
			<div class="page-body">
				<div class="row">
					<!-- card1 start -->
					<!-- user card start -->
					<div class="col-sm-6">
						<div class="card text-white widget-visitor-card" style="cursor:pointer; background-color:lightseagreen;">
							<div class="card-block-small text-center" id="import_companies_btn">
								<h2 id="import_companies_text" class="noselect">Empresas</h2>
								<br/>
								<i id="import_companies_icon" class="fa fa-building"></i>
							</div>
						</div>
					</div>
          
					<div class="col-sm-6">
						<div class="card text-white widget-visitor-card" style="background-color:seagreen" >
							<div class="card-block-small text-center" id="import_contacts_btn" style="cursor:pointer">
								<h2 id="import_contacts_text" class="noselect">Contactos</h2>
								<br />
								<i id="import_contacts_icon" class="fa fa-users"></i>
							</div>
						</div>
					</div>
          
        </div>
        <div class="row">
          
					<div class="col-sm-6">
						<div class="card text-white widget-visitor-card" style="background-color:tomato" >
							<div class="card-block-small text-center" id="import_jobs_btn" style="cursor:pointer">
								<h2 id="import_jobs_text" class="noselect">Vacantes</h2>
								<br />
								<i id="import_jobs_icon" class="fa fa-briefcase"></i>
							</div>
						</div>
					</div>
				
				
					<div class="col-sm-6">
						<div class="card text-white widget-visitor-card" style="max-height:143px; cursor:pointer; background-color:slateblue;">
							<div class="card-block-small text-center" id="import_sectors_btn">
								<h2 id="import_sectors_text" class="noselect">Sectores</h2>
								<br />
								<i id="import_sectors_icon" class="fa fa-bars"></i>
							</div>
						</div>
					</div>
          
        </div>
        <div class="row">
          
					<div class="col-sm-6">
						<div class="card text-white widget-visitor-card" style="cursor:pointer; background-color:firebrick;">
							<div class="card-block-small text-center" id="import_skills_btn">
								<h2 id="import_skills_text" class="noselect">Habilidades</h2>
								<br />
								<i id="import_skills_icon" class="fa fa-tag"></i>
							</div>
						</div>
					</div>
          
					<div class="col-sm-6">
						<div class="card text-white widget-visitor-card" style="background-color:darkcyan" >
							<div class="card-block-small text-center" id="import_competences_btn" style="cursor:pointer">
								<h2 id="import_competences_text" class="noselect">Competencias</h2>
								<br />
								<i id="import_competences_icon" class="fa fa-star"></i>
							</div>
						</div>
					</div>
          
        </div>
        <div class="row">
          
          <div class="col-sm-6">
						<div class="card bg-c-yellow text-white widget-visitor-card" style="cursor:pointer;">
							<div class="card-block-small text-center" id="import_medals_btn">
								<h2 id="import_medals_text" class="noselect">Medallas</h2>
								<br />
								<i id="import_medals_icon" class="fa fa-trophy"></i>
							</div>
						</div>
					</div>
          
          <div class="col-sm-6">
						<div class="card text-white widget-visitor-card" style="cursor:pointer; background-color:cornflowerblue;">
							<div class="card-block-small text-center" id="import_connections_btn">
								<h2 id="import_connections_text" class="noselect">Conexiones</h2>
								<br />
								<i id="import_connections_icon" class="fab fa-connectdevelop"></i>
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
				case 'companies':
					actual_importation="Empresas";
					break;
				case 'contacts':
					actual_importation="Contactos";
					break;
				case 'jobs':
					actual_importation="Vacantes";
					break;
				case 'sectors':
					actual_importation="Sectores";
					break;
				case 'skills':
					actual_importation="Habilidades";
					break;
				case 'competences':
					actual_importation="Competencias";
					break;
        case 'medals':
					actual_importation="Medallas";
					break;
        case 'connections':
					actual_importation="Conexiones";
					break;
			}
		}
		var instructions_for=[];

		instructions_for['Empresas']=' <div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/students.png')}}" class="img-fluid p-b-10 rounded"></div></div><div class="row"> <div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado sin realizar revisiones previas.</strong></p> <div class="col-sm-12 col-xl-6"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_empresa</li> <li style="margin-left: 20px;"><strong> - </strong>RFC</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>Telefono</li> <li style="margin-left: 20px;"><strong> - </strong>CP</li> <li style="margin-left: 20px;"><strong> - </strong>Colonia</li> <li style="margin-left: 20px;"><strong> - </strong>Calle</li> <li style="margin-left: 20px;"><strong> - </strong>Horario</li> <li style="margin-left: 20px;"><strong> - </strong>Descripcion</li> </ul> <br /> <p><strong>ID_empresa:</strong> es el identificador de cada empresa con respecto a otras empresas.</p> <p><strong>RFC:</strong> es el Registro Federal de Contribuyentes que requiere toda persona física o moral en México para realizar cualquier actividad económica lícita.</p> <p><strong>Nombre:</strong> es el nombre de la empresa.</p> </div> <div class="col-sm-12 col-xl-6"> <p><strong>Telefono:</strong> contiene el numero telefonico de la empresa.</p> <p><strong>CP:</strong> es el codigo postal de la empresa.</p> <p><strong>Colonia:</strong> es el nombre de la colonia donde esta ubicada la empresa.</p> <p><strong>Calle:</strong> es el nombre de la calle donde esta ubicada la empresa.</p> <p><strong>Horario:</strong> es el horario de atencion que posee la empresa.</p> <p><strong>Descripcion:</strong> es una descripcion sobre la empresa.</p> </div> </div> </div> <div class="row" style="margin-left:20px"> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/students.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo csv de ejemplo</a></h6> </div> ';
		instructions_for['Contactos']='<div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/tutors.png')}}" class="img-fluid p-b-10 rounded"></div></div> <div class="row"><div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo requiere de la importación de empresas.</strong></p> <div class="col-sm-12 col-xl-6"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_contacto</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>APaterno</li> <li style="margin-left: 20px;"><strong> - </strong>AMaterno</li> <li style="margin-left: 20px;"><strong> - </strong>Email</li> <li style="margin-left: 20px;"><strong> - </strong>Telefono</li> <li style="margin-left: 20px;"><strong> - </strong>Cargo</li> <li style="margin-left: 20px;"><strong> - </strong>ID_empresa</li> <li style="margin-left: 20px;"><strong> - </strong>Horario</li> </ul> <br /> <p><strong>ID_contacto:</strong> es el identificador de cada contacto con respecto a otros contactos.</p> <p><strong>Nombre:</strong> es el nombre o nombres del contacto.</p> <p><strong>APaterno:</strong> contiene el apellido paterno de los contactos a importar.</p> </div> <div class="col-sm-12 col-xl-6"> +<p><strong>AMaterno:</strong> es el apellido materno de los contactos, en caso de no tener, simplemente dejarlo vacío.</p> <p><strong>Email:</strong> es el correo electronico de los contactos.</p> <p><strong>Telefono:</strong> es el numero telefonico de los contactos.</p> <p><strong>Cargo:</strong> es el cargo o posicion que tiene el contacto en la empresa.</p> <p><strong>ID_empresa:</strong> es una clave foránea a la tabla de empresas, es decir, a la que pertenece el contacto.</p> <p><strong>Horario:</strong> es el horario de atencion que posee el contacto.</p></div> </div> <div class="row" style="margin-left: 20px;"> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/tutors.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo .csv de ejemplo</a></h6></div></div>';
		instructions_for['Vacantes']='<div class="form-group row" style="margin-left:20px; margin-right:20px;"> <br> <div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/careers.png')}}" class="img-fluid p-b-10 rounded"></div></div> <div class="row"> <div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo requiere de la importacion sectores, empresas y contactos.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_vacante</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>Descripcion</li><li style="margin-left: 20px;"><strong> - </strong>Salario</li> <li style="margin-left: 20px;"><strong> - </strong>Tipo_vacante</li><li style="margin-left: 20px;"><strong> - </strong>CP</li> <li style="margin-left: 20px;"><strong> - </strong>Colonia</li> <li style="margin-left: 20px;"><strong> - </strong>Calle</li> <li style="margin-left: 20px;"><strong> - </strong>ID_sector</li> <li style="margin-left: 20px;"><strong> - </strong>ID_empresa</li> <li style="margin-left: 20px;"><strong> - </strong>ID_contacto</li> </ul> <br /> <p><strong>ID_vacante</strong> es el identificador de cada vacante.</p> <p><strong>Nombre</strong> es el nombre de cada vacante de la institución.</p> <p><strong>Descripcion</strong> es una descripcion de la vacante.</p> <p><strong>Salario</strong> es el salario mensual que ofrece la vacante, en caso de no desear mostrarlo, dejar el espacio en blanco.</p> <p><strong>Tipo_vacante</strong> es el tipo de vacante.</p> <p><strong>CP</strong> es el codigo postal donde se trabajará de acuerdo a la vacante.</p> <p><strong>Colonia</strong> es la colonia donde se trabajará de acuerdo a la vacante.</p> <p><strong>Calle</strong> es la calle donde se trabajará de acuerdo a la vacante.</p> <p><strong>ID_sector</strong> es una clave foranea a la tabla sectores, indica a que sector pertecene la vacante.</p> <p><strong>ID_empresa</strong> es una clave foranea a la tabla empresas, indica a que empresa pertecene la vacante.</p> <p><strong>ID_sector</strong> es una clave foranea a la tabla contactos, indica con que contacto se debe tener comunicación.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/careers.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo csv de ejemplo</a></h6></div> </div> </div> <br> </div>';
    instructions_for['Sectores']=' <div class="row"> <div class="col-sm-12 col-xl-6"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_sector</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>Descripcion</li></ul> <br /> <p><strong>ID_sector</strong> es el identificador de cada sector a importar en el sistema.</p> <p><strong>Nombre</strong> es el nombre de cada sector.</p><p><strong>Descripcion</strong> es una descripcion de cada sector.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/classes.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo .csv de ejemplo</a></h6> </div> </div> <div class="col-sm-12 col-xl-6"> <img src="{{asset('import_help/images/classes.png')}}" alt="CSV" class="img-fluid p-b-10 rounded"> </div> </div>';
		instructions_for['Habilidades']=' <div class="row"> <div class="col-sm-12 col-xl-6"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_habilidad</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li></ul> <br /> <p><strong>ID_habilidad</strong> es el identificador de cada habilidad a importar en el sistema.</p> <p><strong>Nombre</strong> es el nombre de cada habilidad.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/classes.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo .csv de ejemplo</a></h6> </div> </div> <div class="col-sm-12 col-xl-6"> <img src="{{asset('import_help/images/classes.png')}}" alt="CSV" class="img-fluid p-b-10 rounded"> </div> </div>';
		instructions_for['Competencias']=' <div class="row"> <div class="col-sm-12 col-xl-6"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_competencia</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li></ul> <br /> <p><strong>ID_competencia</strong> es el identificador de cada competences a importar en el sistema.</p> <p><strong>Nombre</strong> es el nombre de cada competencia.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/classes.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo .csv de ejemplo</a></h6> </div> </div> <div class="col-sm-12 col-xl-6"> <img src="{{asset('import_help/images/classes.png')}}" alt="CSV" class="img-fluid p-b-10 rounded"> </div> </div>';
    instructions_for['Medallas']=' <div class="row"> <div class="col-sm-12 col-xl-6"> <p><strong>NOTA: Este módulo no depende de otros, por lo tanto, puede ser importado.</strong></p> <div class="form-group"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_medalla</li> <li style="margin-left: 20px;"><strong> - </strong>Nombre</li> <li style="margin-left: 20px;"><strong> - </strong>Descripcion</li></ul> <br /> <p><strong>ID_medalla</strong> es el identificador de cada medalla a importar en el sistema.</p> <p><strong>Nombre</strong> es el nombre de cada medalla.</p><p><strong>Descripcion</strong> es una descripcion de cada medalla.</p> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/classes.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo .csv de ejemplo</a></h6> </div> </div> <div class="col-sm-12 col-xl-6"> <img src="{{asset('import_help/images/classes.png')}}" alt="CSV" class="img-fluid p-b-10 rounded"> </div> </div>';
    instructions_for['Conexiones']=' <div class="row"><div class="col-sm-12 col-xl-12"><img src="{{asset('import_help/images/users.png')}}" class="img-fluid p-b-10 rounded"></div></div> <div class="row"> <div class="col-sm-12 col-xl-12"> <p><strong>NOTA: Este módulo requiere de la importación de empresas.</strong></p> <div class="col-sm-12 col-xl-6"> <p>Se necesita un archivo CSV, que contenga las siguientes columnas:</p> <ul> <li style="margin-left: 20px;"><strong> - </strong>ID_conexion</li> <li style="margin-left: 20px;"><strong> - </strong>ID_alumno</li> <li style="margin-left: 20px;"><strong> - </strong>ID_empresa</li> </ul> <br /> <p><strong>ID_conexion:</strong> es el identificador de cada conexion.</p> <p><strong>ID_alumno:</strong> es el identificador de cada alumno de la institución.</p> <p><strong>ID_empresa:</strong> es una clave foranea a la tabla empresas.</p> </div> </div> </div> <div class="row" style="margin-left:20px"> <br /><h6 class="m-b-30"><a target="_blank" href="{{asset('import_help/csv/users.csv') }}" ><i style="color:#3366BB" style="font-size:1px" class="fas fa-external-link-alt"></i>Descargar archivo csv de ejemplo</a></h6> </div>';

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
					case 'import_companies_btn':
					case 'import_companies_text':
					case 'import_companies_icon':
						actual_importation="Empresas";
						$("#actual_importation").val("Empresas");
						second_tab();
						break;
					case 'import_contacts_btn':
					case 'import_contacts_text':
					case 'import_contacts_icon':
						actual_importation="Contactos";
						$("#actual_importation").val("Contactos");
						second_tab();
						break;
					case 'import_jobs_btn':
					case 'import_jobs_text':
					case 'import_jobs_icon':
						actual_importation="Vacantes";
						$("#actual_importation").val("Vacantes");
						second_tab();
						break;
					case 'import_sectors_btn':
					case 'import_sectors_text':
					case 'import_sectors_icon':
						actual_importation="Sectores";
						$("#actual_importation").val("Sectores");
						second_tab();
						break;
					case 'import_skills_btn':
					case 'import_skills_text':
					case 'import_skills_icon':
						actual_importation="Habilidades";
						$("#actual_importation").val("Habilidades");
						second_tab();
						break;
					case 'import_competences_btn':
					case 'import_competences_text':
					case 'import_competences_icon':
						actual_importation="Competencias";
						$("#actual_importation").val("Competencias");
						second_tab();
						break;
          case 'import_medals_btn':
					case 'import_medals_text':
					case 'import_medals_icon':
						actual_importation="Medallas";
						$("#actual_importation").val("Medallas");
						second_tab();
						break;
          case 'import_connections_btn':
					case 'import_connections_text':
					case 'import_connections_icon':
						actual_importation="Conexiones";
						$("#actual_importation").val("Conexiones");
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
						case 'Empresas':
							$("#importation_type").val('import_companies');
							$("#table").val('companies');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Contactos':
							$("#importation_type").val('import_contacts');
							$("#table").val('contacts');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Vacantes':
							$("#importation_type").val('import_jobs');
							$("#table").val('jobs');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Sectores':
							$("#importation_type").val('import_sectors');
							$("#table").val('sectors');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Habilidades':
							$("#importation_type").val('import_skills');
							$("#table").val('skills');
							$("#second_table").val('');
							$("#form").submit();
							break;
						case 'Competencias':
							$("#importation_type").val('import_competences');
							$("#table").val('competences');
							$("#second_table").val('');
							$("#form").submit();
							break;
            case 'Medallas':
							$("#importation_type").val('import_medals');
							$("#table").val('medals');
							$("#second_table").val('');
							$("#form").submit();
							break;
            case 'Conexiones':
							$("#importation_type").val('import_connections');
							$("#table").val('connections_companies');
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
