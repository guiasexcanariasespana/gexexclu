@extends('adminlte::page')

@section('title', 'Gmarket ADMIN PANEL')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection


@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            @can('admin.users.create')
                <a class="btn btn-primary" href="{{ route('admin.users.create') }}">Agregar Usuarios</a>
            @endcan

        </div>
        <div class="card-body">
            <table id='users' class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tel.</th>
                        <th>E-mail</th>
                    <th>Rol</th>
                        <th></th>

                    </tr>
                </thead>
                {{-- <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleNames() }}</td>
                            <td width="">
                                @can('admin.users.show')
                                     <a class="btn btn-sm btn-primary "
                                                            href="{{ route('admin.users.show', $user) }}"><i
                                                                class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                @endcan

                                @can('admin.users.edit')
                                    <a class="btn btn-warning btn-sm" href="{{ route('admin.users.editroles', $user) }}">Roles</a>
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                                @endcan

                                @can('admin.users.destroy')
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm show-alert">Eliminar</button>
                                    </form>
                                @endcan
                            </td>    
                        </tr>
                    @endforeach
                </tbody> --}}
            </table>
        </div>
    </div>

@stop

@section('js')
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
    <script>
        <script>
    $('.delete-form').submit(function(event){
        if(!confirm('Anda yakin mau menghapus item ini ?')){
            event.preventDefault();
        }
    });
</script>
    </script>

    <script>
        $('#users').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json',
                buttons: {
                    copyTitle: 'Copiado al Portapales',
                    copySuccess: {
                        _: '%d Lineas copiadas',
                        1: '1 linea copiada'
                    }
                },

            },
            responsive: true,
            autoWidth: false,
            ajax: "{{ route('datatable.user') }}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'telefono'
                },
                {
                    data: 'email'
                },                
                {
                    data: 'rol'
                },
                {
                    data: 'action'
                },

            ],
            dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'i><'col-sm-4'p>>",
            buttons: [{
                    extend: 'colvis',
                    text: 'Columnas Visibles'
                },
                {
                    extend: 'collection',
                    text: 'Exportar',
                    buttons: [{
                            extend: 'pdfHtml5',
                            title: 'Listado de Usuarios',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Usuarios',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'copy',
                            text: 'Copiar',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        'csv',
                        {
                            extend: 'print',
                            text: 'Imprimir',
                            title: 'Listado de Usuarios',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                    ]
                }
            ],



        });
    </script>

   
@endsection