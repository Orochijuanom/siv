@extends('layouts.main')


@section('dropmenu')

  <li><a href="/empresas/informacion"> Informacion</a></li>

@endsection

@section('sidebar')
<li><a><i class="fa fa-home"></i> Inicio <span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href="/empresas">Inicio</a></li>
  </ul>
</li>
<li><a><i class="fa fa-edit"></i>Información Empresarial<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href=" /empresas/informacion">Información</a></li>
  </ul>
</li>
<li><a><i class="fa fa-user-circle-o"></i>Personas<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href=" /empresas/personas/all/buscador/none/">Buscar</a></li>
  </ul>
</li>
<li><a><i class="fa fa-money"></i>Ofertas<span class="fa fa-chevron-down"></span></a>
  <ul class="nav child_menu">
    <li><a href=" /empresas/ofertas">Ofertas</a></li>
  </ul>
</li>
@endsection

@section('content')

  @yield('content')
  
@endsection
