@extends('layouts.master-dashboard')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Examenes</h6>
        </div>
        <div class="container-fluid">
            <examenes-component :examenes="{{json_encode($examenes)}}"></examenes-component>
        </div>
    </div>
</div>
@endsection
