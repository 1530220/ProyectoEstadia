@extends('layouts.login')

@section('content')
<section class="login p-fixed d-flex text-center bg-primary common-img-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="login-card card-block auth-body mr-auto ml-auto">
                    <form class="md-float-material" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="auth-box">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <img src="assets/images/UP_Victoria.png" alt="UP_Victoria.png" width="200px" height="100px">
                                    <<h3 class="text-center txt-primary">Bolsa de Trabajo de la Universidad Politécnica de Victoria</h3>
                                </div>
                            </div>
                            <hr/>
                            <div class="input-group">
                                <input id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Correo Electrónico" required autofocus>
                                @if  ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                            </div>
                            <div class="input-group">
                                <input id="password" name="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" required>
                                @if  ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                            </div>
                            
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-inverse btn-md btn-block text-center m-b-20">Iniciar Sesión</button>
                                </div>
                            </div>
                            

                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- Authentication card end -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>

@endsection
