@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Almacén</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {{ html()->modelForm($categoria, 'PUT')->route('admin.categorias.update', $categoria)->open() }}

            <div class="form-group">
                {{ html()->label('Nombre: ')->for('nombre') }}
                {{ html()->text('nombre')->class('form-control')->placeholder('Nombre de la categoría') }}
                @error('nombre')
                    {{ html()->span($message)->class('text-danger') }}
                @enderror
            </div>

            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Volver</a>
            {{ html()->submit('Actualizar categoría')->class('btn btn-primary') }}
            {{ html()->closeModelForm() }}
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
