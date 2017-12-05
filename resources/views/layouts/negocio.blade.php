@extends('layouts.adminlte')


@section('dropmenu')
    
    <li><a href="/administrador/informacion"> Informacion</a></li>
    

@endsection

@section('sidebaruser')
    @parent
    <a href="#">{{Auth::user()->negocio->descripcion}}</a>
@endsection
@section('sidebar')
    
    <li><a href="/negocio"><i class="fa fa-home"></i> <span>Usuarios</span></a></li>
    <li><a href="/negocio/empresas"><i class="fa fa-building-o"></i> <span>Empresas</span></a></li>
    <li><a href="/negocio/proveedores"><i class="fa fa-handshake-o"></i> <span>Proveedores</span></a></li>
    <li><a href="/negocio/productos"><i class="fa fa-shopping-bag "></i> <span>Productos</span></a></li>
    <li class="treeview">
        <a href="#">
        <i class="fa fa-bar-chart-o"></i> <span>Cotizaciones</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="/negocio/oportunidades/abiertas"><i class="fa fa-circle-o text-red"></i> Pendientes
            <span class="pull-right-container">
              <span class="label pull-right bg-red">4</span>
            </span>
        </a></li>
        <li><a href="/negocio/oportunidades/seguimiento"><i class="fa fa-circle-o text-yellow"></i> Seguimientos
            <span class="pull-right-container">
              <span class="label pull-right bg-yellow">4</span>
            </span>
        </a></li>
        <li><a href="/negocio/oportunidades/cerradas"><i class="fa fa-circle-o text-green"></i> Cerradas
            <span class="pull-right-container">
              <span class="label pull-right bg-green">4</span>
            </span>
        </a></li>
        
        </ul>
    </li>
    <li><a href="/negocio/cotizaciones"><i class="fa fa-file-word-o"></i> <span>Reportes</span></a></li>
    
   
@endsection

@section('content')

  @yield('content')
  
@endsection
