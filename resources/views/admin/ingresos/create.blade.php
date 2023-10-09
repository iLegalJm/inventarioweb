@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Select2', true)

@section('content_header')
    <h1>Registrar nuevo ingreso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.ingresos.store', 'class' => 'formulario-create']) !!}
            <div class="form-row m-1">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    {!! Form::label('codigo', 'Codigo:', ['class' => '']) !!}
                    {!! Form::text('codigo', $codigo, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el codigo de ingreso',
                        'readonly' => true
                    ]) !!}
                    @error('codigo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    {!! Form::label('idestado', 'Estado:', ['class' => '']) !!}
                    {!! Form::select('idestado', $idestados, null, ['class' => 'form-control']) !!}
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    {!! Form::label('almacen_id', 'Almacen:', ['class' => '']) !!}
                    {!! Form::select('almacen_id', $almacenes, null, ['class' => 'form-control']) !!}
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-row m-1">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    {!! Form::label(null, 'Producto', ['class' => '']) !!}
                    {!! Form::select(null, $productos, null, [
                        'class' => 'form-control form-control-select select-productos ',
                        'id' => 'pidproducto',
                    ]) !!}
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    {!! Form::label(null, 'Cantidad:', ['class' => '']) !!}
                    {!! Form::number(null, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el nombre del almacén',
                        'id' => 'pcantidad',
                    ]) !!}
                </div>
                <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                    {!! Form::label(null, 'Costo:', ['class' => '']) !!}
                    {!! Form::number(null, null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el precio de compra del producto',
                        'step' => '0.01',
                        'id' => 'pcosto',
                    ]) !!}
                </div>
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                    <button id="btn-add-detalle" type="button" class="btn btn-info my-4">Agregar</button>
                </div>
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table-striped table-bordered table-condensed">
                        <thead class="table-dark">
                            <tr>
                                <th>Opciones</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="form-row">

            </div>
            {!! Form::submit('Registrar ingreso', ['class' => 'btn btn-primary']) !!}
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

            $('#btn-add-detalle').click(function() {
                agregar();
            });
        });

        let cont = 0;

        function agregar() {
            idproducto = $('#pidproducto').val();
            producto = $('#pidproducto option:selected').text();
            cantidad = $('#pcantidad').val();
            costo = $('#pcosto').val();

            if (idproducto != "" && cantidad != "" && cantidad > 0 && costo != "") {
                let fila = `<tr class="selected" id="fila${cont}">
                        <td><button type="button" class="btn btn-warning" onclick="eliminar(${cont})">X</button></td>
                        <td><input type="hidden" name="producto_id[]" value="${idproducto}">${producto}</td>
                        <td><input class="form-control" type="number" name="cantidad[]" value="${cantidad}"></td>
                        <td><input class="form-control" type="number" name="costo[]" value="${costo}" step="0.01"></td>
                    </tr>`;

                cont++;

                //Agregar a la tabla
                limpiar(); // Limpiar los inputs
                $('#detalles').append(fila);
            } else {
                alert('Error');
            }
        }

        function limpiar() {
            $('#pcantidad').val("");
            $('#pcosto').val("");
        }

        function eliminar(index) {
            $('#fila' + index).remove();
        }
    </script>
@stop
