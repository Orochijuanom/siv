@extends('layouts.negocio')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <Productos negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Productos>       
    </div>
</div>
@endsection
