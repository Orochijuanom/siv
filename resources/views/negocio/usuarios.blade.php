@extends('layouts.negocio') 
 
@section('content') 
<div class="container"> 
    <div class="row"> 
       <Users negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Users>  
    </div> 
</div> 
@endsection 