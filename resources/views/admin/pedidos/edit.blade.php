@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar producto</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($ordenpedido, [
                'route' => ['admin.ordenpedidos.update', $ordenpedido->codigo],
                'method' => 'put',
                'autocomplete' => 'off',
                'files' => true,
            ]) !!}
            <div class="form-row">
                <div class="col">
                    {!! Form::label('codigo', 'Codigo:', ['class' => '']) !!}
                    {!! Form::text('codigo', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el codigo producto',
                        'readonly' => true,
                    ]) !!}
                </div>
                <div class="col">
                    {!! Form::label('total', 'Total a pagar:', ['class' => '']) !!}
                    {!! Form::text('total', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el codigo producto',
                        'readonly' => true,
                    ]) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {!! Form::label('', 'Cliente:', ['class' => '']) !!}
                    <input type="text" value="{{ $ordenpedido->cliente->nombres }} {{ $ordenpedido->cliente->apellidos }}"
                        class="form-control" readonly="true">
                </div>
                <div class="col">
                    <div class="col">
                        {!! Form::label('', 'Dni:', ['class' => '']) !!}
                        <input type="text" value="{{ $ordenpedido->cliente->numerodocumento }}" class="form-control"
                            readonly="true">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {!! Form::label('importepago', 'Importe:', ['class' => '']) !!}
                    {!! Form::number('importepago', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el monto del cliente',
                        'step' => '0.01'
                    ]) !!}
                </div>
                {{-- <div class="col">
                    {!! Form::label('modelo', 'Modelo:', ['class' => '']) !!}
                    {!! Form::text('modelo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el modelo del producto']) !!}
                </div> --}}
            </div>
            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción:', ['class' => '']) !!}
                {!! Form::textarea('descripcion', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Ingrese su descripción',
                    'rows' => '3',
                    'cols' => '50',
                ]) !!}
            </div>
            {!! Form::submit('Generar orden de venta', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
@stop

@section('js')
@stop
