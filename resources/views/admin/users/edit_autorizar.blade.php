@extends('adminlte::page')

@section('template_title')
    {{ $user->name ?? 'Show user' }}
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Verificar') }} {{ __('user') }}</span>
                        </div>

                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.users.index') }}"> {{ __('Back') }}</a>
                        </div>

                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $user->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $user->email }}
                        </div>
                        <div class="form-group">
                            <strong>Whatsapp:</strong>
                            {{ $user->whatsapp }}
                        </div>
                        <div class="form-group">
                            <strong>Estado WSP:</strong>
                            {{ $user->estado_wsp }}
                        </div>
                        <div class="form-group">
                            <strong>direccion:</strong>
                            {{ $user->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>gps:</strong>
                            {{ $user->gps }}
                        </div>
                        <div class="form-group">
                            <strong>Zona:</strong>
                            {{ $user->zone ? $user->zone->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>estado:</strong>
                            {{ $user->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Verificado:</strong>
                            {{ $user->verificado }}
                            @if ($user->verificado == 'No' && is_null($user->imagen_verificacion))
                            Aún no subió una imagen para verificar su perfil.
                        @else
                            <div class="form-group">
                            <a class="btn btn-info btn-sm" target="blank"
                                href="{{ '/images/perfil/' . $user->id . '/' . $user->imagen_verificacion }}">
                                {{ __('Ver Original') }}</a>

                        </div>
                        @endif
                            @if ($user->verificado == 'No')
                                <a href="{{ route('admin.user.aprobar_perfil', $user) }}" class="btn btn-success "
                                    data-placement="left">
                                    Si
                                </a>
                                <a href="{{ route('admin.user.rechazar_perfil', $user) }}" class="btn btn-danger "
                                    data-placement="left">
                                    Rechazar
                                </a>
                            @endif

                        </div>
                    </div>
                </div>

                <div id="map"></div>


                @include('admin.users.partial.anuncios')

                @include('admin.users.partial.notas')


            </div>


        </div>

    </section>
@endsection

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
        $('#anuncios').DataTable({
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
                            title: 'Listado de Anuncios de ({{ $user->id }}) {{ $user->name }}',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Anuncios de ({{ $user->id }}) {{ $user->name }}',
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
                            title: 'Listado de Anuncios de ({{ $user->id }}) {{ $user->name }}',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                    ]
                }
            ],



        });
    </script>
    <script>
        $('#notas').DataTable({
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
                            title: 'Listado de Notas de ({{ $user->id }}) {{ $user->name }}',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Notas de ({{ $user->id }}) {{ $user->name }}',
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
                            title: 'Listado de Notas de ({{ $user->id }}) {{ $user->name }}',
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
