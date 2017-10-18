@extends('layouts.noauth') 
 
@section('content') 
<div class="container"> 
    <div class="row"> 
       <Oportunidades v-bind:negocio="{{$negocio}}" token="{{session('user_token')}}"></Oportunidades>        
    </div> 
</div> 
@endsection 