@extends('layouts.dashboard')

@section('title', 'Categorias')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Etiquetas</span>
                        <table class="striped">
                            <thead>
                            <tr>
                                <th data-field="title">Nombre</th>
                                <th data-field="slug">slug</th>
                                <th data-field="category">Categoría</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.tags.edit', $tag) }}">
                                            {{ $tag->display_name }}
                                        </a>
                                    </td>
                                    <td>{{ $tag->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $tag->category) }}">
                                            {{$tag->category['display_name']}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $tags->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
