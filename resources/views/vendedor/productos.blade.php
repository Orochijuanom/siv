@extends('layouts.vendedor')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <Productos token="{{session('user_token')}}"></Productos>       
    </div>
</div>
@endsection
