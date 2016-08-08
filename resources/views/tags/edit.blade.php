@extends('layouts.dashboard')

@section('title', 'Editar Etiquetas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Crear Etiqueta</span>
                        <form role="form" method="POST" action="{{ route('admin.tags.update',$tag) }}">
                            {{ method_field('PATCH') }}
                            @include('tags.partials._form',['submitButtonText' => 'Editar Etiquetas','icon' => 'fa-edit'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
