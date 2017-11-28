@extends('layouts.negocio')

@section('content')
<div class="container">
    <div class="row">
        <Productos negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Productos>       
    </div>
</div>
@endsection
