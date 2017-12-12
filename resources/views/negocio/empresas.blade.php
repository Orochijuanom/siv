@extends('layouts.negocio')
@section('content')
<div class="row">
    <div class="col-xs-12">
        <Empresas negocio="{{Auth::user()->negocio_id}}" token="{{session('user_token')}}"></Empresas>
    </div>
</div>       


@endsection
