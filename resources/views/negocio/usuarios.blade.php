@extends('layouts.negocio') 
 
@section('content') 
<div class="row">
    <div class="col-xs-12">
       <Users negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Users>  
    </div> 
</div> 
@endsection 