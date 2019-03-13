@extends('layouts.app')

@section('title',"Bolsa de Trabajo - UPV")

@section('body')
<div class="page-body">
    <div class="row">
        <!-- card1 start -->
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('students.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-user-graduate bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Alumnos</span>
                    <h4>{{ $students }}</h4>
                </div>
            </div></a>
        </div>
        
        
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('competences.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-star card1-icon" style="background-color:darkcyan"></i>
                    <span class="f-w-600" style="color:darkcyan">Competencias</span>
                    <h4>{{ $competences }}</h4>
                </div>
            </div></a>
        </div>

        <div class="col-md-6 col-xl-4">
            <a href="{{ route('skills.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-tag card1-icon" style="background-color:firebrick"></i>
                    <span class="f-w-600" style="color:firebrick">Habilidades</span>
                    <h4>{{ $skills }}</h4>
                </div>
            </div></a>
        </div>
        
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('medals.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-trophy card1-icon" style="background-color:#5e1287"></i>
                    <span class="f-w-600" style="color:#5e1287">Medallas</span>
                    <h4>{{ $medals }}</h4>
                </div>
            </div></a>
        </div>

        <div class="col-md-6 col-xl-4">
            <a href="{{ route('companies.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-building card1-icon" style="background-color:lightseagreen"></i>
                    <span class="f-w-600" style="color:lightseagreen">Empresas</span>
                    <h4>{{ $companies }}</h4>
                </div>
            </div></a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('contacts.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-address-book card1-icon" style="background-color:seagreen"></i>
                    <span class="f-w-600" style="color:seagreen">Contactos</span>
                    <h4>{{ $contacts }}</h4>
                </div>
            </div></a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('jobs.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-briefcase card1-icon" style="background-color:tomato"></i>
                    <span class="f-w-600" style="color:tomato">Vacantes</span>
                    <h4>{{ $jobs }}</h4>
                </div>
            </div></a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('sectors.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fa fa-bars card1-icon" style="background-color:slateblue"></i>
                    <span class="f-w-600" style="color:slateblue">Sectores</span>
                    <h4>{{ $sectors }}</h4>
                </div>
            </div></a>
        </div>
        <div class="col-md-6 col-xl-4">
            <a href="{{ route('connections.list') }}" style="color: #353c64;"><div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="fab fa-connectdevelop card1-icon"  style="background-color:cornflowerblue"></i>
                    <span class="f-w-600" style="color:cornflowerblue">Conexiones</span>
                    <h4>{{  3 }}</h4>
                </div>
            </div></a>
            <br><br>
        </div>
            <!-- card1 end -->
        <div class="col-md-6 col-xl-6">
            <a href="{{ route('log.sessionlist') }}" style="color: #353c64;"><div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h4>Historial de Sesiones</h4>
                        <p class="p-t-10 m-b-0" style="font-weight: bold; color:#fc6100;">Iniciadas en el mes</p>
                    </div>
                    <i class="icofont icofont-sign-in st-icon txt-lite-color" style="background-color:#fc6100"></i>

                    <div class="text-left">
                        <h3 style="float:right">{{ $sessions }}</h3>
                    </div>
                </div>

            </div></a>
        </div>
        
        <div class="col-md-6 col-xl-6">
            <a href="{{ route('log.movementslist') }}" style="color: #353c64;"><div class="card widget-statstic-card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h4>Historial de Movimientos</h4>
                        <p class="p-t-10 m-b-0" style="font-weight: bold; color:#7f0000">Realizados en el mes</p>
                    </div>
                    <i class="icofont icofont-history st-icon txt-lite-color" style="background-color:#7f0000"></i>

                    <div class="text-left">
                        <h3 style="float:right">{{ $movements }}</h3>
                    </div>
                </div>
            </div></a>
        </div>
       
    
        
    </div>
</div>
@endsection

