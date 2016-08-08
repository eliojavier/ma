@extends('layouts.dashboard')

@section('title', 'Colaboradores')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <form class="login-form card-panel hoverable" role="form" method="POST" action="{{ route('collaborators.update',$collaborator) }}">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @include('collaborators.partials._form',['submitButtonText' => 'Editar Colaborador','icon' => 'fa-edit'])
                </form>{{-- End form--}}

            </div>
        </div>
    </div>
@endsection