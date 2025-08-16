<div class="table-responsive">
    <table id='pverificar' class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>E-mail</th>
                <th>Rol</th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios_a_verificar as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames() }}</td>
                    <td width="">
                        @can('admin.users.show')
                            <a class="btn btn-sm btn-primary " href="{{ route('admin.users.show', $user) }}"><i
                                    class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                        @endcan

                        @can('admin.users.edit')
                            <a class="btn btn-warning btn-sm" href="{{ route('admin.users.editroles', $user) }}">Roles</a>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user) }}">Editar</a>
                             <a class="btn btn-success btn-sm" href="{{ route('admin.users.ver_autorizar', $user->id) }}">Verificar</a>
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
        </tbody>
    </table>
</div>
<script>
        $('#pverificar').DataTable({
            order: [
                [0, 'desc']
            ],
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
                            title: 'Listado de Perfiles a Verificar',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Perfiles a Verificar',
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
                            title: 'Listado de Perfiles a Verificar',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                    ]
                }
            ],



        });
    </script>