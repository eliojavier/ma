@extends('layouts.dashboard')

@section('title', 'Crear Categorias')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Crear Categoría</span>
                        <form role="form" method="POST" action="{{ route('admin.categories.store') }}">
                            @include('categories.partials._form',['submitButtonText' => 'Crear Categorías'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
