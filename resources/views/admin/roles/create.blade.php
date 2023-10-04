@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre', ['class' => '']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del almacén']) !!}

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <h2 class="h3">Lista de permisos</h2>

            @foreach ($permissions as $permission)
                <div>
                    <label>
                        {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
                        {{ $permission->description }}
                    </label>
                </div>
            @endforeach

            {!! Form::submit('Crear rol', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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
    </script>
@stop
