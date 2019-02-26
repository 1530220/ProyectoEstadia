@extends('layouts.app')

@section('title',"Bolsa de Trabajo - Crear Empresa")

@section('body')
<!-- Main-body start -->
<div class="main-body">
	<!-- Page-header start -->
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="fa fa-plus" style="background-color:lightseagreen;"></i>
					<div class="d-inline">
						<h4 style="text-transform: none;">Crear Empresa</h4>
						<span style="text-transform: none;">Llene los campos en la parte inferior para registrar una nueva empresa.</span>
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
						<li class="breadcrumb-item"><a href="{{ route('companies.list') }}">Empresas</a>
						</li>
						<li class="breadcrumb-item">Crear Empresa
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
						<form id="form" method="POST" action="{{ route('companies.list') }}" enctype="multipart/form-data">
							{!! csrf_field() !!}
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							


							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="id">ID Empresa:</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="id" name="id" placeholder="Ej. 10" value="{{ old('id') }}" title="ID de la Empresa">
									@if ($errors->has('id'))
										<div class="col-form-label" style="color:red;">{{$errors->first('id')}}</div>
									@endif
									<div id="error_id" class="col-form-label" style="color:red; display:none;"></div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="rfc">RFC:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="rfc_input" oninput="validarInput(this)" name="rfc" placeholder="Ej. XAXX010101000" value="{{ old('rfc') }}" title="RFC de la Empresa">
									@if ($errors->has('rfc'))
										<div class="col-form-label" style="color:red;">{{$errors->first('rfc')}}</div>
									@endif
									<div  class="col-form-label" id="resultado" style="display:none;"></div>
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="name">Nombre:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" placeholder="Ej. Oracle" value="{{ old('name') }}" title="Nombre de la Empresa">
									@if ($errors->has('name'))
										<div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="telefono">Teléfono:</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="telefono" placeholder="Ej. 8349874563" value="{{ old('telefono') }}" title="Telefono de la Empresa">
									@if ($errors->has('telefono'))
										<div class="col-form-label" style="color:red;">{{$errors->first('telefono')}}</div>
									@endif
								</div>
							</div>
							
							<div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="country">País:</label>
                                <div class="col-sm-4">
                                    {!! Form::select('country',$countries,null,['id'=>'country','class'=>'form-control']) !!}
                                    @if ($errors->has('country'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('country')}}</div>
                                    @endif
								</div>
								
								<label class="col-sm-2 col-form-label" for="state">Estado:</label>
                                <div class="col-sm-4">
                                    {!! Form::select('state',['placeholder'=>'Favor de seleccionar un país'],null,['id'=>'state','class'=>'form-control']) !!}
                                    @if ($errors->has('state'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('state')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="city">Ciudad:</label>
                                <div class="col-sm-4">
                                    {!! Form::select('city',['placeholder'=>'Favor de seleccionar un estado'],null,['id'=>'city','class'=>'form-control']) !!}
                                    @if ($errors->has('city'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('city')}}</div>
                                    @endif
								</div>

								<label class="col-sm-2 col-form-label" for="zip">Código Postal:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="zip" placeholder="Ej. 87000" value="{{ old('zip') }}" title="Codigo Postal">
									@if ($errors->has('zip'))
										<div class="col-form-label" style="color:red;">{{$errors->first('zip')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="colonia">Colonia:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="colonia" placeholder="Ej. Liberal" value="{{ old('colonia') }}" title="Colonia">
									@if ($errors->has('colonia'))
										<div class="col-form-label" style="color:red;">{{$errors->first('colonia')}}</div>
									@endif
								</div>
								<label class="col-sm-2 col-form-label" for="calle">Calle:</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" name="calle" placeholder="Ej. Guerrero" value="{{ old('calle') }}" title="Calle">
									@if ($errors->has('calle'))
										<div class="col-form-label" style="color:red;">{{$errors->first('calle')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="horario">Horario de la Empresa:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="horario" rows="3" maxlength="500" placeholder="Ej. Lunes a Viernes de 8:00 a 20:00" title="Horario de la Empresa">{{ old('horario') }}</textarea>
									@if ($errors->has('horario'))
										<div class="col-form-label" style="color:red;">{{$errors->first('horario')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label" for="descripcion">Descripción de la Empresa:</label>
								<div class="col-sm-10">
									<textarea class="form-control" name="descripcion" rows="5" maxlength="1000" placeholder="Ej. Oracle Corporation es una compañía especializada en el desarrollo de soluciones de nube y locales" title="Descripción de la Empresa">{{ old('descripcion') }}</textarea>
									@if ($errors->has('descripcion'))
										<div class="col-form-label" style="color:red;">{{$errors->first('descripcion')}}</div>
									@endif
								</div>
							</div>

							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Imagen:</label>
								<div class="col-sm-10">
									<div class="file-upload">
										<div class="image-upload-wrap">
											<input id="image_input" class="file-upload-input" type='file' name="image" onchange="readURL(this);" accept="image/*" />
											<div style="padding-top:40px" onclick="$('.file-upload-input').trigger('click' )">
												<center>
													<i style="font-size: 60px;" class="fas fa-cloud-upload-alt drag-icon"></i>
												</center>
											</div>
											<div class="drag-text">
												<span>Arrastre y suelte la imagen de la empresa <span style="font-weight: bold; font-size:16px;"> aquí</span> o haga clic <span style="font-weight: bold; font-size:16px;"> aquí</span> para buscarla en su equipo.</span>
											</div>
										</div>
										<div class="file-upload-content">
											<img class="file-upload-image" src="#" alt="your image" />
											<div class="image-title-wrap">
												<button type="button" onclick="removeUpload()" class="remove-image">Remover Imagen</button>
											</div>
										</div>
									</div>
								</div>
							</div>

							<br>
							<center>
								<a style="color:white" onclick="returnURL('{{ url()->previous() }}')"  class="btn btn-primary"><i class="icofont icofont-arrow-left"></i>Regresar</a>
								<button type="submit" style="display:none;" id="registroEmpresa" class="btn btn-success"><i class="icofont icofont-check-circled"></i>Guardar Empresa</button>
							</center>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<style>
#resultado {
    color: red;
    font-weight: bold;
}
#resultado.ok {
    color: green;
}
</style>
@section('javascriptcode')
	<script>
		error_divs = [
			$('#error_id'),
		];
		verify_column($('#id'), 'id', 'companies', null, $('#error_id'),
			'* El id que esta intentando ingresar no esta disponible.');

		//* Se verifica que no se ingrese un registro repedito para columnas unicas
		$('#id').keyup(function(e) {
			verify_column($('#id'), 'id', 'companies', null, $('#error_id'),
				'* El id que esta intentando ingresar no esta disponible.');
		});
		//* Termina verificacion de columnas unicas



        //Función para validar un RFC
        // Devuelve el RFC sin espacios ni guiones si es correcto
        // Devuelve false si es inválido
        // (debe estar en mayúsculas, guiones y espacios intermedios opcionales)
        function rfcValido(rfc, aceptarGenerico = true) {
            const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
            var   validado = rfc.match(re);

            if (!validado)  //Coincide con el formato general del regex?
                return false;

            //Separar el dígito verificador del resto del RFC
            const digitoVerificador = validado.pop(),
                rfcSinDigito      = validado.slice(1).join(''),
                len               = rfcSinDigito.length,

            //Obtener el digito esperado
                diccionario       = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
                indice            = len + 1;
            var   suma,
                digitoEsperado;

            if (len == 12) suma = 0
            else suma = 481; //Ajuste para persona moral

            for(var i=0; i<len; i++)
                suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
            digitoEsperado = 11 - suma % 11;
            if (digitoEsperado == 11) digitoEsperado = 0;
            else if (digitoEsperado == 10) digitoEsperado = "A";

            //El dígito verificador coincide con el esperado?
            // o es un RFC Genérico (ventas a público general)?
            if ((digitoVerificador != digitoEsperado)
            && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
                return false;
            else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
                return false;
            return rfcSinDigito + digitoVerificador;
        }


        //Handler para el evento cuando cambia el input
        // -Lleva la RFC a mayúsculas para validarlo
        // -Elimina los espacios que pueda tener antes o después
        function validarInput(input) {
            var rfc         = input.value.trim().toUpperCase(),
                resultado   = document.getElementById("resultado"),
				button   = document.getElementById("registroEmpresa"),
                valido;
            
			if(rfc==""){
				resultado.style.display="none";
				button.style.display="none"
			}else{
				resultado.style.display="block";
			}
            var rfcCorrecto = rfcValido(rfc);   // ⬅️ Acá se comprueba
        
            if (rfcCorrecto) {
                valido = "válido";
            resultado.classList.add("ok");
			button.style.display="inline"
            } else {
                valido = "no válido"
                resultado.classList.remove("ok");
				button.style.display="none"
            }
                
            resultado.innerText = " * RFC " + valido;
        }
	</script>
@endsection
