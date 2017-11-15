@extends('layouts.negocio') 
@section('content') 
<div class="card">
    <div class="card-block">        
       <Oportunidadesabiertas negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Oportunidadesabiertas>  
    </div>
</div>
@endsection 