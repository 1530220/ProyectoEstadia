@extends('empresa.layout')
@section('titulo')
    Perfil Empresa
@endsection
@section('contenido')
<div class="compny-profile"> 
    <!-- SUB Banner -->
    <div class="profile-bnr">
      <div class="container"> 
        <!-- User Iinfo -->
        <div class="user-info">
          @foreach ($companies as $company)
        <h1><i class="fas fa-building"></i> {{$company->name}} <a data-toggle="tooltip" data-placement="top" title="Verified Member"><img src="/images/icon-ver.png" alt="" ></a> </h1>
          <h6>Sector: Automotriz</h6>
          <p>Dirección: {{$company->street}}, {{$company->state}} {{$company->zip}}  <!--a href="#.">map</a> / <a href="#.">street</a>)</p-->
          @endforeach
          <!-- Social Icon -->
          <!--div class="social-links"> <a href="#."><i class="fa fa-facebook"></i></a> <a href="#."><i class="fa fa-twitter"></i></a> <a href="#."><i class="fa fa-google"></i></a> <a href="#."><i class="fa fa-linkedin"></i></a> </div-->
          
          <!-- Stars -->
          <ul class="row">
            <li class="col-sm-6">
              <!--div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span>(06)</span> </div-->
            </li>
            <li class="col-sm-6">
              <!--p><i class="fa fa-bookmark-o"></i> 28 Bookmarks</p-->
            </li>
          </ul>
          
          <!-- Followers -->
          <div class="followr">
            <ul class="row">
              <li class="col-sm-6">
                <p>Seguidores <span>(31)</span></p>
              </li>
              <li class="col-sm-6">
                <p>Siguiendo <span>(38)</span></p>
              </li>
            </ul>
          </div>
        </div>
        
        <!-- Top Riht Button -->
        <div class="right-top-bnr">
          <!--div class="connect"> <a href="#." data-toggle="modal" data-target="#myModal"><i class="fa fa-user-plus"></i> Conectar</a--> <!--a href="#."><i class="fa fa-share-alt"></i> Share</a-->
            <div class="bt-ns"> <!--a href="#."><i class="fa fa-bookmark-o"></i> </a> <a href="#."><i class="fa fa-envelope-o"></i> </a> <a href="#."><i class="fa fa-exclamation"></i> </a--> </div>
          </div>
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
    <div class="profile-company-content main-user" data-bg-color="f5f5f5">
      <div class="container">
        <div class="row"> 
            <div class="col-md-12 ">
                <ul class="nav nav-tabs">
                    <li class="active"><a><i class="fas fa-suitcase"></i> Añadir Vacantes</a></li>
                </ul>
            </div>
          <!-- SIDE BAR -->
          <div class="col-md-4"> 
            
            <!-- Company Information -->
            <div class="sidebar">
              <h5 class="main-title">Información de la Empresa</h5>
              @foreach ($companies as $company)
              <div class="sidebar-thumbnail"> <img src="{{asset($company->image_url)}}" alt=""  width="251px" height="181px"> </div>
              @endforeach
              <div class="sidebar-information">
                <ul class="single-category">
                  <li class="row">
                    <h6 class="title col-xs-6">Sector</h6><br>
                    @foreach ($companies as $company)
                    <li class="row">
                      <h6 class="title col-xs-6">Localización</h6>
                      <span class="subtitle col-xs-6">{{$company->city}}, {{$company->country}}</span> </li><br>
                    <li class="row">
                      <h6 class="title col-xs-6">RFC</h6>
                      <span class="subtitle col-xs-6">{{$company->rfc}}</span> </li><br>
                    <li class="row">
                      <h6 class="title col-xs-6">Horario</h6>
                      <span class="subtitle col-xs-6">{{$company->schedule}}</span> </li><br>
                    <li class="row">
                      <h6 class="title col-xs-6">Telefono</h6>
                      <span class="subtitle col-xs-6">{{$company->phone}}</span> </li><br>
                    </li>
                    <li class="row">
                      <h6 class="title col-xs-6">Correo Electrónico</h6>
                      <span class="subtitle col-xs-6">{{$company->email}}</span> </li><br>
                    </li>
                    @endforeach
                </ul>
              </div>
            </div>
            
          </div>
          
          <!-- Tab Content -->
          <div class="col-md-8">
              <!-- Añadir Vacantes -->
<div  class="tab-pane fade">
  <div class="form-row">
    <div class="form-group col-md-6">
    <h3>Añadir Vacante</h3>
    </div>
    </div>

      <div class="form-row">
      <div class="form-group col-md-12">
      <p>Aquí puedes agregar tus vacantes</p>
      </div>
      </div>

      @foreach($companies as $company)
      <form method="POST"  action="/agregar_vacante/{{$company->id}}" >
        {{ csrf_field() }}
        <div class="form-row">
                <div class="form-group col-md-12">
                <input class="form-control" type="text" placeholder="Nombre de la vacante" style="color:black" name="name" required>
                </div>
                </div>
                
                <div class="form-row">
                <div class="form-group col-md-12">
                <textarea rows="15" cols="50" class="form-control" type="text" placeholder="Descripción de la vacante" maxlength="1000" style="color:black" name="description" required></textarea>
                </div>
                </div>
                
                <div class="form-row">
                <div class="form-group col-md-6">
                <input class="form-control" type="text" placeholder="Salario" style="color:black" name="salary">
                </div>
                <div class="form-group col-md-6">
                <input class="form-control" type="text" placeholder="Tipo de vacante" style="color:black" name="job_type" required>
                </div>
                </div>
        
                <div class="form-row">
                <div class="form-group col-md-6">
                {!! Form::select('country',$countries,null,['id'=>'country','class'=>'form-control','style'=>'color:black']) !!}
                                    @if ($errors->has('country'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('country')}}</div>
                                    @endif
                </div>
                <div class="form-group col-md-6">
                {!! Form::select('state',['placeholder'=>'Favor de seleccionar un país'],null,['id'=>'state','class'=>'form-control','style'=>'color:black']) !!}
                                    @if ($errors->has('state'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('state')}}</div>
                                    @endif
                </div> 
                 
                </div>
                
                  
                <div class="form-row">
                <div class="form-group col-md-12">
                {!! Form::select('city',['placeholder'=>'Favor de seleccionar un estado'],null,['id'=>'city','class'=>'form-control','style'=>'color:black']) !!}
                                    @if ($errors->has('city'))
                                        <div class="col-form-label" style="color:red;">{{$errors->first('city')}}</div>
                                    @endif
                </div>
                 
                </div>
							
                 
        
                <div class="form-row">
                <div class="form-group col-md-6">
                <input class="form-control" type="text" placeholder="Codigo Postal" style="color:black" name="zip" required>
                </div>
                <div class="form-group col-md-6">
                <input class="form-control" type="text" placeholder="Colonia" style="color:black" name="colony" required>
                </div>
                </div>
        
                <div class="form-row">
                <div class="form-group col-md-12">
                <input class="form-control" type="text" placeholder="Calle" style="color:black" name="street" required>
                </div>
                </div>
        
                <div class="form-row">
                <div class="form-group col-md-6">
                <input class="form-control" type="text" name="sector_name" placeholder="Sector" list="sector_names" style="color:black" required>
                <datalist id="sector_names">
                  @foreach ($sectors as $sector)
                   <option value="{{$sector->name}}">
                  @endforeach
                </datalist>
                </div>
                <div class="form-group col-md-6">
                <input class="form-control" type="hidden" placeholder="Nombre de la empresa" style="color:black" name="id_company" value="{{$company->id}}">
                </div>
                </div>
                <div class="form-group col-md-6">
                <input class="form-control" type="hidden" placeholder="Borrado" style="color:black" name="deleted" value="0">
                </div>
        <div class="form-row">
                <div class="form-group col-md-12">
                <select class="form-control" type="text" name="id_contact" title="Contactos de la empresa" style="color:black" required>
                  @foreach ($contacts as $contact)
                  <option value="{{$contact->id}}">{{$contact->first_name}} {{$contact->last_name}} {{$contact->second_last_name}}</option>
                  @endforeach
                  </select>
                </div>
        </div>
        
        <div class="form-row">
        <div class="form-group col-md-12">
        <center><button type="submit" class="btn btn-primary">Agregar Vacante</button></center>
        </div>
        </div>

        <div class="form-row">
        <div class="form-group col-md-1">
        <center><a href="/perfil_empresa/{{$company->id}}"><button type="button" class="btn btn-secondary">Regresar Perfil</button></a></center>
        </div>
        </div>
        @endforeach
      </form>
      </div>

            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection