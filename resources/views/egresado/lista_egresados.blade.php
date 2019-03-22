@extends('egresado.layout')
@section('titulo')
    Lista de egresados
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
      {!! Form::open(['route' => 'students_upv', 'method' => 'GET']) !!}
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
      <div class="users">
      <section class="pro-mem">
        <div class="container pb30">
          <h3>Lista de Egresados</h3>
          @if($students_count==1)
          <label>* Se encontró un {{$students_count}} alumno</label>
          @else
          <label>* Se encontraron {{$students_count}} alumnos</label>
          @endif
          <div class="row">
              
              @foreach ($students_upv as $student_upv)
              <div class="col-sm-3">
                <div class="uou-block-6a"> <img src="{{ asset($student_upv->image_url)}}" alt="{{$student_upv->first_name}}"  style="width:100%;max-width:275px;height:100%;max-height:200px;">
                  @if (auth()->user()->id != $student_upv->user_id)
                    <a href="/perfil_usuario/{{$student_upv->user_id}}"><h6>{{$student_upv->first_name}}</a> <span>Matrícula: {{$student_upv->university_id}}</span><span>Carrera: {{$student_upv->abbreviation}}</span></h6>
                  @else
                    <a href="/perfil_egresado/{{$student_upv->user_id}}"><h6>{{$student_upv->first_name}}</a> <span>Matrícula: {{$student_upv->university_id}}</span><span>Carrera: {{$student_upv->abbreviation}}</span></h6>
                  @endif
                  
                </div>
                <!-- end .uou-block-6a --> 
              </div> 
              @endforeach
              
              <div class="row"></div>
          </div>
        </div>
      </section>
      </div>
    </div>        
@endsection