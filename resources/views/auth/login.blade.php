@extends('layouts.app')

@section('title', 'Ingresar')

@section('nav')
    @include('layouts.partials._nav')
@endsection


@section('content')
<div class="container">
    <div class="row" style="margin-top: 60px">
        <div class="col s8 offset-m2">
            <a href="{{ url('/login/facebook') }}" class="btn waves-effect waves-light col s12 facebook-button">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                Ingresa con tu cuenta de Facebook
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col s8 offset-m2" >

            <form class="card-panel hoverable" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                @include('auth.partials._login')
            </form>

        </div>
    </div>
</div>
@endsection
