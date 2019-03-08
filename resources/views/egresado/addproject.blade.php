@extends('egresado.layout')
@section('titulo')
    Tu perfil
@endsection
@section('menu')
              <div class="box-shadow-for-ui">
                <div class="uou-block-2b">
                  <div class="container"> <a href="/inicio_egresado" class="logo"><img src="/assets/images/logoupv.png" alt=""></a> <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>
                    <nav class="nav">
                      <ul class="sf-menu">
                          <li><a href="/inicio_egresado" style="color:white;"><i class="fa  fa-home"></i></a></li>
                          <li> <a href="/ofertas_trabajo" style="color:white;"><i class="fas fa-building"></i> Empresas</a> </li>
                          <li> <a href="/lista_egresados" style="color:white;"><i class="fas fa-user-tie"></i> Alumnos</a> </li>
                          <li> <a href="/perfil_egresado/{{auth()->user()->id}}" style="color:white;"><i class="fas fa-user"></i> Tu perfil</a></li>
                          <li><a href="/conexiones_egresado/{{auth()->user()->id}}" style="color:white;"><i class="fab fa-connectdevelop"></i> Conexiones</a></li>
                          <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:white;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                          </form>
                      </ul>
                    </nav>
                  </div>
                </div>
                <!-- end .uou-block-2b --> 
              </div>
@endsection
@section('contenido')
<div class="compny-profile"> 
        <!-- SUB Banner -->
        <div class="profile-bnr user-profile-bnr">
          <div class="container">
            <div class="pull-left">
              
              <h2><i class="fas fa-user"></i> @foreach ($users as $user)
                  
             {{$user->first_name}} {{$user->last_name}}</h2> 
              <!--h5>Front-End Developer</h5-->
            </div>
          </div>
          
          <!-- Modal POPUP -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="container">
                  <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a> Send Message</h6>
                  
                  <!-- Forms -->
                  <form action="#">
                    <ul class="row">
                      <li class="col-xs-6">
                        <input type="text" placeholder="First Name ">
                      </li>
                      <li class="col-xs-6">
                        <input type="text" placeholder="Last Name">
                      </li>
                      <li class="col-xs-6">
                        <input type="text" placeholder="Country">
                      </li>
                      <li class="col-xs-6">
                        <input type="text" placeholder="Email">
                      </li>
                      <li class="col-xs-12">
                        <textarea placeholder="Your Message"></textarea>
                      </li>
                      <li class="col-xs-12">
                        <button class="btn btn-primary">Send message</button>
                      </li>
                    </ul>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Profile Company Content -->
        <div class="profile-company-content user-profile main-user" data-bg-color="f5f5f5">
          <div class="container">
            <div class="row"> 
              
              <!-- Nav Tabs -->
              <div class="col-md-12">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#profile"><i class="fas fa-plus"></i> Agregar Proyectos</a></li>
                </ul>
              </div>
              
              <!-- Tab Content -->
              <div class="col-md-12">
                <div class="tab-content"> 
                  
                  <!-- PROFILE -->
                  <div id="profile" class="tab-pane fade in active">
                    <div class="row">
                      <div class="col-md-8"> 
                        
                        <!-- Professional Details -->
                        <div class="sidebar">
                          <h5 class="main-title">Proyectos</h5>
                          
                          <div class="listing listing-1">
                            <div class="listing-section">
                              
                                  
                                  
                                 <form method="POST" action="/agregar_proyectos/{{auth()->user()->id}}">
                                 {!! csrf_field() !!}
                                 
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-12">
                                 <label>* Nombre del proyecto</label>
                                 <input type="text" name="name" placeholder="Ej. Diseño e implementación de base de datos Oracle" style="color:black" value="{{ old('name') }}" required>
                                 @if ($errors->has('inicio'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									               @endif
                                 </div>
                                 </div>
                                 
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-6">
                                 <label>* Fecha de inicio del proyecto</label>
                                 <input type="date" name="start_date" title="Fecha de Inicio del Proyecto" value="{{ old('start_date') }}" required>
                                 @if ($errors->has('inicio'))
										            <div class="col-form-label" style="color:red;">{{$errors->first('start_date')}}</div>
									              @endif
                                 </div>
                                 <div class="form-group col-md-6">
                                 <label>* Fecha de inicio del proyecto</label>
                                 <input type="date" name="finish_date" title="Fecha de Finalización del Proyecto" value="{{ old('finish_date') }}" required>
                                 @if ($errors->has('inicio'))
										            <div class="col-form-label" style="color:red;">{{$errors->first('finish_date')}}</div>
									              @endif
                                 </div>
                                 </div>
                                 
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-12">
                                 <label>* Descripción del proyecto</label>
                                 <textarea rows="15" cols="50" class="form-control" type="text" placeholder="Ej. Proyecto donde se tuvo que analizar información que requiere una empresa para asi poder optar por un diseño de base de datos normalizada y proceder a implementarla" value="{{ old('description') }}" maxlength="1000" style="color:black" name="description" value="{{ old('description') }}" required></textarea>
                                  @if ($errors->has('inicio'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									               @endif
                                 </div>
                                 </div>
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-6">
                                 <label>* Jefe/Lider del proyecto</label>
                                 <input type="text" name="boss" placeholder="Ej. M.S.I. Mario Humberto Rodriguez" style="color:black" value="{{ old('boss') }}" required>
                                  @if ($errors->has('inicio'))
										              <div class="col-form-label" style="color:red;">{{$errors->first('boss')}}</div>
									                 @endif
                                 </div>
                                 <div class="form-group col-md-6">
                                 <label>* Nombre de la empresa</label>
                                 <input type="text" name="company" placeholder="Ej. Universidad Politécnica de Victoria" style="color:black" value="{{ old('company') }}" required>
                                  @if ($errors->has('inicio'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('company')}}</div>
									               @endif
                                 </div>
                                 </div>
                                 
                                  <input type="hidden" name="university_id" value="{{auth()->user()->university_id}}">
                              
                              <div class="form-row">
                              <div class="form-group col-md-12">
                              <center><button type="submit" class="btn btn-primary">Agregar Proyecto</button></center>
                              </div>
                              </div>
                              <br>
                              <div class="form-row">
                              <div class="form-group col-md-1">
                              <center><a href="/perfil_egresado/{{auth()->user()->id}}"><button type="button" class="btn btn-secondary">Regresar Perfil</button></a></center>
                              </div>
                              </div>
                            </form>
                
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      
                      <!-- Col -->
                      <div class="col-md-4"> 
                        
                        <!-- Professional Details -->
                        <div class="sidebar">
                          <h5 class="main-title">Detalles profesionales</h5>
                          <div class="sidebar-information">
                            <ul class="single-category">
                              <li class="row">
                                    <h6 class="title col-xs-6">Matricula</h6>
                                    <span class="subtitle col-xs-6">{{$user->university_id}}</span></li>
                                    <br>
                              <li class="row">
                                <h6 class="title col-xs-6">Nombre Completo</h6>
                                <span class="subtitle col-xs-6"> {{$user->first_name}} {{$user->last_name}} {{$user->second_last_name}}</span></li>
                                <br>
                                
                                <li class="row">
                                  <h6 class="title col-xs-6">Carrera</h6>
                                  <span class="subtitle col-xs-6">{{$user->name}}</span></li>
                                  
                                  <br>
                              <li class="row">
                                <h6 class="title col-xs-6">Correo</h6>
                                <span class="subtitle col-xs-6"><a href="#.">{{$user->email}}</a></span></li>
                            </ul>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection
@section('pie_pagina')
        <!-- Footer -->
      <div class="uou-block-4a secondary dark">
        <div class="container">
          <ul class="links">
            <p>Versión 1.0 - Enero 2019</p>
          </ul>
          <p>Desarollo: Equipo del M.S.I. Mario Humberto Rodríguez Chávez - Dirección de Tecnologías de la Información</p>
        </div>
      </div>
      <!-- end .uou-block-4a --> 
      
      <div class="uou-block-11a">
        <h5 class="title">Menu</h5>
        <a href="#" class="mobile-sidebar-close">&times;</a>
        <nav class="main-nav">
          <ul>
              <li><a href="/inicio_egresado" style="color:white;"><i class="fa  fa-home"></i> Inicio</a></li>
              <li> <a href="/ofertas_trabajo" style="color:white;"><i class="fas fa-building"></i> Empresas</a> </li>
              <li> <a href="/lista_egresados" style="color:white;"><i class="fas fa-user-graduate"></i> Egresados</a> </li>
              <li> <a href="/perfil_egresado/{{auth()->user()->id}}" style="color:white;"><i class="fas fa-user"></i> Tu perfil</a></li>
              <li><a href="/conexiones_egresado/{{auth()->user()->id}}" style="color:white;"><i class="fab fa-connectdevelop"></i> Conexiones</a></li>
              <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:white;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
              </form>
          </ul>
        </nav>
        <hr>
@endsection