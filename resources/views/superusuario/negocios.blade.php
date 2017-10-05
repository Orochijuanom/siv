@extends('layouts.super')

@section('content')
<div class="container">
    <div class="row">
       <Negocios token="{{session('user_token')}}"></Negocios>       
    </div>
</div>
@endsection
