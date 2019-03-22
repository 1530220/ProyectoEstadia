@extends('egresado.layout')
@section('titulo')
    Tu perfil
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
        </div>
        
        <!-- Profile Company Content -->
        <div class="profile-company-content user-profile main-user" data-bg-color="f5f5f5">
          <div class="container">
            <div class="row"> 
              
              <!-- Nav Tabs -->
              <div class="col-md-12">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#profile"><i class="fas fa-plus"></i> Agregar Evidencias</a></li>
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
                          <h5 class="main-title">Evidencia</h5>
                          
                          <div class="listing listing-1">
                            <div class="listing-section">
                              
                                  
                                  
                                 <form method="POST" action="/agregar_evidencias/{{auth()->user()->id}}" files="true" enctype="multipart/form-data">
                                 {!! csrf_field() !!}
                                 
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-12">
                                 <label>* Nombe de la evidencia</label>
                                 <input type="text" name="name" placeholder="Ej. Estancia 1" style="color:black" value="{{old('name')}}" required>
                                 @if ($errors->has('inicio'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('name')}}</div>
									               @endif
                                 </div>
                                 </div>
                                   
                                 <div class="form-row">
                                 <div class="form-group col-md-12">
                                 <label>* Agregar archivo de la evidencia ( *OJO tiene que ser archivos .png, .jpeg, .jpg, .gif o .pdf)</label>
                                 <input type="file" name="path" placeholder="Ej. Oracle" style="color:black" value="{{old('path')}}" required>
                                 @if ($errors->has('path'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('path')}}</div>
									               @endif
                                 </div>
                                 </div>
                                 <br>
     
                                  <input type="hidden" name="university_id" value="{{auth()->user()->university_id}}">
                              
                              <div class="form-row">
                              <div class="form-group col-md-12">
                               <br>
                                <br>
                              <center><button type="submit" class="btn btn-primary">Agregar Evidencia</button></center>
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