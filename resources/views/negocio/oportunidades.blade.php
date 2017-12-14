@extends('layouts.negocio') 

 
@section('content') 
<div class="container"> 
       <Oportunidadescom negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Oportunidadescom>        
    </div> 
</div> 
@endsection 