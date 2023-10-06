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
            {!! Form::model($categoria, ['route' => ['admin.categorias.update', $categoria], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('nombre', 'Nombre', ['class' => '']) !!}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del almacén']) !!}

                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Volver</a>
            {!! Form::submit('Actualizar almacén', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
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
