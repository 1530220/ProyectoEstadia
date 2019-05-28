@extends('layouts.noaccess')
@section('title')
@if($evidence->deleted==0)
Eliminar Evidencia
@else
Restaurar Evidencia
@endif
@endsection
@section('content')
<div class="content">

            <div class="content-box">

                <div class="big-content">

                    <!-- Your text -->
                @if($evidence->deleted==0)
                  <p style="color:white;">¿Seguro que quieres eliminar esta evidencia ( {{$evidence->name}} )?</p>
                @else
                <p style="color:white;">¿Seguro que quieres restaurar esta evidencia ( {{$evidence->name}} )?</p>
                @endif
                
                <form method="post" action="/eliminar_evidencias/{{auth()->user()->id}}">
                                    {{method_field('PATCH')}}  
                                      {{ csrf_field() }}  
                                    <div class="form-row">
                                        
                                    <div class="form-row">
                                    <div class="form-group col-md-12">
                                    <br>
                                    <br>
                                    <input type="hidden" name="idevidence" value="{{$evidence->id}}">
                                    @if($evidence->deleted==0)
                                      <center><button type="submit" class="btn btn-danger">Eliminar</button></center>
                                    @else
                                      <center><button type="submit" class="btn btn-success">Restaurar</button></center>
                                    @endif
                                    
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