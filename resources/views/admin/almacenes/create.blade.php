@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nuevo almacén</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.almacenes.store']) !!}

            <div class="form-group">
                {!! Form::label('nombre', 'Nombre', ['class' => '']) !!}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del almacén']) !!}

                @error('nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {!! Form::submit('Crear almacén', ['class' => 'btn btn-primary']) !!}
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
