@extends('layouts.negocio') 
 
@section('content') 
<div class="row">
    <div class="col-xs-12">
       <Users token="{{session('user_token')}}"></Users>  
    </div> 
</div> 
@endsection 