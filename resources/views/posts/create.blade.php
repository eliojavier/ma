@extends('layouts.dashboard')

@section('title', 'Crear Entradas')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Añadir nueva entrada</span>
                        <form enctype="multipart/form-data" role="form" method="POST" action="{{ url('admin/posts') }}">
                            @include('posts.partials._form',['submitButtonText' => 'Crear Entradas'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-script-end')
    <script src="//cdn.ckeditor.com/4.5.9/standard/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>
        $('#body').ckeditor();
    </script>
@endsection
