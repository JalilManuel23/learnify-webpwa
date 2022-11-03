@extends('layouts.master-dashboard')
@section('content')
    <div class="container-fluid">
        <roles-component :roles="{{json_encode($roles)}}"></roles-component>
    </div>
@endsection
