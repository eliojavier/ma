@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('nav')
    @include('layouts.partials._nav')
@endsection


@section('content')
<div class="container" style="margin-top: 35px">
    <div class="row">
        <div class="col s8 offset-m2">
            <form class="card-panel hoverable" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-field col s12">
                    <label for="email">Dirección de correo</label>
                    <input class="validate {{ $errors->has('email') ? ' has-error' : '' }}"
                           id="email" type="email"
                           name="email"
                           value="{{ $email or old('email') }}">
                    @if ($errors->has('email'))
                        <span class="has-error">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="input-field col s12">
                    <label for="password">Confirmar Contraseña</label>
                    <input class="validate {{ $errors->has('password') ? ' has-error' : '' }}"
                           id="password"
                           type="password"
                           name="password">
                    @if ($errors->has('password'))
                        <span class="has-error">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="input-field col s12">
                    <label for="password-confirm">Confirmar Contraseña</label>
                    <input class="validate {{ $errors->has('password_confirmation') ? ' has-error' : '' }}"
                           id="password-confirm"
                           type="password"
                           name="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                        <span class="has-error">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>

                    <div class="row">
                        <div class="input-field col m6 offset-m4">
                            <button type="submit" class="btn waves-effect waves-light">
                                <i class="fa fa-btn fa-refresh"></i> Cambiar Contraseña
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
