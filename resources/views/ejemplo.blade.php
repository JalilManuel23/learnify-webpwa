@extends('layouts.master-dashboard')
@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ejemplo</h6>
            </div>
            <div class="card-body">
            </div>
        </div>
        <ejemplo-component 
            title="Ejemplo en Vue"
            body="Body de la card en Vue"
        >
        </ejemplo-component>
    </div>
@endsection
