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
                  <li class="active"><a data-toggle="tab" href="#profile">Su Perfil</a></li>
                  <li><a data-toggle="tab" href="#jobs">Sus trabajos ({{$count_jobs}})</a></li>
                  <!--li><a data-toggle="tab" href="#contact">Contact</a></li-->
                  <li><a data-toggle="tab" href="#portfolio">Su Galeria</a></li>
                  <!--li><a data-toggle="tab" href="#blog-tab">Blog Posts</a></li-->
                  <li><a data-toggle="tab" href="#Con-tab">Sus conexiones</a></li>
                  <li><a data-toggle="tab" href="#flowrs-tabs">Sus Seguidores (241)</a></li>
                  <li><a data-toggle="tab" href="#foll-tabs">Siguiendo</a></li>
                <li><a href="/editar_egresado/{{auth()->user()->id}}"><i class="fas fa-edit"></i> Editar Perfil</a></li>
                </ul>
              </div>
              
              <!-- Tab Content -->
              <div class="col-md-12">
                <div class="tab-content"> 
                  
                  <!-- PROFILE -->
                  <div id="profile" class="tab-pane fade in active">
                    <div class="row">
                      <div class="col-md-12">
                        
                        <div class="profile-main">
          
                            <h3>Experiencia Laboral</h3>
                              
                          <div class="profile-in">
                            <div class="media-left">
                              <div class="img-profile"> <img class="media-object" src="{{ asset($user->image_url)}}" alt="" style="width:100%;max-width:245px;height:100%;max-height:220px"> </div>
                            </div>
                            <div class="media-body">
                              
                              <center><button class="btn btn-primary">
                             Añadir Experiencia Laboral
                            </button></center>
                              <ul class="single-category">
                                <li><p>hola </p></li>
                                <li><p>hola </p></li>
                              </ul>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <div class="col-md-8"> 
                        
                        <!-- Skills -->
                        <div class="sidebar">
                          <h5 class="main-title">Habilidades</h5>
                          <div class="job-skills"> 
                            @foreach($skills_student as $ss )
                            
                            <!-- Modal POPUP -->
            <div class="modal fade" id="{{$ss->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="container">
                    <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a></h6>
                    
                    <!-- Forms -->
                    
                    <form method="post" action="/perfil_egresado/{{auth()->user()->id}}">
                      {{method_field('DELETE')}}  
                      {{ csrf_field() }} 
                      <ul class="row">
                        <center><h6>¿Seguro que quieres eliminar esta habilidad ({{$ss->name}})?</h6></center>
                        <li class="col-xs-4">
                          <center><a  class="close" href="#." data-dismiss="modal" aria-label="Close"><button class="btn btn-error">Cancelar</button></a></center>
                        </li>
                        <li class="col-xs-5">
                          
                          <input type="hidden" name="idskill" value="{{$ss->id}}"
                          
                          <center><button class="btn btn-primary" type="submit" >Eliminar</button></center>
                        </li>
                      </ul>
                    </form>
                  </div>
                </div>
              </div>
            </div>
                        
                            <!-- Logo Design -->
                            <ul class="row">
                              <li class="col-sm-3">
                                <h6>{{$ss->name}}</h6>
                              </li>
                              <li class="col-sm-9">
                                
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$ss->score}}%;"> </div>
                                </div>
                                <label>{{$ss->score}} / 100</label> <a href="/editar_habilidades/{{$ss->id}}" ><button class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></button></a>  <a href="/eliminar_habilidades/{{$ss->id}}" ><button class="btn btn-error" title="Eliminar"><i class="fas fa-trash-alt"></i></button></a>
                              </li>
                            </ul>
                            
                            @endforeach
                            <br>
                            <center><a href="/agregar_habilidades/{{auth()->user()->id}}"><i class="fas fa-plus"></i> Agregar Habilidades</a></center>
                          </div>
                        </div>
                        
                        <!-- Professional Details -->
                        <div class="sidebar">
                          <h5 class="main-title">Proyectos</h5>
                          @if ($contador_proyectos==0)
                          <div class="listing listing-1">
                            <div class="listing-section">
                              <div class="listing-ver-3">
                                 <center><h6>Aun no tienes proyectos</h6></center>
                              </div>
                              <center><a href="/agregar_proyectos/{{auth()->user()->id}}"><i class="fas fa-plus"></i> Agregar Proyectos</a></center>
                            </div>
                          </div>
                          @else
                          <div class="listing-ver-3">
                            <center><h5>* Proyectos Agregados ({{$proyectos_agregados}})</h5></center>
                          </div>
                          @if ($proyectos_agregados==0)
                            <div class="listing listing-1">
                              <div class="listing-section">
                                <div class="listing-ver-3">
                                  <center><h6>No tienes proyectos agregados</h6></center>
                                </div>
                              </div>
                            </div>   
                          @endif
                          @foreach ($projects as $project)
                           @if ($project->deleted==0 )
                            <div class="similar">
                              <div class="media">
                                <div class="media-body">
                                  <ul class="h6">
                                    <li><h6> {{$project->name}}</h6><a href="/editar_proyectos/{{$project->id}}">
                                      <button title="Editar" class="btn btn-warning">
                                      <i class="fas fa-edit"></i>
                                      </button></a> 
                                      <button title="Eliminar" class="btn btn-error" data-toggle="modal" data-target="#{{$project->id}}">
                                      <i class="fas fa-trash-alt"></i>
                                      </button></li>
                                    
                                    <!-- Modal POPUP -->
            <div class="modal fade" id="{{$project->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="container">
                    <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a></h6>
                    
                    <!-- Forms -->
                    
                    <form method="post" action="/perfil_egresado/{{auth()->user()->id}}">
                      {{method_field('PATCH')}}  
                      {{ csrf_field() }}  
                      <ul class="row">
                        <center><h6>¿Seguro que quieres eliminar este proyecto ({{$project->name}})?</h6></center>
                        <li class="col-xs-4">
                          <center><a  class="close" href="#." data-dismiss="modal" aria-label="Close"><button class="btn btn-error">Cancelar</button></a></center>
                        </li>
                        <li class="col-xs-5">
                          <input type="hidden" name="delete" value="1">
                          
                          <input type="hidden" name="idproject" value="{{$project->id}}"
                          
                          <center><button class="btn btn-primary" type="submit" >Eliminar</button></center>
                        </li>
                      </ul>
                    </form>
                  </div>
                </div>
              </div>
            </div>

                                  </ul>
                                </div>
                              </div>
                            </div>
                          @endif
                          @endforeach
                          <div class="listing-ver-3">
                            <center><h5>* Proyectos Eliminados ({{$proyectos_eliminados}})</h5></center>
                          </div>
                          @if ($proyectos_eliminados==0)
                            <div class="listing listing-1">
                              <div class="listing-section">
                                <div class="listing-ver-3">
                                   <center><h6>No tienes proyectos eliminados</h6></center>
                                </div>
                              </div>
                            </div>   
                          @endif
                          @foreach ($projects as $project) 
                          @if( $project->deleted==1 )
                            <div class="similar">
                              <div class="media">
                                <div class="media-body">
                                  <ul class="h6">
                                    <li><h6> {{$project->name}}</h6><a href="/editar_proyectos/{{$project->id}}">
                                      <button title="Editar" class="btn btn-warning">
                                      <i class="fas fa-edit"></i>
                                      </button></a> 
                                      <button title="Restaurar" class="btn btn-success" data-toggle="modal" data-target="#{{$project->id}}">
                                      <i class="fas fa-undo-alt"></i>
                                      </button></li>
                                    <!-- Modal POPUP -->
            <div class="modal fade" id="{{$project->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="container">
                    <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a></h6>
                    
                    <!-- Forms -->
                    <form method="post" action="/perfil_egresado/{{auth()->user()->id}}">
                      {{method_field('PATCH')}}  
                      {{ csrf_field() }}  
                      <ul class="row">
                        <center><h6>¿Seguro que quieres restaurar este proyecto ({{$project->name}})?</h6></center>
                        <li class="col-xs-4">
                          <center><a  class="close" href="#." data-dismiss="modal" aria-label="Close"><button class="btn btn-error">Cancelar</button></a></center>
                        </li>
                        <li class="col-xs-5">
                           <input type="hidden" name="delete" value="0">
                          <input type="hidden" name="idproject" value="{{$project->id}}">
                          <center><button class="btn btn-primary" type="submit">Restaurar</button></center>
                        </li>
                      </ul>
                    </form>
                  </div>
                </div>
              </div>
            </div>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          @endif
                          @endforeach
                          <center><a href="/agregar_proyectos/{{auth()->user()->id}}"><i class="fas fa-plus"></i> Agregar Proyectos</a></center>
                          @endif
                             
                        </div>
                        
                        <!-- Professional Details -->
                        <div class="sidebar">
                          <h5 class="main-title">Competencias</h5>
                          @if ($contador_competencias==0)
                          <div class="listing listing-1">
                            <div class="listing-section">
                              <div class="listing-ver-3">
                                 <center><h6>Aun no tienes competencias</h6></center>
                              </div>
                              <center><a href="/agregar_competencias/{{auth()->user()->id}}"><i class="fas fa-plus"></i> Agregar Competencias</a></center>
                            </div>
                          </div>
                          @else
                          <div class="listing-ver-3">
                            <center><h5>* Competencias Pendientes</h5></center>
                          </div>
                          @if ($competencias_pendientes==0)
                            <div class="listing listing-1">
                              <div class="listing-section">
                                <div class="listing-ver-3">
                                  <center><h6>No tienes competencias pendientes</h6></center>
                                </div>
                              </div>
                            </div>   
                          @endif
                          @foreach ($competences as $competence)
                           @if ($competence->status==0 )
                            <div class="similar">
                              <div class="media">
                                <div class="media-body">
                                  <h6>{{$competence->name}}</h6>
                                  <label>Puntaje: {{$competence->score}} de 100</label>
                                  <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$competence->score}}%;"> </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                          @endforeach
                          <div class="listing-ver-3">
                            <center><h5>* Competencias Aceptadas</h5></center>
                          </div>
                          @if ($competencias_aceptadas==0)
                            <div class="listing listing-1">
                              <div class="listing-section">
                                <div class="listing-ver-3">
                                   <center><h6>No tienes competencias aceptadas</h6></center>
                                </div>
                              </div>
                            </div>   
                          @endif
                          @foreach ($competences as $competence) 
                          @if( $competence->status==1 )
                            <div class="similar">
                              <div class="media">
                                <div class="media-body">
                                  <h6>{{$competence->name}}</h6>
                                   <label>Puntaje: {{$competence->score}} de 100</label>
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$competence->score}}%;"></div>
                                </div>
                                </div>
                              </div>
                            </div>
                          @endif
                          @endforeach
                          <center><a href="/agregar_competencias/{{auth()->user()->id}}"><i class="fas fa-plus"></i> Agregar Competencias</a></center>
                          @endif
                             
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
                  <!-- Jobs -->
                  <div id="jobs" class="tab-pane fade">
                    <div class="header-listing">
                      <h6>Listado por</h6>
                      <div class="custom-select-box">
                        <select name="order" class="custom-select">
                          <option value="0">Más popular</option>
                          <option value="1">Ultimos en subir</option>
                          <option value="2">Mejor Calificado</option>
                        </select>
                      </div>
                      <ul class="listing-views">
                        <li class="active"><a href="#"><i class="fa fa-list"></i></a></li>
                        <li><a href="#"><i class="fa fa-th"></i></a></li>
                        <li><a href="#"><i class="fa fa-th-large"></i></a></li>
                      </ul>
                    </div>
                    <div class="listing-heading">
                    <h5><i class="fas fa-asterisk"></i> Pendientes ({{$contador_pendientes}})</h5>
                    </div>
                    
                    @if ($contador_pendientes==0)
                    <div class="listing listing-1">
                        <div class="listing-section">
                          <div class="listing-ver-3">
                             <center><h6>No tienes ninguna vacante pendiente</h6></center>
                          </div>
                        </div>
                      </div>
                    @else
                    @foreach ($trabajos_pendientes as $trabajo_pendiente)
                    <div class="listing listing-1">
                        <div class="listing-section">
                          <div class="listing-ver-3">
                            <div class="listing-heading">
                              <h5>{{$trabajo_pendiente->name}}</h5>
                              <ul class="bookmark list-inline">
                                <li><a href="#"><i class="fa fa-bookmark"></i></a></li>
                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                <li><a href="#"><i class="fa fa-share"></i></a></li>
                              </ul>
                            </div>
                            <div class="listing-inner">
                              <div class="listing-content">
                                <h6 class="title-company">{{$trabajo_pendiente->company_name}}</h6>
                                <span class="location"> <i class="fa fa-map-marker"></i> Manhattan, New york, USA </span> <span class="type-work full-time"> Full Time </span>
                              <p>{{$trabajo_pendiente->description}}</p>
                              <p>*Salario: ${{$trabajo_pendiente->salary}}</p>
                                <h6 class="title-tags">Habilidades requeridas:</h6>
                                <ul class="tags list-inline">
                                  <li><a href="#">Javascript</a></li>
                                  <li><a href="#">Wordpress</a></li>
                                  <li><a href="#">Presta</a></li>
                                  <li><a href="#">Sass</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="listing-tabs">
                              <ul>
                                <li><a href="#"><i class="fa fa-envelope"></i> honda@contact.com</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i> 012 345 678</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                    @endif


                    <div class="listing-heading">
                      <h5><i class="fas fa-check"></i> Aceptados ({{$contador_aceptados}})</h5>
                    </div>
                    @if ($contador_aceptados==0)
                    <div class="listing listing-1">
                        <div class="listing-section">
                          <div class="listing-ver-3">
                             <center><h6>No tienes ninguna vacante aceptada</h6></center>
                          </div>
                        </div>
                      </div>
                    @else
                    <div class="listing listing-1">
                        <div class="listing-section">
                          <div class="listing-ver-3">
                            <div class="listing-heading">
                              <h5></h5>
                              <ul class="bookmark list-inline">
                                <li><a href="#"><i class="fa fa-bookmark"></i></a></li>
                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                <li><a href="#"><i class="fa fa-share"></i></a></li>
                              </ul>
                            </div>
                            <div class="listing-inner">
                              <div class="listing-content">
                                <h6 class="title-company">Mars Planet Telecommunications Inc.</h6>
                                <span class="location"> <i class="fa fa-map-marker"></i> Manhattan, New york, USA </span> <span class="type-work full-time"> Full Time </span>
                                <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio pellentesque habitant morbi tristique senectus et netus et malesuada. <a href="single_job.html">read more</a></p>
                                <h6 class="title-tags">Habilidades requeridas:</h6>
                                <ul class="tags list-inline">
                                  <li><a href="#">Javascript</a></li>
                                  <li><a href="#">Wordpress</a></li>
                                  <li><a href="#">Presta</a></li>
                                  <li><a href="#">Sass</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="listing-tabs">
                              <ul>
                                <li><a href="#"><i class="fa fa-envelope"></i> honda@contact.com</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i> 012 345 678</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
              

                    <div class="listing-heading">
                      <h5><i class="fas fa-times"></i> Rechazados ({{$contador_rechazados}})</h5>
                    </div>
                    @if ($contador_rechazados==0)
                    <div class="listing listing-1">
                        <div class="listing-section">
                          <div class="listing-ver-3">
                             <center><h6>No tienes ninguna vacante rechazada</h6></center>
                          </div>
                        </div>
                      </div>
                    @else
                    <div class="listing listing-1">
                        <div class="listing-section">
                          <div class="listing-ver-3">
                            <div class="listing-heading">
                              <h5>Front-End Web Developer</h5>
                              <ul class="bookmark list-inline">
                                <li><a href="#"><i class="fa fa-bookmark"></i></a></li>
                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                <li><a href="#"><i class="fa fa-share"></i></a></li>
                              </ul>
                            </div>
                            <div class="listing-inner">
                              <div class="listing-content">
                                <h6 class="title-company">Mars Planet Telecommunications Inc.</h6>
                                <span class="location"> <i class="fa fa-map-marker"></i> Manhattan, New york, USA </span> <span class="type-work full-time"> Full Time </span>
                                <p>Proin gravida nibh vel velit auctor aliquet aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio pellentesque habitant morbi tristique senectus et netus et malesuada. <a href="single_job.html">read more</a></p>
                                <h6 class="title-tags">Habilidades requeridas:</h6>
                                <ul class="tags list-inline">
                                  <li><a href="#">Javascript</a></li>
                                  <li><a href="#">Wordpress</a></li>
                                  <li><a href="#">Presta</a></li>
                                  <li><a href="#">Sass</a></li>
                                </ul>
                              </div>
                            </div>
                            <div class="listing-tabs">
                              <ul>
                                <li><a href="#"><i class="fa fa-envelope"></i> honda@contact.com</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i> 012 345 678</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                    

                  </div>
                  
                  <!-- Contact -->
                  <div id="contact" class="tab-pane fade">
                    <div class="profile-main">
                      <h3>Contact the Company</h3>
                      <div class="profile-in">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate quis tenetur velit! Provident eum molestias aperiam suscipit distinctio ipsum cupiditate quasi, dolor sunt, cum reprehenderit quibusdam, repellendus eaque, quas magni.</p>
                        <form action="#">
                          <input type="text" placeholder="Name & Surname">
                          <input type="text" placeholder="E-mail address">
                          <input type="text" placeholder="Phone Number">
                          <textarea placeholder="Your Message"></textarea>
                          <button class="btn btn-primary">Send message</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Portfolio -->
                  <div id="portfolio" class="tab-pane fade">
                    <div class="profile-main">
                      <h3>Portfolio</h3>
                      <div class="profile-in">
                        <div class="uou-portfolio"> 
                          <!-- Portfolio Item -->
                          <section class="portfolio">
                            <div class="portfolio-filters-content"> 
                              <!-- Portfolio Item -->
                              <article class="development design"> <a href="/img/portfolio-1.jpg" class="swipebox"> <img src="img/portfolio-1.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="design"> <a href="img/portfolio-2.jpg" class="swipebox"> <img src="img/portfolio-2.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="development branding"> <a href="img/portfolio-3.jpg" class="swipebox"> <img src="img/portfolio-3.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="development design"> <a href="img/portfolio-6.jpg" class="swipebox"> <img src="img/portfolio-6.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="branding development"> <a href="img/portfolio-4.jpg" class="swipebox"> <img src="img/portfolio-4.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="mobile branding"> <a href="img/portfolio-5.jpg" class="swipebox"> <img src="img/portfolio-5.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="branding"> <a href="img/portfolio-7.jpg" class="swipebox"> <img src="img/portfolio-7.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="branding"> <a href="img/portfolio-2.jpg" class="swipebox"> <img src="img/portfolio-2.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                              <!-- Portfolio Item -->
                              <article class="design development"> <a href="img/portfolio-8.jpg" class="swipebox"> <img src="img/portfolio-8.jpg" alt="" class="work img-responsive"> <span class="overlay"> <i class="fa fa-plus"></i> <b class="title"><strong>Photo Session</strong>Brands</b> </span> </a> </article>
                            </div>
                          </section>
                        </div>
                        <!-- end uou-portfolio --> 
                      </div>
                    </div>
                  </div>
                  
                  <!-- Blog Post -->
                  <div id="blog-tab" class="tab-pane fade">
                    <div class="profile-main">
                      <h3>Blog Post</h3>
                      <div class="profile-in">
                        <div class="row">
                          <div class="col-md-12">
                            <article class="uou-block-7f"> <img src="img/blog-image-1.jpg" alt="" class="thumb">
                              <div class="meta"> <span class="time-ago">3 days ago</span> <span class="category">Posted in: <a href="#">Design</a></span> <a href="#" class="comments">12 Comments</a> </div>
                              <h1><a href="#">Perspiciatis Sint Pariatur Velit Corrupti</a></h1>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.</p>
                              <a href="#" class="btn btn-small btn-primary">Read More</a> </article>
                            <!-- end .uou-block-7f -->
                            
                            <article class="uou-block-7f"> <img src="img/blog-image-2.jpg" alt="" class="thumb">
                              <div class="meta"> <span class="time-ago">3 days ago</span> <span class="category">Posted in: <a href="#">Design</a></span> <a href="#" class="comments">12 Comments</a> </div>
                              <h1><a href="#">Perspiciatis Sint Pariatur Velit Corrupti</a></h1>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.</p>
                              <a href="#" class="btn btn-small btn-primary">Read More</a> </article>
                            <!-- end .uou-block-7f -->
                            
                            <article class="uou-block-7f"> <img src="img/blog-image-3.jpg" alt="" class="thumb">
                              <div class="meta"> <span class="time-ago">3 days ago</span> <span class="category">Posted in: <a href="#">Design</a></span> <a href="#" class="comments">12 Comments</a> </div>
                              <h1><a href="#">Perspiciatis Sint Pariatur Velit Corrupti</a></h1>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.</p>
                              <a href="#" class="btn btn-small btn-primary">Read More</a> </article>
                            <!-- end .uou-block-7f -->
                            
                            <article class="uou-block-7f"> <img src="img/blog-image-4.jpg" alt="" class="thumb">
                              <div class="meta"> <span class="time-ago">3 days ago</span> <span class="category">Posted in: <a href="#">Design</a></span> <a href="#" class="comments">12 Comments</a> </div>
                              <h1><a href="#">Perspiciatis Sint Pariatur Velit Corrupti</a></h1>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.</p>
                              <a href="#" class="btn btn-small btn-primary">Read More</a> </article>
                            <!-- end .uou-block-7f -->
                            
                            <article class="uou-block-7f"> <img src="img/blog-image-5.jpg" alt="" class="thumb">
                              <div class="meta"> <span class="time-ago">3 days ago</span> <span class="category">Posted in: <a href="#">Design</a></span> <a href="#" class="comments">12 Comments</a> </div>
                              <h1><a href="#">Perspiciatis Sint Pariatur Velit Corrupti</a></h1>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.
                                Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.</p>
                              <a href="#" class="btn btn-small btn-primary">Read More</a> </article>
                            <!-- end .uou-block-7f -->
                            
                            <div class="text-center pt20">
                              <ul class="uou-paginatin list-unstyled">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                        <!-- end row --> 
                        
                        <!-- end blog-content --> 
                        
                      </div>
                    </div>
                  </div>
                  
                  <!-- Blog Post -->
                  <div id="Con-tab" class="tab-pane fade">
                    <div class="profile-main">
                      <h3>Personas en Conexión</h3>
                      <div class="profile-in">
                        <div class="folow-persons">
                          <ul>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row">
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox1-1" class="styled" type="checkbox">
                                    <label for="checkbox1-1"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox1-2" class="styled" type="checkbox">
                                    <label for="checkbox1-2"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox1-3" class="styled" type="checkbox">
                                    <label for="checkbox1-3"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox1-4" class="styled" type="checkbox">
                                    <label for="checkbox1-4"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox1-5" class="styled" type="checkbox">
                                    <label for="checkbox1-5"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox1-6" class="styled" type="checkbox">
                                    <label for="checkbox1-6"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox1-7" class="styled" type="checkbox">
                                    <label for="checkbox1-7"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Blog Post -->
                  <div id="flowrs-tabs" class="tab-pane fade">
                    <div class="profile-main">
                      <h3>Seguidores</h3>
                      <div class="profile-in">
                        <div class="folow-persons">
                          <ul>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row">
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox2-1" class="styled" type="checkbox">
                                    <label for="checkbox2-1"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox2-2" class="styled" type="checkbox">
                                    <label for="checkbox2-2"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox2-3" class="styled" type="checkbox">
                                    <label for="checkbox2-3"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox2-4" class="styled" type="checkbox">
                                    <label for="checkbox2-4"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox2-5" class="styled" type="checkbox">
                                    <label for="checkbox2-5"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox2-6" class="styled" type="checkbox">
                                    <label for="checkbox2-6"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox2-7" class="styled" type="checkbox">
                                    <label for="checkbox2-7"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Blog Post -->
                  <div id="foll-tabs" class="tab-pane fade">
                    <div class="profile-main">
                      <h3>Siguiendo</h3>
                      <div class="profile-in">
                        <div class="folow-persons">
                          <ul>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row">
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox3-1" class="styled" type="checkbox">
                                    <label for="checkbox3-1"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox3-2" class="styled" type="checkbox">
                                    <label for="checkbox3-2"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox3-3" class="styled" type="checkbox">
                                    <label for="checkbox3-3"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox3-4" class="styled" type="checkbox">
                                    <label for="checkbox3-4"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox3-5" class="styled" type="checkbox">
                                    <label for="checkbox3-5"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox3-6" class="styled" type="checkbox">
                                    <label for="checkbox3-6"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                            
                            <!-- MEMBER -->
                            <li>
                              <div class="row"> 
                                <!-- Title -->
                                <div class="col-xs-4"> 
                                  <!-- Check Box -->
                                  <div class="checkbox">
                                    <input id="checkbox3-7" class="styled" type="checkbox">
                                    <label for="checkbox3-7"></label>
                                  </div>
                                  <!-- Name -->
                                  <div class="fol-name">
                                    <div class="avatar"> <img src="images/sm-avatar.jpg" alt=""> </div>
                                    <h6>Collin Weiland</h6>
                                    <span>Web Developer</span> </div>
                                </div>
                                <!-- Location -->
                                <div class="col-xs-3 n-p-r n-p-l"> <span>San Francisco, USA</span> </div>
                                <!-- Network -->
                                <div class="col-xs-3 n-p-r"> <span>21 Followers</span> <span>10 Following</span> </div>
                                <!-- Connections -->
                                <div class="col-xs-2 n-p-r n-p-l"> <span>31 Connections</span> </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection