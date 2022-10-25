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
        <ejemplo-component 
            title="Ejemplo en Vue 2 "
            body="Body de la card en Vue ..... Ejemplo 2"
        >
        </ejemplo-component>

        <usuarios-component :usuarios="{{json_encode($usuarios)}}"></usuarios-component>
    </div>
@endsection
