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
            {!! Form::model($ordenpedido, ['route' => ['admin.productos.update', $ordenpedido->codigo], 'method' => 'put', 'autocomplete' => 'off', 'files' => true]) !!}
            <div class="form-row">
                {{-- <div class="col">
                    {!! Form::label('almacen_id', 'Almacén:', ['class' => '']) !!}
                    {!! Form::select('almacen_id', $almacenes, null, ['class' => 'form-control']) !!}
                </div> --}}
                <div class="col">
                    {!! Form::label('codigo', 'Codigo:', ['class' => '']) !!}
                    {!! Form::text('codigo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el codigo producto']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {!! Form::label('nombre', 'Nombre:', ['class' => '']) !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del almacén']) !!}

                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col">
                    {!! Form::label('precioventa', 'Precio de venta:', ['class' => '']) !!}
                    {!! Form::number('precioventa', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el precio de venta del producto',
                        'step' => '0.01',
                    ]) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {!! Form::label('marca', 'Marca:', ['class' => '']) !!}
                    {!! Form::text('marca', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la marca del producto']) !!}
                </div>
                <div class="col">
                    {!! Form::label('modelo', 'Modelo:', ['class' => '']) !!}
                    {!! Form::text('modelo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el modelo del producto']) !!}
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    {!! Form::label('tamaño', 'Tamaño:', ['class' => '']) !!}
                    {!! Form::text('tamaño', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el tamaño del producto']) !!}
                </div>
                {{-- <div class="col">
                    {!! Form::label('color', 'Color:', ['class' => '']) !!}
                    {!! Form::text('color', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Ingrese el color del producto',
                    ]) !!}
                </div> --}}
            </div>
            <div class="form-row" id="form-group-imagenes">
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
            {!! Form::submit('Editar producto', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <style>
        .image-wraper {
            position: relative;
            padding-bottom: 53.25%;
        }

        .image-wrapper img {
            /* position: absolute; */
            object-fit: cover;
            max-width: 400px;
            max-height: 200px;
        }
    </style>
@stop

@section('js')
    <script>
        const crearInput = document.getElementById("crear-input");
        const quitarInput = document.getElementById("quitar-input");

        crearInput.addEventListener('click', function() {
            const nuevoInput = document.createElement('input');
            let formGroupImagen = document.getElementById('form-group-imagenes');
            const inputs = formGroupImagen.querySelectorAll("input[name='imagen[]']");
            nuevoInput.type = 'file';
            nuevoInput.accept = 'image/*';
            nuevoInput.name = 'imagen[]';
            nuevoInput.className = 'form-control-file my-2';
            console.log(inputs.length);

            if ((inputs.length + 1) == 1) {
                quitarInput.classList.toggle('d-none');
            } else if ((inputs.length + 1) == 3) {
                crearInput.classList.toggle('d-none');
            }
            // let formGroupImagen = document.getElementById('form-group-imagenes');
            formGroupImagen.appendChild(nuevoInput);
        });
        quitarInput.addEventListener('click', function() {
            const formulario = document.querySelector('.formulario-create');
            let formGroupImagen = document.getElementById('form-group-imagenes');
            const inputs = formGroupImagen.querySelectorAll("input[name='imagen[]']");
            console.log(inputs.length);
            if (inputs.length == 1) {
                quitarInput.classList.toggle('d-none');
            } else if (inputs.length == 3) {
                crearInput.classList.toggle('d-none');
            }
            formGroupImagen.removeChild(inputs[inputs.length - 1]);
        });

        //Cambiar imagen
        document.getElementById("imagen").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = event => {
                document.querySelector('#picture').setAttribute('src', event.target.result);
            }
            reader.readAsDataURL(file);
        }
    </script>
@stop
