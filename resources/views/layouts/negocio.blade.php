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
    <li><a href="/negocio/productos"><i class="fa fa-shopping-bag "></i> <span>Productos</span></a></li>
    <li><a href="/negocio/proveedores"><i class="fa fa-handshake-o"></i> <span>Proveedores</span></a></li>
    <Acordeonoportunidades url="negocio" token="{{session('user_token')}}"></Acordeonoportunidades>
    <li><a href="/negocio/cotizaciones"><i class="fa fa-file-word-o"></i> <span>Reportes</span></a></li>
    <li><a href="/negocio/oportunidades/oportunidades" ><i class="fa fa-share-square-o"></i> Oportunidad</a></li>
@endsection

@section('content')

  @yield('content')
  
@endsection
