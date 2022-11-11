@extends('layouts.master-dashboard')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cursos</h6>
        </div>
        <div class="container-fluid">
            <cursos-component :cursos="{{json_encode($cursos)}}"></cursos-component>
        </div>
    </div>
</div>
@endsection
