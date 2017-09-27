@extends('layouts.main')


@section('dropmenu')

  <li><a href="/administrador/informacion"> Informacion</a></li>

@endsection

@section('sidebar')
<li><a><i class="fa fa-home"></i> Clientes <span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href="/administrador/clientes">Clientes</a></li>
  </ul>
</li>

@endsection

@section('content')

  @yield('content')
  
@endsection
