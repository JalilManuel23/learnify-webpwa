@extends('layouts.master-dashboard')
@section('content')
    <div class="container-fluid">
        <estudiantes-component :estudiantes="{{json_encode($estudiantes)}}"></estudiantes-component>
    </div>
@endsection
