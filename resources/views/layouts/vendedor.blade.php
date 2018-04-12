@extends('layouts.adminlte')


@section('dropmenu')
    
    <li><a href="/administrador/informacion"> Informacion</a></li>
    

@endsection

@section('sidebaruser')
    @parent
    <a href="#">{{Auth::user()->negocio->descripcion}}</a>
@endsection
@section('sidebar')
    <li><a href="/vendedor/productos"><i class="fa fa-shopping-bag "></i> <span>Productos</span></a></li>
    <li><a href="/vendedor/proveedores"><i class="fa fa-handshake-o"></i> <span>Proveedores</span></a></li>
    <Acordeonoportunidades url="vendedor" token="{{session('user_token')}}"></Acordeonoportunidades>
    <li><a href="/vendedor/cotizaciones"><i class="fa fa-file-word-o"></i> <span>Reportes</span></a></li>
    <li><a href="/vendedor/oportunidades/oportunidades" ><i class="fa fa-share-square-o"></i> Oportunidad</a></li>
@endsection

@section('content')

  @yield('content')
  
@endsection
