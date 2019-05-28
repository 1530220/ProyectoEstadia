@extends('layouts.noaccess')
@section('title')
Eliminar Habilidad
@endsection
@section('content')
<div class="content">

            <div class="content-box">

                <div class="big-content">

                    <!-- Your text -->
                <p style="color:white;">¿Seguro que quieres eliminar esta habilidad ({{$skill->name}})?</p>
                <form method="post" action="/eliminar_habilidades/{{auth()->user()->id}}">
                                    {{method_field('DELETE')}}  
                                      {{ csrf_field() }}  
                                    <div class="form-row">
                                        
                                    <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <br>
                                    <br>
                                    <input type="hidden" name="idskill" value="{{$skill->id}}">
                                    <center><button type="submit" class="btn btn-danger">Eliminar</button></center>
                                    <br>
                                    <center><a href="/perfil_egresado/{{auth()->user()->id}}"><button type="button" class="btn btn-warning">Regresar Perfil</button></a></center>
                                    </div>
                                    </div>
                                    </div>
                                  </form>
                <br>
                </div>
            </div>
        </div>
@endsection