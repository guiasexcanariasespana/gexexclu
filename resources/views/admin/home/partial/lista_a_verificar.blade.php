<div class="table-responsive">
    <table id="averificar" class="table table-striped table-hover">
        <thead class="thead">
            <tr>
                <th>No</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Orientacion</th>
                <th>Categoria</th>
                <th>Zone</th>
                <th>Plan</th>
                <th>Estado</th>
                <th>Destacado</th>
                <th>Verificacion</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anuncios_a_verificar as $anuncio)
                <tr>
                    <td>{{ $anuncio->id }}</td>
                    <td>{{ $anuncio->nombre }}</td>
                    <td>{{ $anuncio->tipo }}</td>
                    <td>{{ $anuncio->orientacion }}</td>
                    <td>{{ $anuncio->categoria ? $anuncio->categoria->nombre : 'N/D' }}</td>
                    <td>{{ $anuncio->localidad }}</td>
                    <td>{{ $anuncio->plane ? $anuncio->plane->nombre : 'N/D' }}</td>
                    <td>{{ $anuncio->estado }}</td>
                    <td>{{ $anuncio->destacado }}</td>
                    <td>{{ $anuncio->verificacion }}</td>

                    <td>
                        <form action="{{ route('admin.anuncios.destroy', $anuncio) }}" method="POST">
                            <a class="btn btn-sm btn-primary " href="{{ route('admin.anuncios.show', $anuncio) }}"><i
                                    class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('admin.users.edit_anuncio', $anuncio) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>
                                {{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
        $('#averificar').DataTable({
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
                            title: 'Listado de Anuncios a Verificar',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Anuncios a Verificar',
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
                            title: 'Listado de Anuncios a Verificar',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                    ]
                }
            ],



        });
    </script>
