<div>
    <div class="card">

        <div class="card-header">
            {{-- ! con wire:model="search" sincronizo ese input con el controlador de livewire llamado search --}}
            <input wire:model="search" type="search" class="form-control"
                placeholder="Busque por nombre o correo de usuario">
            {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-secondary">Agregar almacén</a> --}}
        </div>
        @if ($users->count())
            <div class="card-body table-responsive">
                <table id="" class="table table-hover table-striped table-sm cursor-default"">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td width="" class="d-flex justify-content-around">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="btn btn-primary btn-sm">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong class="text-danger">No hay registros</strong>
            </div>
        @endif
    </div>
</div>
