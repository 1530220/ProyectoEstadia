@extends('empresa.layout')
@section('titulo')
    Egresados Empresa
@endsection

@section('contenido')
      <!-- SUB Banner -->
  <div class="profile-bnr sub-bnr user-profile-bnr">
    <div class="position-center-center">
      <div class="container">
        <h2><i class="fas fa-user-graduate"></i> Egresados</h2>
      </div>
    </div>
  </div>
  
  <!-- search -->
  {!! Form::open(['route' => 'users', 'method' => 'GET']) !!}
  <div class="search-pro">
    <div class="map-search">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="map-search-fields">
                  <div class="field">
                    {{ Form::text('university_id', null, ['list'=>'university_id','placeholder' => 'Buscar matricula']) }}
                      <datalist id="university_id">
                       @foreach ($students as $student)
                        <option value="{{$student->university_id}}">
                       @endforeach
                      </datalist>
                  </div>
                  <div class="field">
                    {{ Form::text('abbreviation', null, ['list'=>'abbreviation','placeholder' => 'Buscar carrera']) }}
                      <datalist id="abbreviation">
                       @foreach ($careers as $career)
                        <option value="{{$career->abbreviation}}">
                       @endforeach
                      </datalist>
                  </div>
            </div>
            <div class="search-button">
              <button type="submit">Buscar Egresado</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
  <!-- Members -->
  <section class="pro-mem">
    <div class="container pb30">
      <h3>Lista de Egresados</h3>
      {{ $users->render() }}
      <div class="row">
        @foreach ($users as $user)  
        <div class="col-sm-3">
          <div class="uou-block-6a"> <img src="images/member-1.png" alt="">
          <a href="/egresado/{{$user->user_id}}"><h6>{{$user->first_name}}</a> <span>Matrícula: {{$user->university_id}}</span><span>Carrera: {{$user->abbreviation}}</span></h6>
            <p></p>
          </div>
          <!-- end .uou-block-6a --> 
        </div>
        @endforeach
        
      </div>
    </div>
  </section>
</div>
@endsection
