@extends('layouts.master-dashboard')
@section('content')
    <div class="container-fluid">
        <usuarios-component :usuarios="{{json_encode($usuarios)}}"></usuarios-component>
    </div>
@endsection
