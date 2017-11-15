@extends('layouts.negocio')

@section('content')
<div class="card">
    <div class="card-block">        
        <Proveedores token="{{session('user_token')}}"></Proveedores>       
    </div>
</div>
@endsection
