@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <form class="login-form card-panel hoverable" role="form" method="POST" action="{{ route('admin.users.store') }}">
                    {{ csrf_field() }}
                    @include('users.partials._form',['submitButtonText' => 'Crear Usuarios'])
                </form>{{-- End form--}}

            </div>
        </div>
    </div>
@endsection