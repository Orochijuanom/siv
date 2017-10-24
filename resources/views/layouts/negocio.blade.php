@extends('layouts.main')


@section('dropmenu')
    
    <li><a href="/administrador/informacion"> Informacion</a></li>
    

@endsection

@section('sidebar')
    <h3>{{Auth::user()->negocio->descripcion}}</h3>
    <ul class="nav side-menu">
        <li><a href="/negocio"><i class="fa fa-home"></i> Usuarios</a></li>
        <li><a href="/negocio/empresas"><i class="fa fa-building-o"></i> Empresas</a></li>
        <li><a href="/negocio/proveedores"><i class="fa fa-handshake-o"></i> Proveedores</a></li>
        <li><a href="/negocio/productos"><i class="fa fa-shopping-bag "></i> Productos</a></li>
        <li><a><i class="fa fa-bar-chart-o"></i> Cotizaciones <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
            <li><a href="/negocio/oportunidades/abiertas">Cerradas</a></li>
            <li><a href="/negocio/oportunidades/cerradas">Pendientes</a></li>
            <li><a href="/negocio/oportunidades/seguimiento">Seguimientos</a></li>
            </ul>
        </li>
        <li><a href="/negocio/cotizaciones"><i class="fa fa-file-word-o"></i> Reportes</a></li>
    </ul>
@endsection

@section('content')

  @yield('content')
  
@endsection
