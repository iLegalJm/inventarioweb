@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar un rol</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre:</p>
            <p class="form-control">{{ $user->name }}</p>

            <h2 class="h5">Listado de roles</h2>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
            @foreach ($roles as $role)
                <div>
                    <label for="">
                        {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                        {{$role->name}}
                    </label>
                </div>
            @endforeach
                <a href="{{ route('admin.users.index') }}" class="btn btn-dark mt-2">Volver</a>
            {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
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
