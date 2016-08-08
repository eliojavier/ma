@extends('layouts.dashboard')

@section('title', 'Usuarios')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Entradas</span>
                        <table class="striped">
                            <thead>
                            <tr>
                                <th data-field="title">Nombre de Usuario</th>
                                <th data-field="author">Correo</th>
                                <th data-field="category">Rol</th>
                                <th data-field="enterprise">Empresarial</th>
                                <th>Borrar</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user) }}">
                                            {{ $user->first_name . " " . $user->last_name }}
                                        </a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                            {{ $role->display_name }}
                                        @endforeach
                                    </td>
                                    <td>{{ $user->document }}</td>
                                    <td>
                                        <form action="{{ url('admin/users',$user) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Borrar Definitivamente
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
