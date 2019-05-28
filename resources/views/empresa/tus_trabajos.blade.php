@extends('empresa.layout')
@section('titulo')
    Tus Trabajos
@endsection
@section('contenido')
   <!-- SUB Banner -->
   <div class="profile-bnr sub-bnr user-profile-bnr">
    <div class="position-center-center">
      <div class="container">
        <h2><i class="fas fa-clipboard-list"></i> Tus Trabajos</h2>
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
              <button>Buscar Trabajo</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Members -->
  <section class="pro-mem">
    <div class="container pb30">
      <h3>Tu lista de trabajos</h3>
      <div class="row">
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-1.png" alt="">
            <a href="/empresa_vacante"><h6>Jessica Walsh</a> <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-2.png" alt="">
            <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-2.png" alt="">
            <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-3.png" alt="">
            <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-1.png" alt="">
            <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-1.png" alt="">
            <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-2.png" alt="">
            <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-2.png" alt="">
            <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
            <p><i class="fa fa-map-marker"></i> New York, USA</p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
      </div>
    </div>
  </section>
</div>
  
@endsection
