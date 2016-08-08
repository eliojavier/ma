@extends('layouts.dashboard')

@section('title', 'Editar Categorias')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Crear Categoría</span>
                        <form role="form" method="POST" action="{{ route('admin.categories.update',$category) }}">
                            {{ method_field('PATCH') }}
                            @include('categories.partials._form',['submitButtonText' => 'Editar Categorías','icon' => 'fa-edit'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
