@extends('layouts.negocio') 
 
@section('content') 
<div class="container"> 
    <div class="row"> 
       <Oportunidadesabiertas negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Oportunidadesabiertas>  
    </div> 
</div> 
@endsection 