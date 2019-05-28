@extends('layouts.noaccess')
@section('title')
Sin Acesso
@endsection
@section('content')
<div class="content">

            <div class="content-box">

                <div class="big-content">

                    <!-- Your text -->
                <h3 style="color:white;">Hola Usuario!!!</h3>

                <p style="color:white;">En este momento no puedes acceder a este sistema por favor dar clic en el boton para Salir.</p>
                <br>
                <center><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Salir</a></center>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>

                    
                </div>

                

            </div>

        </div>
@endsection