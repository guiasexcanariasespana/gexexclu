@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')

<!-- Mostrar mensaje de error -->
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Mostrar mensaje de éxito -->
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <!-- Título alineado a la izquierda -->
    <h1 class="m-0">Administración de Usuarios</h1>

    <!-- Contenedor de botones alineados a la derecha -->
    <div>
        <a href="https://canariasexclusiva.com/nob1903/rosarioadmin/users/create" class="btn btn-primary mr-2">
            <i class="fas fa-user-plus"></i> Crear Usuario
        </a>

        <a href="https://canariasexclusiva.com/nob1903/rosarioadmin/roles" class="btn btn-secondary mr-2">
            <i class="fas fa-users-cog"></i> Administrar Roles
        </a>

        
    </div>
</div>

@stop

@section('content')
<!-- Tabla de Usuarios con DataTables -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Listado de Usuarios</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered" id="users-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th class="text-center">Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center"><span class="badge bg-info">Usuario</span></td>
                    <td>
                        @can('admin.users.show')
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.users.show', $user) }}">
                                <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                            </a>
                        @endcan

                        @can('admin.users.edit')
                            <a class="btn btn-warning btn-sm" href="{{ route('admin.users.editroles', $user) }}">Roles</a>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                        @endcan

                        @can('admin.users.destroy')
                            @if($user->email != 'claudio670531643@gmail.com')
                                <form action="{{ route('admin.accesos.eliminar') }}" method="GET" class="d-inline-block" id="delete-form-{{ $user->id }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->id }})">Eliminar</button>
                                </form>
                            @endif
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@stop

@section('css')
<style>
        .content-wrapper {
            background: #f4f6f9 !important;
        }
        .table tbody tr td:last-child {
            text-align: right; /* Alinear la columna "Acciones" a la derecha */
        }
        .table thead tr th:last-child {
            text-align: right; /* Alinear la columna "Acciones" a la derecha */
        }
   </style>
@stop

@section('js')
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará al usuario y todos sus datos asociados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $('#users-table').DataTable({
            "paging": true, // Activa la paginación
            "lengthChange": false, // No permite cambiar la cantidad de registros mostrados
            "searching": true, // Activa la barra de búsqueda
            "ordering": false, // Permite ordenar columnas
            "info": true, // Muestra información de cantidad de registros
            "autoWidth": false, // No ajusta automáticamente el ancho de las columnas
            "responsive": true, // Hace que la tabla sea responsive
            "language": {
                "search": "Buscar:", // Personaliza el texto del campo de búsqueda
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
                "infoEmpty": "No hay registros disponibles",
                "zeroRecords": "No se encontraron resultados",
            }
        });
    });
</script>

@stop