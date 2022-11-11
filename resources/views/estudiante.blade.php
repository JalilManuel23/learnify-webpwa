@extends('layouts.master-dashboard')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Estudiantes</h6>
        </div>
    <div class="container-fluid">
        <estudiantes-component :estudiantes="{{json_encode($estudiantes)}}"></estudiantes-component>
    </div>
    </div>
</div>
@endsection
