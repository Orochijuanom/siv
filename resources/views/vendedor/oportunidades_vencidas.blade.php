@extends('layouts.vendedor')
@section('content')
<div class="row">
    <div class="col-xs-12">
       <Oportunidadesvencidas negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Oportunidadesvencidas>  
    </div> 
</div> 
@endsection 