@extends('layouts.negocio')

@section('content')
<div class="container">
    <div class="row">
        <Productos token="{{session('user_token')}}"></Productos>       
    </div>
</div>
@endsection
