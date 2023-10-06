@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de categorias</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <a href="{{ route('admin.categorias.create') }}" class="btn btn-secondary">Agregar categoría</a>
        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-sm cursor-default">
                <thead class="table-dark">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td width="10px"><a href="{{ route('admin.almacenes.edit', $categoria) }}"
                                    class="btn btn-primary btn-sm">Editar</a></td>
                            <td width="10px">
                                <form action="{{ route('admin.almacenes.destroy', $categoria) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
