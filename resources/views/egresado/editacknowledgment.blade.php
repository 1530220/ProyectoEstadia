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
                              
                                  
                                 
                                 <form method="POST" action="/editar_reconocimientos/{{$acknowledgment->id}}">
                                 {{method_field('PATCH')}} 
                                 {!! csrf_field() !!}
                                 
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-12">
                                 <label>* Titulo del reconocimiento</label>
                                 <input type="text" name="title" placeholder="Ej. Practicante" style="color:black" value="{{ old('title',$acknowledgment->title) }}" required>
                                 @if ($errors->has('inicio'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('title')}}</div>
									               @endif
                                 </div>
                                 </div>
                                   
                                 <div class="form-row">
                                 <div class="form-group col-md-12">
                                 <label>* Empresa</label>
                                 <input type="text" name="transmitter" placeholder="Ej. Oracle" style="color:black" value="{{ old('transmitter',$acknowledgment->transmitter) }}" required>
                                 @if ($errors->has('inicio'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('transmitter')}}</div>
									               @endif
                                 </div>
                                 </div>
                                 
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-6">
                                 <label>* Fecha que recibiste el reconocimiento</label>
                                 <input type="date" name="date" title="Fecha de Inicio de la experiencia" value="{{ $acknowledgment->date }}" required>
                                 @if ($errors->has('inicio'))
										            <div class="col-form-label" style="color:red;">{{$errors->first('date')}}</div>
									              @endif
                                 </div>
                                 </div>
                                 
                                 
                                 <div class="form-row">
                                 <div class="form-group col-md-12">
                                 <label>* Descripción de la experiencia</label>
                                 <textarea rows="15" cols="50" class="form-control" type="text" placeholder="Ej. El reconocimiento donde se tuvo que analizar información que requiere una empresa para asi poder optar por un diseño de base de datos normalizada y proceder a implementarla" maxlength="1000" style="color:black" name="description" required>{{$acknowledgment->description}}</textarea>
                                  @if ($errors->has('inicio'))
										             <div class="col-form-label" style="color:red;">{{$errors->first('description')}}</div>
									               @endif
                                 </div>
                                 </div>
                                 
                                  <input type="hidden" name="university_id" value="{{auth()->user()->university_id}}">
                                 
            
                              
                              <div class="form-row">
                              <div class="form-group col-md-12">
                              <center><button type="submit" class="btn btn-primary">Actualizar Reconocimiento</button></center>
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