@extends('layouts.dashboard')

@section('title', 'Categorias')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Categorías</span>
                        <table class="striped">
                            <thead>
                            <tr>
                                <th data-field="title">Nombre</th>
                                <th data-field="author">Descripción</th>
                                <th data-field="slug">slug</th>
                                <th data-field="tags">Tags</th>
                                <th data-field="delete">Borrar</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $category) }}">
                                            {{ $category->display_name }}
                                        </a>
                                    </td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @foreach($category->tags as $tag)
                                            <a href="">
                                                {{  $tag->display_name }}
                                            </a>
                                        @endforeach

                                    </td>
                                    <td>
                                        <form action="{{ url('admin/categories',$category) }}" method="POST">
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
