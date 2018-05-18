@extends('layouts.negocio')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <Clientes token="{{session('user_token')}}"></Clientes>       
    </div>
</div>
@endsection