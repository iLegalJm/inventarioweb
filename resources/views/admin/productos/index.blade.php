@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Lista de almacenes</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <a href="{{ route('admin.almacenes.create') }}" class="btn btn-secondary">Agregar almacén</a>
        </div>

        <div class="card-body">
            <table id="productos" class="table table-hover table-striped table-sm cursor-default">
                <thead class="table-dark">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>Codigo</th>
                        <th>
                            Nombre
                        </th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="">
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->codigo }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>S/. {{ $producto->precioventa }}</td>
                            <td class="d-flex justify-content-around">

                                <a href="{{ route('admin.productos.edit', $producto) }}"
                                    class="btn btn-primary btn-sm">Editar</a>

                                <form action="{{ route('admin.productos.destroy', $producto) }}" method="post">
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log('Hi!');
        let table = new DataTable('#productos');
    </script>
@stop
