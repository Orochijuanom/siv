@extends('layouts.negocio')

@section('content')
    <div class="row page-titles">
        <div class="col-md-6 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Inicio</a></li>
                <li class="breadcrumb-item active">Agregar Empresa</li>
            </ol>
        </div>        
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-sm-12">
            <div class="card">
            <div class="card-block">        
                <Empresas token="{{session('user_token')}}"></Empresas>       
            </div>
        </div>
        </div>                                    
    </div>                
@endsection
