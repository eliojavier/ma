@extends('layouts.dashboard')

@section('title', 'Colaboradores')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s4">
                <form class="login-form card-panel hoverable" role="form" method="POST" action="{{ route('collaborators.store') }}">
                    {{ csrf_field() }}
                    @include('collaborators.partials._form',['submitButtonText' => 'Crear Colaborador'])
                </form>{{-- End form--}}

            </div>
            <div class="col s8">
                <table class="striped">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Bio</th>
                        <th>Categoría</th>
                        <th>Borrar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($collaborators as $collaborator)
                            <tr>
                                <td>
                                    <a href="{{route('collaborators.edit',$collaborator)}}">
                                        {{ $collaborator->complete_name }}

                                    </a>
                                </td>
                                <td>{{ $collaborator->bio }}</td>
                                <td>
                                    <p>
                                        {{ $collaborator->category['display_name'] }}
                                    </p>
                                </td>
                                <td>
                                    <form action="{{ url('collaborators',$collaborator) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Borrar
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $collaborators->links() }}
            </div>
        </div>
    </div>
@endsection