@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <form class="login-form card-panel hoverable" role="form" method="POST" action="{{ route('admin.users.update',$user) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @include('users.partials._form',['submitButtonText' => 'Editar Usuarios','icon' => 'fa-edit'])
                </form>{{-- End form--}}

            </div>
        </div>
    </div>
@endsection