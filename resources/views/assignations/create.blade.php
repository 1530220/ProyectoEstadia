@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Alumno")

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


<!-- Page-header start -->
<div class="page-header card">
	<div class="row align-items-end">
		<div class="col-lg-8">
			<div class="page-header-title">
				<i class="fas fa-link" style="background-color:#5e1287"></i>
				<div class="d-inline">
					<h4 style="text-transform: none;">Asignación de Tutor</h4>
					<span style="text-transform: none;">Asignar un tutor a los estudiantes que no tengan un tutor asignado.</span>
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
					<li class="breadcrumb-item"><a href="{{ route('assignations.list') }}">Tutorados</a>
					</li>
					<li class="breadcrumb-item">Asignación de Tutor
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
					{{--@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif--}}

					<form id="form" method="POST" action="{{ route('assignations.store') }}" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" id="academic_situation" name="academic_situation" value="" />
						<div id="bump" class="form-group row">
							<label class="col-sm-2 col-form-label" for="tutor">Tutor Académico:</label>
							<div class="col-sm-10">
								<select name="tutor" id="tutor" class="select2_basic" title="Tutor académico">
									@foreach ($tutors as $tutor)
										<option value="{{ $tutor->id }}" {{ (old("tutor") == $tutor->id ? "selected":"") }}>{{ $tutor->title }} {{ $tutor->first_name }} {{ $tutor->last_name }} {{ $tutor->second_last_name }}</option>
									@endforeach
								</select>
								@if ($errors->has('tutor'))
									<div class="col-form-label" style="color:red;">{{$errors->first('tutor')}}</div>
								@endif
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for="student">Tutorado(s):</label>
							<div class="col-sm-10">
								<select class="students_sel" name="students_sel[]" multiple="multiple" id="students_sel" title="Alumno seleccionado">
								</select>
								@if ($errors->has('students_sel'))
									<div class="col-form-label" style="color:red;">{{$errors->first('students_sel')}}</div>
								@endif
							</div>

						</div>
						<div id="student_details" class="form-group row">
							<div class="col-sm-2"></div>
							<div class="col-sm-10">
								<h6 class="sub-title">Detalles del alumno: <span style="color:#006de2" id="student_name"></span></h6>
								<div class="form-group row">
									<div class="col-sm-4">
										<strong>
											<p>Matricula:</p>
											<p>Email:</p>
											<p>Situación Académica Registrada:</p>
										</strong>
									</div>
									<div class="col-sm-5">
										<p style="font-weight: bold;" id="student_matricula"></p>
										<p id="student_email"></p>
										<p id="student_situation"></p>
									</div>
									<div class="col-sm-3">
										<img style="max-height: 115px" class="img-thumbnail" id="modal_img" src="{{ asset('storage/no_image.png')}}">
										<div id="modal_show_img" class="modal">
											<span class="close">&times;</span>
											<img class="modal-content" id="img_content">
											<div id="caption"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr />

						<br>
						<center>
							<a style="color:white" onclick="returnURL('{{ url()->previous() }}')" title="Regresar a la página anterior" class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
							<button type="submit" title="Guardar el alumno" class="btn btn-success"><i class="icofont icofont-link"></i>Asignar Tutorados</button>
						</center>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('javascriptcode')
<script type="text/javascript">

	var actual_academic_situation=[];

	//Valor del utlimo registro seleccionado del select2 de estudiantes
	var last_of_students_sel;

	//Cantidad de tutorados seleccionados
	var selected_tutorados = 0;

	//Elementos seleccionados actualmente del select2
	var selected_items = [];

	//Variable que almacena el ultimo valor que fue verificado para evitar llamadas innecesarias
	var last_verified;

	var containers=[];
	var back_containers=[];

	var is_selecting_option=false;
	var is_deleting=false;

	var old_selected_tutorados= JSON.parse('@php echo(json_encode(old("students_sel"))) @endphp');

	var old_academic_situations=[];

	$(document).ready(function() {
		var old_academic_situations_str="";
		@if(old('academic_situation')!="")
			old_academic_situations_str='@php echo(old('academic_situation')) @endphp';
		@endif

		if(old_academic_situations_str.length>0){
			old_academic_situations=JSON.parse(old_academic_situations_str);
			var cant=0;
			for(var i=0;i<JSON.parse(old_academic_situations_str).length;i++){
				for(var j=0;j<old_academic_situations.length;j++){
					if(old_academic_situations[j][0]==(JSON.parse(old_academic_situations_str)[i])[0]){
						cant++;
						break;
					}else{
						old_academic_situations.push(JSON.parse(old_academic_situations_str)[i]);
					}
				}
			}
		}

		//Llamada para iniciar vista
		fill_student_select();
		show_student_details(-1);
		$('#attached_file_div').fadeOut(0);

		//Iniciando select2 de estudiantes
		$("#students_sel").select2({
			multiple: true,
			templateSelection: function(data, container) {
				//Almacena los elementos que han sido seleccionados del select2
				var selected_items = [];

				//Se busca en cada uno para ver cuales estan seleccionados
				$('#students_sel :selected').each(function(i, selected) {
					selected_items[i] = $(selected).val();
				});


				//Cantidad de tutorados seleccionados en el students_sel select2
				selected_tutorados = selected_items.length;

				//Se pone por defecto el primer valor del array de los tutorados en caso
				//de que no se encuentre el ultimo(caso de borrado)
				if (selected_tutorados > 0 && selected_items.indexOf(last_of_students_sel) == -1)
					last_of_students_sel = selected_items[selected_items.length-1];

				//Se obtiene la seleccion del select2
				var selection = $('#students_sel').select2('data');

				//Se obtiene el id del elemento seleccionado
				data.idx = selection.indexOf(data);

				if(containers.indexOf([$(container),data.id]) == -1){

					containers.push([$(container),data.id]);
				}

				//En caso de que el elemento modificado sea el ultimo seleccionado se cambia su color
				if (data.id == last_of_students_sel) {
					//Asignando color de fondo
					$(container).css("border-color", "#007bff");
					$(container).css("background-color", "#ffffff");
					$(container).css("border-width", "1px");

					//Se actualiza el div que muestra los detalles del alumnos
					if(!is_deleting)
						show_student_details(data.id);
					else{
						show_student_details(data.id, 2);
						is_deleting=false;
					}
				}

				return data.text;
			},
		});

		//En caso de evento de seleccionar en el select2
		$("#students_sel").on("select2:select", function(evt) {
			//Id del elemento
			var element = evt.params.data.element;

			//Referencia al elemento
			var $element = $(element);

			//Se quita el elemento del select2
			$element.detach();
			$(this).append($element);

			//Se lanza el evento change
			$(this).trigger("change");

			var items = $(this).val();
			last_of_students_sel = evt.params.data.id;
		});

		$('#students_sel').on('select2:unselect', function(e) {
			is_deleting=true;
			show_student_details(-1);

		});

		//En caso de que cambie se buscan los tutorados del tutor actual
		$("#tutor").change(function() {
			fill_student_select();
			show_student_details();
		});

		//Se ejecuta en caso de que cambie el contenido HTML del select de estudiantes
		$('#students_sel').bind("DOMSubtreeModified", function() {
			//show_student_details();
		});

		//Se ejecuta en caso de que cambie el contenido HTML del select de estudiantes
		$('#type_of_attention_id').bind("DOMSubtreeModified", function() {
			hide_elements();
		});

		//Se ejecuta en caso de que se cambie el elemento seleccionado en el select
		//de estudiantes
		$("#type_of_attention_id").change(function() {
			hide_elements();
		});


		$('#students_sel').on('select2:open', function (e) {
			if(is_selecting_option){
				$(this).select2('close');
				is_selecting_option=false;

			}
			if(is_deleting){
				$(this).select2('close');
				is_deleting=false;
			}
		});

		$(document).on('change','#actual_academic_situation',function(){
			for(var i=0;i<actual_academic_situation.length;i++){
				if(actual_academic_situation[i][0]==last_of_students_sel){
					actual_academic_situation[i][1]=$('#actual_academic_situation').val()==="1"?1:0;
				}
			}
			$("#academic_situation").val(JSON.stringify(actual_academic_situation));
	    });

		@if(isset($_GET['id']))
			var id='{{ $_GET['id'] }}';
			$("#tutor").val(id);
			$('#tutor').trigger('change.select2');

		@endif
	});

	//Muestra los detalles del estudiante que se tenga seleccionado actualmente
	function show_student_details(verificating, update=0) {
		for(var i=0;i<containers.length;i++){
			$(containers[i][0]).val($(containers[i])[1]);
			$(containers[i][0]).unbind('click');
			$(containers[i][0]).click(function(e){
				if($(e.target).attr('class')!='select2-selection__choice__remove'){
					var original_color = $(this).css("background-color");
					for(var i=0;i<containers.length;i++){
						$(containers[i][0]).css("border-color", "#AAAAAA")
						$(containers[i][0]).css("background-color", "#e4e4e4");
						$(containers[i][0]).css("border-width", "1px");
						$(containers[i][0]).css("color", "#313848");
					}
					$(this).css("border-color", "#007bff");
					$(this).css("background-color", "#ffffff");
					$(this).css("border-width", "1px");

					last_of_students_sel=$(this).val();

					show_student_details($(this).val(), 1);

					is_selecting_option=true;
				}
			});
		}

		//Se realiza esta verificacion para evitar las llamdas incesarias al servidor
		//al verificar ids repetidos, garantizando la llamada al servidr 1 vez
		if(last_verified!=verificating || update==1 || verificating==-1){

			selected_items = [];
			$('#students_sel :selected').each(function(i, selected) {
				selected_items[i] = $(selected).val();
			});

			if(actual_academic_situation.length==0 && selected_items.length>0){
				if(old_academic_situations.length>0){
					for(var i=0;i<old_academic_situations.length;i++){
						if(old_academic_situations[i][0]==selected_items[0]){
							actual_academic_situation.push([selected_items[0],old_academic_situations[i][1]]);
							old_academic_situations.splice(i,1);

							break;
						}
					}
				}else{
					actual_academic_situation.push([selected_items[0],-1]);
				}
			}

			var index_found=0;
			var times_found=-1;

			for(var i=0;i<selected_items.length;i++){
				var found=false;
				var index_found=-1;
				for(var j=0;j<actual_academic_situation.length;j++){
					if(actual_academic_situation[j][0]==selected_items[i]){
						found=true;
					}
				}
				if(!found)
					actual_academic_situation.push([selected_items[i],-1])
			}

			for(var i=0;i<actual_academic_situation.length;i++){
				var found=false;
				for(var j=0;j<selected_items.length;j++){
					if(actual_academic_situation[i][0]==selected_items[j]){
						found=true;
						break;
					}
				}
				if(!found){
					actual_academic_situation.splice(i, 1);
				}
			}

			//Cantidad de tutorados seleccionados en el students_sel select2
			selected_tutorados = selected_items.length;

			//Se pone por defecto el primer valor del array de los tutorados en caso
			//de que no se encuentre el ultimo(caso de borrado)
			if(update==0){
				back_containers=containers;

				if (selected_tutorados > 0 && selected_items.indexOf(last_of_students_sel) == -1){
					last_of_students_sel = selected_items[selected_items.length-1];
				}
			}





			//Si el select2 no esta vacio
			if (selected_tutorados > 0) {
				//Se prepara la solicitud agregando a la cabecera el token csrf
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					}
				});

				//Se realiza la peticion y se manda en data, los valores requeridos
				//por la funcion
				$.ajax({
					url: '{{ route('tutorias.get_student_details') }}',
					method: 'post',
					data: {
						id: last_of_students_sel,
					},
					success: function(result) {

						student = result['response'];

						//Se cambia el valor del nombre
						$("#student_name").text(student['first_name'] + " " + student['last_name'] + " " + student['second_last_name']);

						//Se cambia el valor de la matricula
						$("#student_matricula").text(student['university_id']);
						//Se cambia el email
						$("#student_email").text(student['email']);

						for(var i=0;i<actual_academic_situation.length;i++){
							if(actual_academic_situation[i][0]==student['id'] && actual_academic_situation[i][1]==-1){
								actual_academic_situation[i][1]=student['academic_situation'];
								break;
							}
						}

						$("#academic_situation").val(JSON.stringify(actual_academic_situation));

						for(var i=0;i<actual_academic_situation.length;i++){
							if(actual_academic_situation[i][0]==student['id']){
								$("#actual_academic_situation").val(actual_academic_situation[i][1]).change();
								break;
							}
						}

						//En caso de la situacion se muestra difierente mensaje y estilo
						if (student['academic_situation'] == 0) {
							$("#student_situation").css("color", "black");
							$("#student_situation").text("Regular");
						} else {
							$("#student_situation").css("color", "red");
							$("#student_situation").text("Especial");
						}
						$("#modal_img").attr("src", base_img_url + student['image_url']);
						$("#modal_img").attr("alt", student['first_name'] + " " + student['last_name'] + " " + student['second_last_name']);

						//Se muestra una animacion de fadeIn del div que contiene los detalles del
						//estudiante
						$('#student_details').fadeIn(400);
					}
				});
			} else {
				//Se oculta el div que contiene los detalles del estudiante
				$('#student_details').fadeOut(0);
				$("#student_name").val("");
				$("#student_matricula").val("");
				$("#student_email").val("");
				$("#student_situation").val("");
				actual_academic_situation=[];
				containers=[];
			}

			//Se actualiza el valor verificado
			last_verified=verificating;

		}
	}

	//Muestra el div para agregar un archivo adjunto a la tutoria
	function show_attachFileDiv() {
		if ($("#type_of_orientation_sel").val() != 0)
			$('#attached_file_div').fadeIn(400);
		else
			$('#attached_file_div').fadeOut(0);

	}

	//Oculta los elementos de la vista para los problemas de atencion
	function hide_elements() {
		if ($("#type_of_attention_id").val() == '1'){
			$("#attached_file_div").fadeOut(0);
		}
		else
			$('#attached_file_div').fadeIn(400);
	}

	//Llena el select que contiene a los estudiantes en la vista
	function fill_student_select() {
		//Se crea la variable que contendra el codigo html de las opciones
		var options_html;

		//Se prepara la solicitud agregando a la cabecera el token csrf
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': '{{ csrf_token() }}'
			}
		});

		//Se realiza la peticion y se manda en data, los valores requeridos
		//por la funcion
		$.ajax({
			url: '{{ route('assignations.get_students') }}',
			method: 'post',
			data: {
				id: $("#tutor").val(),
			},

			success: function(result) {
				var tutorados = result['response'];
				console.log(tutorados);
				options_html = "";

				for (var i = 0; i < tutorados.length; i++) {
					options_html = options_html + "<option value='" + tutorados[i]['id'] + "'>" + tutorados[i]['first_name'] + " " + tutorados[i]['last_name'] + " " + tutorados[i]['second_last_name'] + "</option>";
				}
				$("#students_sel").html(options_html);


				//En caso de que no se encuentren registros se queda vacio el select y se
				//pone en modo disabled asi mismo como el boton de guardar
				if (options_html == "") {
					$("#students_sel").prop('disabled', true);
					$("#save").prop('disabled', true);
					$("#type_of_attention_id").prop('disabled', true);
					$("#attention_problem_id").prop('disabled', true);
					$("#academic_situation").prop('disabled', true);
					$("#observations").prop('disabled', true);
					$("#image_input").prop('disabled', true);

					$("#student_details").fadeOut(0);
					$("#student_name").val("");
					$("#student_matricula").val("");
					$("#student_email").val("");
					$("#student_situation").val("");
					$("#students_sel").val("");
					last_of_students_sel="";

					$("#icon_file_upload").toggleClass('disabled_icon_file');;
				} else {
					$("#students_sel").prop('disabled', false);
					$("#save").prop('disabled', false);
					$("#type_of_attention_id").prop('disabled', false);
					$("#attention_problem_id").prop('disabled', false);
					$("#academic_situation").prop('disabled', false);
					$("#observations").prop('disabled', false);
					$("#image_input").prop('disabled', false);

					$("#student_details").fadeIn(400);
					$("#icon_file_upload").toggleClass('enabled_icon_file');
				}

				$('#students_sel').val(old_selected_tutorados);
				old_selected_tutorados=[];
			}
		});
	}
</script>
@endsection
