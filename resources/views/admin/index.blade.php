@extends('layouts.dashboard')

@section('title', 'Escritorio')

@section('content')
    <h1 class="page-title">Bienvenido: {{ Auth::user()->first_name ." ". Auth::user()->last_name }}</h1>
@endsection
