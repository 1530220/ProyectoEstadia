@extends('egresado.layout')
@section('titulo')
    Lista de trabajos
@endsection
@section('contenido')
    <!-- SUB Banner -->
  <div class="profile-bnr sub-bnr user-profile-bnr">
        <div class="position-center-center">
          <div class="container">
            <h2><i class="fas fa-clipboard-list"></i> Empresas</h2>
          </div>
        </div>
      </div>
      
      <!-- search -->
      <div class="search-pro">
        <div class="map-search">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                
                <div class="map-search-fields">
                  <div class="field">
                    <input type="text" placeholder="Buscar por habilidad">
                  </div>
                  <div class="field">
                    <input type="text" placeholder="Buscar por nombre">
                  </div>
                  <div class="field custom-select-box">
                    <input type="text" placeholder="Buscar por sector">
                  </div>
                </div>
                <div class="search-button">
                  <button>Buscar Trabajos</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Members -->
      <section class="pro-mem">
        <div class="container pb30">
          <h3>Lista de Empresas</h3>
          <div class="row">
            @foreach ($companies as $company)
              <div class="col-sm-3">
                <div class="uou-block-6a"> <img src="{{ asset($company->image_url)}}" alt="{{$company->name}}" style="width:100%;max-width:275px;height:100%;max-height:200px;">
                <a href="/egresado_perfil_empresa/{{$company->id}}"><h6><i class="fas fa-building"></i> {{$company->name}}</a></h6>
                <p><i class="fas fa-map-marked"></i> {{$company->city_name}}, {{$company->country_name}}</p>
                </div>
                <!-- end .uou-block-6a --> 
              </div>
            @endforeach
          </div>
        </div>
      </section>
    </div>
@endsection