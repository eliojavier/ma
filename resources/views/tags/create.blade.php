@extends('layouts.dashboard')

@section('title', 'Crear Etiquetas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Crear Etiquetas</span>
                        <form role="form" method="POST" action="{{ route('admin.tags.store') }}">
                            @include('tags.partials._form',['submitButtonText' => 'Crear Etiquetas'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
