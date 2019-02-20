@extends('errors.notfound')

@section('title',"Pagina No Encontrada")

@section('content')
    <h1>Pagina no encontrada</h1>
    <br />
    <center>
        <a href="{{ URL::previous() }}" style="height:60px;width:200px;font-size:3rem;" class="btn btn-warning btn-lg">
            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
            Regresar
        </a>
    </center>
@endsection

@section('back')
    {{--
    @switch(Auth::user()->type)
        @case(0)
            <li><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li><a href="{{ route('users.list') }}">Usuarios</a></li>
            <li><a href="{{ route('careers.list') }}">Carreras</a></li>
            <li><a href="{{ route('tutorias.list') }}">Tutorias</a></li>
            <li><a href="{{ route('students.list') }}">Estudiantes</a></li>
            <li><a href="{{ route('tutors.list') }}">tutores</a></li>
            @break
        @case(1)
            <li><a href="{{ route('dashboard') }}">Inicio</a></li>
            <li><a href="{{ route('users.list') }}">Usuarios</a></li>
            <li><a href="{{ route('careers.list') }}">Carreras</a></li>
            <li><a href="{{ route('students.list') }}">Estudiantes</a></li>
            <li><a href="{{ route('tutors.list') }}">tutores</a></li>
            @break
        @case(2)
            <span> Usuario </span>
            @break
    @endswitch
    --}}

@endsection
