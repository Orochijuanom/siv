@extends('layouts.main')


@section('dropmenu')
  
  <li><a href="/administrador/informacion"> Informacion</a></li>
  

@endsection

@section('sidebar')
  <h3>SIV</h3>
  <ul class="nav side-menu">
    <li><a><i class="fa fa-home"></i> Administadores <span class="fa fa-chevron-down"></span></a>
      <ul class="nav child_menu">
        <li><a href="/superusuario/administradores">Administradores</a></li>
      </ul>
    </li>
  </ul>

@endsection

@section('content')

  @yield('content')
  
@endsection
