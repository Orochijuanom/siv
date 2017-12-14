@extends('layouts.negocio')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <Proveedores token="{{session('user_token')}}"></Proveedores>       
    </div>
</div>
@endsection
