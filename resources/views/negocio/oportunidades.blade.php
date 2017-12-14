@extends('layouts.negocio') 

 
@section('content') 
<div class="row">
    <div class="col-xs-12">
        
       <Oportunidadescom urll="{{env('APP_URL')}}" negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Oportunidadescom>        
    </div> 
</div> 
@endsection 