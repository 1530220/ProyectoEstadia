@extends('layouts.app')

@section('title',"SIITA - Reportes de Tutorías")

@switch(Auth::user()->type)
	@case(1)
		@section('body')
		@break
	@case(2)
		@section('bodyUsuario')
		@break
	@case(3)
		@section('bodyStudent')
		@break
	@case(4)
		@section('bodyTeacher')
		@break
	@case(5)
		@section('bodyTutor')
		@break
	@case(6)
		@section('bodyUserSalud')
		@break
	@case(7)
		@section('bodyUserPsicologia')
		@break
@endswitch
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-download" style="background-color:gray;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Reportes de Tutorías</h4>
						<span style="text-transform: none;">Realizar reportes mediante filtros.</span>
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
						<li class="breadcrumb-item">Reportes de Tutorías
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
						<h4 class="sub-title"><i class="icofont icofont-filter"></i> Filtros</h4>
							<div class="row">
								<div class="col-sm-12 col-xl-4">
									<p>Profesor: </p>

									@if (Auth::user()->type == 4 || Auth::user()->type == 5)
											@foreach ($teachers as $teacher)
												<input type="hidden" name="professor_id" value="{{ $teacher->id }}" />
												<li value="{{ $teacher->id }}" id="professor_id" class="list-group-item">{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</li>
											@endforeach
										@else
											<select id="professor_id" name="professor_id" class="select2_basic" title="Seleccione un profesor">
												<option value="">Todos</option>
												@foreach ($teachers as $teacher)
													<option value="{{ $teacher->id }}" {{ (old("professor_id") == $teacher->id ? "selected":"") }}>{{ $teacher->title }} {{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->second_last_name }}</option>
												@endforeach
											</select>
									@endif

								</div>
								<div class="col-sm-12 col-xl-4">
									<p>Alumno: </p>
									<select id="student_id" name="student_id" class="select2_basic" title="Selecciones un alumno">
										<option value="">Todos</option>
										@foreach ($students as $student)
											<option value="{{ $student->id }}" {{ (old("student_id") == $student->id ? "selected":"") }}>{{ $student->first_name }} {{ $student->last_name }} {{ $student->second_last_name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 col-xl-4">
									<p>Situación Académica: </p>
									<select id="academic_situation" name="academic_situation" class="select2_basic" title="Seleccione la situación académica">
										<option value="-1" selected>Todos</option>
										<option value="{{ 0 }}" {{ (old("academic_situation") == 0 ? "selected":"") }}>Regular</option>
										<option value="{{ 1 }}" {{ (old("academic_situation") == 1 ? "selected":"") }}>Especial</option>
									</select>
								</div>
							</div>

							<br />

							<div class="row">
								<div class="col-sm-12 col-xl-4">
									<p>Tipo de Canalización: </p>
									<select id="attention" name="attention" class="select2_basic" title="Seleccione el tipo de canalización">
										<option value="">Todos</option>
										@foreach ($types_of_attentions as $attention)
											<option value="{{ $attention->id }}" {{ (old("attention") == $attention->id ? "selected":"") }}>{{ $attention->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 col-xl-4">
									<p>Tipo de Problema: </p>
									<select id="problem" name="problem" class="select2_basic" title="Seleccione el tipo de problema">
										<option value="">Todos</option>
										@foreach ($attention_problems as $attention)
											<option value="{{ $attention->id }}" {{ (old("problem") == $attention->id ? "selected":"") }}>{{ $attention->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 col-xl-4">
									<p>Tipo de Tutoría: </p>
									<select id="tutoria_type" name="tutoria_type" class="select2_basic" title="Seleccione el tipo de tutoría">
										<option value="">Todos</option>
										<option value="{{ 1 }}" {{ (old("tutoria_type") == 1 ? "selected":"") }}>Individual</option>
										<option value="{{ 2 }}" {{ (old("tutoria_type") == 2 ? "selected":"") }}>Grupal</option>
									</select>
								</div>
							</div>

							<br />

							<div class="row">
								<div class="col-sm-12 col-xl-2">
									<p>Estado de Tutoría: </p>
									<select id="tutoria_state" name="tutoria_state" class="select2_basic" title="Selecciones el estado de la tutoría">
										<option value="-1" selected>Todos</option>
										<option value="{{ 0 }}" {{ (old("tutoria_state") == 0 ? "selected":"") }}>Sin terminar</option>
										<option value="{{ 1 }}" {{ (old("tutoria_state") == 1 ? "selected":"") }}>Terminada sin Confirmación</option>
										<option value="{{ 2 }}" {{ (old("tutoria_state") == 2 ? "selected":"") }}>Confirmada</option>
									</select>
								</div>
								<div class="col-sm-12 col-xl-6">
									<p>Rango de Fecha: </p>
									<div class="input-daterange input-group" id="datepicker">
										<span class="input-group-addon" id="del_btn" style="background-color:gray">Del</span>
										<input type="text" autocomplete="off" style="height: 46px;" class="input-sm form-control" id="start" name="start" />
										<span class="input-group-addon" id="al_btn" style="background-color:gray">al</span>
										<input type="text" autocomplete="off" style="height: 46px;" class="input-sm form-control" id="end" name="end" />
										<span class="input-group-addon" id="reset_btn" title="Borrar fechas seleccionadas" style="background-color:#c34242">x</span>
									</div>
								</div>
								<div class="col-sm-12 col-xl-2">
									<p>Carrera: </p>
									<select id="career_id" name="career_id" class="select2_basic" title="Selecciones una carrera">
										<option value="">Todos</option>
										@foreach ($careers as $career)
											<option value="{{ $career->id }}" {{ (old("career_id") == $career->id ? "selected":"") }}>{{ $career->abbreviation }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-sm-12 col-xl-2">
									<br /><br />
									<center>
										<button type="button" id="search_report" style="height: 46px; width: 100%;" class="btn btn-success"><i class="icofont icofont-filter"></i>Filtrar</button>
									</center>
								</div>
							</div>
							<br>
					</div>
				</div>
			</div>
			<div id="results_section" class="col-sm-12">
				<div class="card">
					<div class="card-block">
						<h4 class="sub-title"><i class="fas fa-list-ol"></i> Totales de Tutorias</h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="form-group row">
									<label class="col-sm-9 col-form-label" for="username">Num. de Tutorias Individuales:</label>
									<div class="col-sm-3">
										<strong>
											<p id="cant_t_individuales" style="font-size:30px; padding-top:3px">
												0
											</p>
										</strong>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group row">
									<label class="col-sm-9 col-form-label" for="username">Num. de Tutorias Grupales:</label>
									<div class="col-sm-3">
										<strong>
											<p id="cant_t_grupales" style="font-size:30px; padding-top:3px">
												0
											</p>
										</strong>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group row">
									<label class="col-sm-9 col-form-label" for="username">Total de Tutorias:</label>
									<div class="col-sm-3">
										<strong>
											<p id="cant_tutorias" style="font-size:30px; padding-top:3px">
												0
											</p>
										</strong>
									</div>
								</div>
							</div>
						</div>

						<h4 class="sub-title"><i class="icofont icofont-search"></i> Resultados</h4>

						<div class="dt-responsive table-responsive">
							<table style="width:100%;" id="datatable_reports" class="table table-striped table-bordered">
								@if ((!empty($asesorias)))
									<thead id="table_header">
										<tr>
											<th scope="col" style="width: 10%">ID</th>
											<th scope="col" style="width: 10%">Profesor</th>
											<th scope="col" style="width: 10%">Situación Académica</th>
											<th scope="col" style="width: 10%">Carrera</th>
											<th scope="col" style="width: 15%">Tipo de Canalizacion</th>
											<th scope="col" style="width: 15%">Tipo de Problema</th>
											<th scope="col" style="width: 10%">Tipo Tutoria</th>
											<th scope="col" style="width: 10%">Estado</th>
											<th scope="col" style="width: 10%">Fecha</th>
										</tr>
									</thead>
									<tbody></tbody>
								@endif
								<tfoot>
									<tr id="table_footer">
										<th style="padding-right: 1.5%" scope="col">ID</th>
										<th style="padding-right: 1.5%" scope="col">Profesor</th>
										<th style="padding-right: 1.5%" scope="col">Alumno</th>
										<th style="padding-right: 1.5%" scope="col">Situación Académica</th>
										<th style="padding-right: 1.5%" scope="col">Carrera</th>
										<th style="padding-right: 1.5%" scope="col">Tipo de Canalizacion</th>
										<th style="padding-right: 1.5%" scope="col">Tipo de Problema</th>
										<th style="padding-right: 1.5%" scope="col">Tipo Tutoria</th>
										<th style="padding-right: 1.5%" scope="col">Estado</th>
										<th style="padding-right: 1.5%" scope="col">Fecha</th>
									</tr>
								</tfoot>
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
	var dt_reports;
	var message = "";
	var subheader = "";
	var margin1;
	var margin2;
	var cant_tutorias_individuales = 0;
	var cant_tutorias_grupales = 0;
	var actual_text = "";
	var message2 = "";

	$(document).ready(function() {
		$("#tutoria_state").val('-1').change();
		$("#academic_situation").val('-1').change();

		var date = new Date();
		var month = "";
		switch ((date.getMonth()+1)) {
			case 1:
				month = "Enero";
				break;
			case 2:
				month = "Febrero";
				break;
			case 3:
				month = "Marzo";
				break;
			case 4:
				month = "Abril";
				break;
			case 5:
				month = "Mayo";
				break;
			case 6:
				month = "Junio";
				break;
			case 7:
				month = "Julio";
				break;
			case 8:
				month = "Agosto";
				break;
			case 9:
				month = "Septiembre";
				break;
			case 10:
				month = "Octubre";
				break;
			case 11:
				month = "Noviembre";
				break;
			case 12:
				month = "Diciembre";
				break;
			default:

		}
		var jsFileNameDate = 'Bitácora_Tutorías_'+date.getDate()+'_'+month+'_'+date.getFullYear();
		jsFileNameDate.toString()

		dt_reports = $('#datatable_reports').DataTable({
			columns: [
				{title: "ID"},
				{title: "Profesor"},
				{title: "Alumno"},
				{title: "Situación Académica"},
				{title: "Carrera"},
				{title: "Tipo de Canalizacion"},
				{title: "Tipo de Problema"},
				{title: "Tipo Tutoria"},
				{title: "Estado"},
				{title: "Fecha"},
			],
			responsive: true,
			dom: 'Bfrtip',
			"buttons": [ //'copy', 'csv', 'excel', 'pdf', 'print',
							{
								text: 'Exportar PDF',
								extend: 'pdfHtml5',
								filename: jsFileNameDate,
								orientation: 'landscape',
								pageSize: 'A4',
								exportOptions: {
									search: 'applied',
									order: 'applied'
								},
								customize: function (doc) {

									doc.content.splice(0,1);

									var now = new Date();
									var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();

									var tam_logo = 'data:image/png;base64,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';

									var logo = 'data:image/png;base64,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';

									doc.pageMargins = [20,60,20,30];
									doc.defaultStyle.fontSize = 11;
									doc.styles.tableHeader.fontSize = 10;

									doc['header']=(function() {

										if ((now.getMonth()+1) == 1 || (now.getMonth()+1) == 2 || (now.getMonth()+1) == 3 || (now.getMonth()+1) == 4) {
											periodo = "Periodo: Enero - Abril " + now.getFullYear();
											periodo = periodo.toString();
										} else if((now.getMonth()+1) == 5 || (now.getMonth()+1) == 6 || (now.getMonth()+1) == 7 || (now.getMonth()+1) == 8){
											periodo = "Periodo: Mayo - Agosto " + now.getFullYear();
											periodo = periodo.toString();
										} else if((now.getMonth()+1) == 9 || (now.getMonth()+1) == 10 || (now.getMonth()+1) == 11 || (now.getMonth()+1) == 12){
											periodo = "Periodo: Septiembre - Diciembre " + now.getFullYear();
											periodo = periodo.toString();
										}

										if ($("#start").val()!= '' && $("#end").val()!= '') {
											if (actual_text == "Todos") {
												message2 = "";
											} else {
												message2 = "Tutor: " + actual_text;
											}
											message = "Del " + $("#start").val() + " al " + $("#end").val();
											message = message.toString();
											subheader = " - Concentrado Mensual de Tutorías";
											margin1 = 5;
											margin2 = 10;
										} else if ($("#start").val()== '' || $("#end").val()== ''){
											if (actual_text == "Todos") {
												message = "Universidad Politécnica de Victoria";
												message2 = "";
											} else {
												message = "Universidad Politécnica de Victoria";
												message2 = "Tutor: " + actual_text;

											}
											subheader = "";
											margin1 = 5;
											margin2 = 10;
										}

										return {
											columns: [
												{
			                                        image: tam_logo,
			                                        width: 75,
			                                        height: 29
			                                    },
												{
													alignment: 'left',
													italics: false,
													stack: ['BITÁCORA DE ASISTENCIA A TUTORÍAS'+subheader,
														{text: message2, style: 'subheader', bold: true, fontSize: 11}
													],
													style: 'header',
													fontSize: 10,
													width: 400,
													margin: [margin1,margin2]
												},
												{
													alignment: 'right',
													fontSize: 10,
													margin: [5,10],
													stack: [{text: periodo, style: 'subheader'},
														{text: message, bold: true, fontSize: 11}
													],
													style: 'header',
												},
												{
													image: logo,
													width: 75,
													height: 35
												},
											],
											margin: 25
										}
									});
									doc['footer']=(function(page, pages) {
										return {
											columns: [
												{
													alignment: 'left',
													text: ['Creado: ', { text: jsDate.toString() }],
													margin: [30,20]
												},
												{
													alignment: 'right',
													text: ['Tutorías Individuales: ' + cant_tutorias_individuales],
													margin: [20,20]
												},
												{
													alignment: 'right',
													text: ['Tutorías Grupales: ' + cant_tutorias_grupales],
													margin: [20,20]
												},
												{
													alignment: 'right',
													text: ['Total de Tutorías: ' + (cant_tutorias_grupales+cant_tutorias_individuales)],
													margin: [20,20]
												},
												{
													alignment: 'right',
													text: ['Página ', { text: page.toString() },	' de ',	{ text: pages.toString() }],
													margin: [30,20]
												}
											],
											margin: -20
										}
									});
									var objLayout = {};
									objLayout['hLineWidth'] = function(i) { return .5; };
									objLayout['vLineWidth'] = function(i) { return .5; };
									objLayout['hLineColor'] = function(i) { return '#000'; };
									objLayout['vLineColor'] = function(i) { return '#000'; };
									objLayout['paddingLeft'] = function(i) { return 4; };
									objLayout['paddingRight'] = function(i) { return 4; };
									doc.content[0].layout = objLayout;
							}
						}
					]
		});
	});

	var start_date = null;
	var end_date = null;

	$("#del_btn").click(function(){
		$("#start").focus();
	});

	$("#al_btn").click(function(){
		$("#end").focus();
	});

	$("#reset_btn").click(function(){
		$("#start").val("");
		$("#end").val("");
		start_date=null;
		end_date=null;
	});

	$("#start").change(function(){
		date=getDateA($("#start").val());
		start_date=new Date(date[0],date[1],date[2]);
		if(start_date>end_date && end_date!=null){
			$("#start").val("");
			start_date=null;
		}
	});

	$("#end").change(function(){
		date=getDateA($("#end").val());
		end_date=new Date(date[0],date[1],date[2]);
		if(end_date<start_date && start_date!=null){
			$("#end").val("");
			end_date=null;
		}
	});

	function getDateA(date_string){
		date_string=date_string.split(" ");

		var day=date_string[0];
		var month=date_string[1];
		var year=date_string[2];

		switch(month){
			case "Enero":
				month="1";
				break;
			case "Febrero":
				month="2";
				break;
			case "Marzo":
				month="3";
				break;
			case "Abril":
				month="4";
				break;
			case "Mayo":
				month="5";
				break;
			case "Junio":
				month="6";
				break;
			case "Julio":
				month="7";
				break;
			case "Agosto":
				month="8";
				break;
			case "Septiembre":
				month="9";
				break;
			case "Octubre":
				month="10";
				break;
			case "Noviembre":
				month="11";
				break;
			case "Diciembre":
				month="12";
				break;
		}
		var date=[];
		date[0]=Number(year);
		date[1]=Number(month);
		date[2]=Number(day);

		return date;
	}

	$("#search_report").click(function() {
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		$('html, body').animate({
		  	scrollTop: $("#results_section").offset().top-100
	  	}, 1500);
		fillDataTable(1);
	});


	$("#professor_id").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});


	$("#student_id").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	$("#academic_situation").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	$("#attention").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	$("#career_id").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	$("#problem").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
			@endif
		fillDataTable();
	});

	$("#tutoria_type").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	$("#tutoria_state").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	$("#start").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	$("#end").change(function(){
		@if (Auth::user()->type != 4 && Auth::user()->type != 5)
			actual_text = $("#professor_id").select2('data')[0]['text'];
		@else
			actual_text = $("#professor_id").text();
		@endif
		fillDataTable();
	});

	function fillDataTable(is_click=0){

		$("#cant_t_individuales").text("0");
		$("#cant_t_grupales").text("0");
		$("#cant_tutorias").text("0");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			}
		});

		//Se realiza la peticion y se manda en data, los valores requeridos
		//por la funcion
		$.ajax({
			url: '{{ route('reports.get_tutoria_report') }}',
			method: 'POST',
			data: {
				professor_id: $("#professor_id").val(),
				student_id: $("#student_id").val(),
				academic_situation: $("#academic_situation").val(),
				attention: $("#attention").val(),
				career_id: $("#career_id").val(),
				problem: $("#problem").val(),
				tutoria_type: $("#tutoria_type").val(),
				tutoria_state: $("#tutoria_state").val(),
				start: $("#start").val(),
				end: $("#end").val(),
			},

			success: function(result) {

				var tutoria = result['response'];

				if (tutoria.length === 0) {
					if(is_click==1){
						swal({
						  title: "¡Atención!",
						  text: "No se encontraron registros con los filtros seleccionados",
						  icon: "error",
							button: false,
							timer: 3000,
						});
					}
					dt_reports.clear().draw();
				} else {
					dt_reports.clear().draw();
					cant_tutorias_individuales=0;
					cant_tutorias_grupales=0;
					for (var i = 0; i < tutoria.length; i++) {

						switch(tutoria[i]["type_of_tutoria"]){
							case 0:
								tutoria[i]["type_of_tutoria"]="Sin Asignar";
								break;
							case 1:
								tutoria[i]["type_of_tutoria"]="Individual";
								cant_tutorias_individuales=cant_tutorias_individuales+1;
								break;
							case 2:
								tutoria[i]["type_of_tutoria"]="Grupal";
								cant_tutorias_grupales=cant_tutorias_grupales+1;
								break;
						}

						switch(tutoria[i]["academic_situation"]){
							case 0:
								tutoria[i]["academic_situation"]="Regular";
								break;
							case 1:
								tutoria[i]["academic_situation"]="Especial";
								break;
							case -1:
								tutoria[i]["academic_situation"]="Sin Asignar";
								break;
						}

						switch(tutoria[i]["state"]){
							case 0:
								tutoria[i]["state"]="Sin Realizar";
								break;
							case 1:
								tutoria[i]["state"]="Terminada sin Confirmación";
								break;
							case 2:
								tutoria[i]["state"]="Confirmada";
								break;
						}

						if (tutoria[i]["teacherTitle"] != null) {
							tutoria[i]["teacherTitle"] = tutoria[i]["teacherTitle"];
						} else if (tutoria[i]["teacherTitle"] == null) {
							tutoria[i]["teacherTitle"] = "";
						}

						console.log(tutoria[i]);
						dt_reports.row.add([
							tutoria[i]["id_tutoria"],
							tutoria[i]["teacherTitle"]+" "+tutoria[i]["teacher_first_name"]+" "+tutoria[i]["teacher_last_name"]+" "+tutoria[i]["teacher_second_last_name"],
							tutoria[i]["university_id"]+" - "+tutoria[i]["student_first_name"]+" "+tutoria[i]["student_last_name"]+" "+tutoria[i]["student_second_last_name"],
							tutoria[i]["academic_situation"],
							tutoria[i]["careerName"],
							tutoria[i]["canalization_name"],
							tutoria[i]["attention_name"],
							tutoria[i]["type_of_tutoria"],
							tutoria[i]["state"],
							tutoria[i]["date_attention"]
						]).draw();
					}
					$("#cant_t_individuales").text(cant_tutorias_individuales);
					$("#cant_t_grupales").text(cant_tutorias_grupales);
					$("#cant_tutorias").text(cant_tutorias_grupales+cant_tutorias_individuales);

				}
			}
		});
	}
</script>
@endsection
