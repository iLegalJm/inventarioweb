@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nueva categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{ html()->form('POST')->route('admin.categorias.store')->open() }}

            <div class="form-group">
                {{ html()->label('Nombre: ')->for('nombre') }}
                {{ html()->input('text')->name('nombre')->class('form-control')->placeholder('Nombre de categoría') }}

                @error('nombre')
                    {{ html()->span($message)->class('text-danger') }}
                @enderror
            </div>

            {{ html()->submit('Create categoría')->class('btn btn-primary') }}
            {{ html()->form()->close() }}
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        // console.log('Hi!');
    </script>
@stop
