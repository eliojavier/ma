@extends('layouts.errors')

@section('title','404')

@section('nav')
    @include('layouts.partials._nav')
@endsection

@section('content')
    <div class="container" style="min-height: 200px;margin-top: 100px">
        <div class="content">
            <h1>Ups!</h1>
        </div>
    </div>
@endsection

