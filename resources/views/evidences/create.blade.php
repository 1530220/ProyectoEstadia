@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Cargar Evidencia")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color: #7C2EC1;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Cargar Evidencia</h4>
						<span style="text-transform: none;">Cargar evidencia al portafolio del alumno con matricula <strong>{{$matricula}}</strong>.</span>
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
            <li class="breadcrumb-item"><a href="{{route('students.show', ['id' => $matricula])}}">Detalles del Alumno</a>
            </li>
						<li class="breadcrumb-item">Cargar Evidencia
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
						<form id="form" method="POST" action="{{ route('evidences.cargarEvidencia', ['id' => $matricula]) }}" enctype="multipart/form-data">
							{!! csrf_field() !!}

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Evidencia:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID de la Evidencia">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Programacion web" value="{{ old('name') }}" title="Nombre de la Evidencia">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="evidence">Evidencia:</label>
								<div class="col-sm-10">
									
                  <div class="file-upload">
										<div class="image-upload-wrap">
											<input id="image_input" class="file-upload-input" type='file' name="archivo" onchange="readURLEvidences(this);" accept="file/*" required/>
											<div style="padding-top:40px" onclick="$('.file-upload-input').trigger('click' )">
												<center>
													<i style="font-size: 60px;" class="fas fa-cloud-upload-alt drag-icon"></i>
												</center>
											</div>
											<div class="drag-text">
												<span>Arrastre y suelte el archivo <span style="font-weight: bold; font-size:16px;"> aquí</span> o haga clic <span style="font-weight: bold; font-size:16px;"> aquí</span> para buscarlo en su equipo.</span>
											</div>
										</div>
										<div class="file-upload-content">
											<img class="file-upload-image" src="#" alt="your image" />
											<div class="image-title-wrap">
												<button type="button" onclick="removeUpload()" class="remove-image">Remover Archivo</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary col-lg-3"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" class="btn btn-success col-lg-3"><i class="icofont icofont-check-circled"></i>Guardar Evidencia</button>
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
		verify_column($('#id'), 'id', 'evidences', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'evidences', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas
    
    $('.image-title').html('Ningún archivo cargado');
    
    function readURLEvidences(input) {
      var split = input.files[0]['name'].split(".");

      var extension = split[split.length - 1];

      var accepted_extentions = ['jpeg', 'JPEG', 'png', 'PNG', 'jpg', 'JPG', 'pdf', 'PDF', 'bmp', 'BMP'];

      var accepted_file = false;

      if (accepted_extentions.includes(extension)) {
          accepted_file = true;
      }

      if (accepted_file) {
          if (input.files && input.files[0]) {
              if(input.files[0]['size']<4194304){
                  var reader = new FileReader();

                  reader.onload = function(e) {
                       $('.image-upload-wrap').hide();

                    if(extension=="pdf" || extension=="PDF"){
                        $('.file-upload-image').height(150);
                        $('.file-upload-image').width(100);
                        $('.file-upload-image').attr('src', window.location.href.split('/').slice(0, 3).join('/')+"/img/pdf_icon.png");
                    }else{
                        $('.file-upload-image').css('height', 'auto');
                        $('.file-upload-image').css('width', 'auto');
                        $('.file-upload-image').attr('src', e.target.result);
                    }
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                  };

                  reader.readAsDataURL(input.files[0]);
              }else{
                  $("#image_input").val("");
                  swal({
                      icon: 'error',
                      title: 'Archivo demasiado grande',
                      text: 'El archivo supera los 4 MB de tamaño, por favor seleccione un archivo que no sobrepase los 4 MB de tamaño.',
                      buttons: 'Aceptar',
                  });
              }

          } else {
              removeUpload();
          }
      }else{
          removeUpload();
          $("#image_input").val("");
          swal({
              icon: 'error',
              title: 'Formato de archivo no valido',
              text: 'Por favor solo agregue archivos con los siguientes formatos validos: jpg, png, jpeg, pdf, bmp.',
              buttons: 'Aceptar',
          })

      }
  }


	</script>
@endsection
