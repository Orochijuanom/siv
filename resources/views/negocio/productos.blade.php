@extends('layouts.negocio')

@section('content')
<div class="card">
    <div class="card-block">        
        <Productos token="{{session('user_token')}}"></Productos>       
    </div>
</div>
@endsection
