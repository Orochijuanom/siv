@extends('layouts.negocio')

@section('content')
<div class="container">
    <div class="row">
        <Empresas token="{{session('user_token')}}"></Empresas>       
    </div>
</div>
@endsection
