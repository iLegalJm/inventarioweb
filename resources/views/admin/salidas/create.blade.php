@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1>Registrar nueva salida</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.salidas.store', 'class' => 'formulario-create']) !!}
            <div class="form-row m-1">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    {!! Form::label('codigo', 'Codigo:', ['class' => '']) !!}
                    {!! Form::text('codigo', $codigo, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el codigo de ingreso',
                        'readonly' => true,
                    ]) !!}
                    @error('codigo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    {!! Form::label('almacen_id', 'Almacen:', ['class' => '']) !!}
                    {!! Form::select('almacen_id', $almacenes, null, ['class' => 'form-control']) !!}
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row m-1">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    {!! Form::label('codigo', 'Codigo venta:', ['class' => '']) !!}
                    {!! Form::select('codigo', $ordenventas, null, [
                        'class' => 'form-control form-control-select select-productos ',
                        'id' => 'pidproducto',
                    ]) !!}
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    {{-- {!! Form::label(null, 'Cantidad:', ['class' => '']) !!}
                    {!! Form::number(null, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el nombre del almacén',
                        'id' => 'pcantidad',
                    ]) !!} --}}
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    {{-- {!! Form::label(null, 'Costo:', ['class' => '']) !!}
                    {!! Form::number(null, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el precio de compra del producto',
                        'step' => '0.01',
                        'id' => 'pcosto',
                    ]) !!} --}}
                </div>
            </div>
            {!! Form::submit('Registrar salida', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // ! SELECT2, para los select
            $('.select-productos').select2({
                theme: 'bootstrap4',
                language: {
                    noResults: function() {

                        return "No hay resultado";
                    },
                    searching: function() {

                        return "Buscando..";
                    }
                }
            });
        });
    </script>
@stop
