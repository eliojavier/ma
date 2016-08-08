@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('nav')
@include('layouts.partials._nav')
@endsection

<!-- Main Content -->
@section('content')
<div class="container" style="margin-top: 35px">
    <div class="row">
        <div class="col s8 offset-m2">
            <div class="card-panel hoverable">
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="input-field col s12">
                            <label for="email">Dirección de correo</label>

                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="validate {{ $errors->has('email') ? ' has-error' : '' }}">

                            @if ($errors->has('email'))
                                <span class="has-error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="input-field col s12 left-align">
                            <button type="submit" class="btn waves-effect waves-light">
                                <i class="fa fa-btn fa-envelope"></i>  Enviar Link
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
