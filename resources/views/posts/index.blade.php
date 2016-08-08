@extends('layouts.dashboard')

@section('title', 'Entradas')

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
                                <th data-field="title">Título</th>
                                <th data-field="author">Autor</th>
                                <th data-field="category">Categorías</th>
                                <th data-field="tags">Etiquetas</th>
                                <th data-field="publish_date">Fecha</th>
                                <th data-field="erase">Borrar</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post) }}">
                                            {{ $post->title }}
                                        </a>
                                    </td>
                                    <td>{{ $post->author }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit', $post->category) }}">
                                            {{$post->category['display_name']}}
                                        </a>
                                    </td>
                                    <td>

                                        @foreach($post->tags as $tag)
                                            <a href="{{ route('admin.tags.edit', $tag) }}">
                                                {{ $tag->display_name }}
                                            </a>
                                        @endforeach
                                    </td>
                                    <td>{{ $post->published_date->format('d-m-Y') }}</td>
                                    <td>
                                        {{--<a class="waves-effect waves-light btn modal-trigger" href="#delete">Borrar</a>--}}
                                        <form action="{{ url('admin/posts',$post) }}" method="POST">
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
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('before-script-begin')

    {{--<!-- Modal Structure -->--}}
    {{--<div id="delete" class="modal">--}}
        {{--<div class="modal-content cen">--}}
            {{--<p class="text-motivapp-red">¿Esta Seguro?</p>--}}
            {{--<form action="{{ url('admin/posts',$post) }}" method="POST">--}}
                {{--{{ csrf_field() }}--}}
                {{--{{ method_field('DELETE') }}--}}

                {{--<button type="submit" class="btn btn-danger">--}}
                    {{--<i class="fa fa-trash"></i> Borrar Definitivamente--}}
                {{--</button>--}}
            {{--</form>--}}
        {{--</div>--}}
        {{--<div class="modal-footer">--}}
            {{--<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

