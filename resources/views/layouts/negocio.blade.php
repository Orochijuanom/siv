@extends('layouts.main')


@section('dropmenu')
    
    <li><a href="/administrador/informacion"> Informacion</a></li>
    

@endsection

@section('sidebar')
    <h3>{{Auth::user()->negocio->descripcion}}</h3>
    <nav class="sidebar-nav">
        <ul id="sidebarnav">                      
            <li><a href="/negocio" class="waves-effect"><i class="fa fa-home" aria-hidden="true"></i> Usuarios</a></li>
            <li><a href="/negocio/empresas" class="waves-effect"><i class="fa fa-building-o" aria-hidden="true"></i> Empresas</a></li>
            <li><a href="/negocio/proveedores" class="waves-effect"><i class="fa fa-handshake-o" aria-hidden="true"></i> Proveedores</a></li>
            <li><a href="/negocio/productos" class="waves-effect"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Productos</a></li>
            <li><a href="/negocio/oportunidades/abiertas" class="waves-effect"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> Cotizaciones</a></li>
            <li><a href="/negocio/cotizaciones" class="waves-effect"><i class="fa fa-file-word-o" aria-hidden="true"></i> Reportes</a></li>
        </ul>                    
    </nav>
@endsection

@section('content')

  @yield('content')
  
@endsection
