@extends('layouts.super')

@section('content')
<div class="container">
    <div class="row">
        <Proveedores token="{{session('user_token')}}"></Proveedores>       
    </div>
</div>
@endsection
