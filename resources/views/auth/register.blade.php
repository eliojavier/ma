@extends('layouts.app')

@section('title', 'Registrarse')

@section('nav')
    @include('layouts.partials._nav')
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="register top">
                <div class="halo center-align">
                    <img class="responsive-img" src="{{ asset('img/LogoBig.png') }}" alt="Motivapp logo">
                </div>
                @include('auth.partials._register')
            </div>
        </div>
    </div>
</div>
@endsection
