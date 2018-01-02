@extends('layouts.negocio')
@section('content')
<div class="row">
    <div class="col-xs-12">
       <Oportunidadesabiertas negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Oportunidadesabiertas>  
    </div> 
</div> 
@endsection 