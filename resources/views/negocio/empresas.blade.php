@extends('layouts.negocio')

@section('content')
<div class="container">
    <div class="row">
        <Empresas negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Empresas>       
    </div>
</div>
@endsection
