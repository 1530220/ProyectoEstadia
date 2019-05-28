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
						<h4 style="text-transform: none;">Graficas de Información de Tutorías y Asesorías</h4>
						<span style="text-transform: none;">Ver mediante graficas el comportamiento de la información generada en el sistema.</span>
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
						<li class="breadcrumb-item">Graficas de Tutorías y Asesorías
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
							<div class="col-md-5">
								<h6 class="sub-title">Tipo de Reporte</h6>
								<div class="form-group row" style="margin-left:5px; margin-right:5px;">
									<label class="col-sm-4 col-form-label" for="tutor_user_id">Tipo reporte:</label>
									<div class="col-sm-8">
										<select id="report_of" name="report_of" class="select2_basic">
											<option value=1>Asesorías</option>
											<option value=2>Tutorías</option>
										</select>
									</div>
								</div>
								<div class="form-group row" style="margin-left:5px; margin-right:5px;">
									<label class="col-sm-4 col-form-label" for="tutor_user_id">Filtrado por:</label>
									<div class="col-sm-8">
										<select id="report_type" name="report_type" class="select2_basic">

										</select>
									</div>
								</div>
								<h6 class="sub-title">Opciones de filtrado</h6>
								<p>Rango de Fecha: </p>
								<div class="input-daterange input-group" id="datepicker">
									<span class="input-group-addon" id="del_btn" style="background-color:gray">Del</span>
									<input type="text" autocomplete="off" style="font-size:12px; height: 46px;" class="input-sm form-control" id="start" name="start" />
									<span class="input-group-addon" id="al_btn" style="background-color:gray">al</span>
									<input type="text" autocomplete="off" style="font-size:12px; height: 46px;" class="input-sm form-control" id="end" name="end" />
									<span class="input-group-addon" id="reset_btn" title="Borrar fechas seleccionadas" style="background-color:#c34242">x</span>
								</div>
							</div>
							<div class="col-md-7">
								<h6 class="sub-title" id="report_title"></h6>
								<div id="asesorias_upv"></div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('javascriptcode')
<script src="{{ asset('bower_components/raphael/js/raphael.min.js') }}"></script>
<script src="{{ asset('bower_components/morris.js/js/morris.js') }}"></script>
<script>
	$(document).ready(function() {
		function updateData(t_type=0) {
			switch(t_type){
				case "1":
					if($("#report_of").val()=="2")
						$("#report_title").text('Gráfica de realización de tutorías por carrera');
					else
						$("#report_title").text('Gráfica de realización de asesorías por carrera');
					break;
				case "2":
					if($("#report_of").val()=="2")
						$("#report_title").text('Gráfica de tutorías por tipo de problema');
					else
						$("#report_title").text('Gráfica de asesorías por temas');
					break;
				case "3":
					if($("#report_of").val()=="2")
						$("#report_title").text('Gráfica de tutorías por tipo de canalización');
					else
						$("#report_title").text('Gráfica de asesorías por materias');
					break
				default:
					$("#report_title").text('Seleccione una opción para mostrar su gráfica');
			}
			var result=[];

			if(t_type!=0){
				//Se prepara la solicitud agregando a la cabecera el token csrf
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					}
				});

				//Se realiza la peticion y se manda en data, los valores requeridos
				//por la funcion
				$.ajax({
					url: '{{ route('reports.get_value_for_chart') }}',
					method: 'post',
					data: {
						type: t_type,
						report_of: $("#report_of").val(),
						start: $("#start").val(),
						end: $("#end").val(),
					},
					success: function(result) {
						var result = result['response'];
						G.setData(result);
					}
				});
			}else{
				var result = [
					{y:'', a:0}
				];
				G.setData(result);
			}



		}

		var G = Morris.Bar({
			element: 'asesorias_upv',
			redraw: true,
			data: [
				{ y: '', a: 0 }
			],
			xkey: 'y',
			xLabelAngle: 90,
			ykeys: ['a'],
			labels: ['Cant']
		});

		$("#report_type").change(function() {
			updateData($("#report_type").val());
		});



		$("#report_of").change(function() {
			updateSelect();
		});

		$(window).on('resize',function() {
		   G.redraw();
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
			updateData($("#report_type").val());
		});

		$("#start").change(function(){
			date=getDateA($("#start").val());
			start_date=new Date(date[0],date[1],date[2]);
			if(start_date>end_date && end_date!=null){
				$("#start").val("");
				start_date=null;
			}else{
				updateData($("#report_type").val());
			}
		});

		$("#end").change(function(){
			date=getDateA($("#end").val());
			end_date=new Date(date[0],date[1],date[2]);
			if(end_date<start_date && start_date!=null){
				$("#end").val("");
				end_date=null;
			}else{
				updateData($("#report_type").val());
			}
		});

		function updateSelect(){
			$("#report_type").empty();
			if($("#report_of").val()=="1"){
				$("#report_type").append(new Option('Por Tema',2));
				$("#report_type").append(new Option('Por Carreras',1));
				$("#report_type").append(new Option('Por Materias',3));
			}else{
				$("#report_type").append(new Option('Por Tipo de Canalización',3));
				$("#report_type").append(new Option('Por Carreras',1));
				$("#report_type").append(new Option('Por Problemas',2));
			}

			updateData($("#report_type").val());
		}

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

		updateData($("#report_type").val());
		updateSelect();
	});
</script>
@endsection
