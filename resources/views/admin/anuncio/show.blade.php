@extends('adminlte::page')

@section('template_title')
    {{ $anuncio->name ?? 'Show Anuncio' }}
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
                            <span class="card-title">{{ __('Show') }} Anuncio</span>
                        </div>
                        <div class="float-right">

                            <a class="btn  btn-success" href="{{ route('admin.anuncio.registrar_pago', $anuncio) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Registrar Pago') }}</a>

                            <a class="btn  btn-success" href="{{ route('admin.users.edit_anuncio', $anuncio) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>

                            <a class="btn btn-primary" href="{{ route('admin.users.show', $anuncio->user) }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <a class="btn btn-warning " href="{{ route('admin.anuncio.imagenes', $anuncio) }}">
                                {{ __('Imagenes') }}
                            </a>
                            @if (count($anuncio->imagenes_verificadas()) > 0)
                                <a href="{{ route('admin.anuncio.ordernar_imagenes', $anuncio) }}" class="btn btn-success "
                                    data-placement="left">
                                    Ordenar Imágenes
                                </a>

                                <a href="{{ route('admin.anuncio.definir_portada', $anuncio) }}" class="btn btn-primary "
                                    data-placement="left">
                                    Imágen de Portada
                                </a>
                            @endif
                            @if ($anuncio->imagenes_pendientes() > 0)
                                <a href="{{ route('admin.anuncio.create_images', $anuncio) }}" class="btn btn-primary "
                                    data-placement="left">
                                    Agregar Imágenes
                                </a>
                            @endif
                            <a href="{{ route('admin.anuncio.cargar_video', $anuncio) }}" class="btn btn-primary "
                                data-placement="left">
                                Cargar Video
                            </a>
                            @if ($anuncio->estado == 'Publicado')
                                <a href="{{ route('admin.anuncio.pausar_anuncio', $anuncio) }}" class="btn btn-warning "
                                    data-placement="left">
                                    Pausar
                                </a>
                            @endif
                            @if ($anuncio->estado == 'Pausado' or $anuncio->estado == 'Rechazado' or $anuncio->estado == 'Suspendido')
                                <a href="{{ route('admin.anuncio.reactivar_anuncio', $anuncio) }}" class="btn btn-success "
                                    data-placement="left">
                                    Reactivar
                                </a>
                            @endif
                        </div>

                        <div class="form-group">
                            <strong>Imagenes a Cargar:</strong>
                            {{ $anuncio->imagenes_pendientes() }}
                        </div>
                        <div class="form-group">
                            <strong>Imagenes a Verificar:</strong>
                            {{ $anuncio->cantidad_img_verificar() }}
                            @if ($anuncio->cantidad_img_verificar() > 0)
                                <a class="btn btn-warning btn-sm"
                                    href="{{ route('admin.anuncio.gestion_imagenes', $anuncio) }}">
                                    {{ __('Verificar') }}</a>
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Portada:</strong>
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="col">
                                        @if (!is_null($anuncio->portada))
                                            <div class="image-wrapper">
                                            <a href="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $anuncio->portada->nombre }}"
                                                data-toggle="lightbox" data-gallery="gallery">

                                                <img src="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/' . $anuncio->portada->nombre }}"
                                                    class="img-fluid mb-2">

                                                </a>
                                            </div>

                                            Ubicación: {{ $anuncio->portada->position }}
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                         <div class="form-group">
                        @if (is_null($anuncio->video))
                            No hay video
                        @else
                        <video width="320" height="240" controls
                            src="{{ config('app.url') . '/videos/anuncios/' . $anuncio->id . '/' . $anuncio->video }}">
                        </video>

                            <br>
                            Estado del Video: {{ $anuncio->estado_video}}
                            
                                <br>
                                <a class="btn btn-success btn-sm" href="{{ route('admin.aceptar_video', $anuncio) }}">
                                    {{ __('Aprobar Video') }}</a>

                                <a class="btn btn-danger btn-sm" href="{{ route('admin.rechazar_video', $anuncio) }}">
                                    {{ __('Rechazar Video') }}</a>
                            
                                    <br>
                        @endif
                         </div>           

                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $anuncio->user ? '(' . $anuncio->user->id . ') ' . $anuncio->user->name : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $anuncio->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Slug:</strong>
                            {{ $anuncio->slug }}
                        </div>
                        <div class="form-group">
                            <strong>Presentacion:</strong>
                            {!! $anuncio->presentacion !!}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $anuncio->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Orientacion:</strong>
                            {{ $anuncio->orientacion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $anuncio->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Mostrar Telefono:</strong>
                            {{ $anuncio->mostrar_telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Whatsapp:</strong>
                            {{ $anuncio->whatsapp }}
                        </div>
                        <div class="form-group">
                            <strong>Categoria:</strong>
                            {{ $anuncio->categoria ? $anuncio->categoria->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Clase:</strong>
                            {{ $anuncio->clase ? $anuncio->clase->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Tarifa:</strong>
                            {{ $anuncio->tarifa }}

                        </div>
                        <div class="form-group">
                            <strong>Provincia:</strong>
                            {{ $anuncio->provincia ? $anuncio->provincia->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Municipio:</strong>
                            {{ $anuncio->municipio ? $anuncio->municipio->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Localidad:</strong>
                            {{ $anuncio->localidad }}
                        </div>
                        <div class="form-group">
                            <strong>Plan:</strong>
                            {{ $anuncio->plane ? $anuncio->plane->nombre : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $anuncio->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Días Contratados:</strong>
                            {{ $anuncio->dias }} <b>(Restantes:</b> {{ $anuncio->dias_restantes() }})
                            <b>(Transcurridos:</b> {{ $anuncio->dias_transcurridos() }})
                        </div>

                        <div class="form-group">
                            <strong>Fecha de Alta:</strong>
                            {{ $anuncio->created_at ? date('d-m-Y', strtotime($anuncio->created_at)) : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de Publicacion:</strong>
                            {{ $anuncio->fecha_de_publicacion ? date('d-m-Y', strtotime($anuncio->fecha_de_publicacion)) : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de Pausado:</strong>
                            {{ $anuncio->fecha_pausa ? date('d-m-Y', strtotime($anuncio->fecha_pausa)) : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de Caducidad:</strong>
                            {{ $anuncio->fecha_caducidad ? date('d-m-Y', strtotime($anuncio->fecha_caducidad)) : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Edad:</strong>
                            {{ $anuncio->edad }}
                        </div>
                        <div class="form-group">
                            <strong>Nacionalidad:</strong>
                            {{ $anuncio->nacionalidad }}
                        </div>
                        <div class="form-group">
                            <strong>Profesion:</strong>
                            {{ $anuncio->profesion }}
                        </div>

                        <div class="form-group">
                            <p class="font-weight-bold">Exterior</p>

                            @foreach ($tags_al as $tag)
                                {{ $tag->nombre }}
                            @endforeach

                        </div>
                        <div class="form-group">
                            <p class="font-weight-bold">Interior</p>

                            @foreach ($tags_in as $tag)
                                {{ $tag->nombre }}
                            @endforeach

                        </div>

                        <div class="form-group">
                            <p class="font-weight-bold">En casa</p>

                            @foreach ($tags_ec as $tag)
                                {{ $tag->nombre }}
                            @endforeach

                        </div>

                        <div class="form-group">
                            <p class="font-weight-bold">En tu casa</p>

                            @foreach ($tags_etc as $tag)
                                {{ $tag->nombre }}
                            @endforeach

                        </div>


                        <div class="form-group">
                            <strong>Gps:</strong>
                            {{ $anuncio->gps }}
                        </div>
                        <div class="form-group">
                            <strong>Ip Address:</strong>
                            {{ $anuncio->ip_address }}
                        </div>
                        <div class="form-group">
                            <strong>Port:</strong>
                            {{ $anuncio->port }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $anuncio->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Destacado:</strong>
                            {{ $anuncio->destacado }}
                        </div>
                        <div class="form-group">
                            <strong>Estado Pago:</strong>
                            {{ $anuncio->estado_pago }}
                        </div>
                        <div class="form-group">
                            <strong>Verificacion:</strong>
                            {{ $anuncio->verificacion }}
                        </div>
                        <div class="form-group">
                        @if ($anuncio->estado == 'Rechazado' || $anuncio->estado == 'A_Publicar' ||  $anuncio->estado == 'Borrador')
                            <a href="{{ route('admin.anuncio.aprobar_anuncio', $anuncio) }}" class="btn btn-success "
                                data-placement="left">
                                Aprobar / Publicar
                            </a>
                        @endif
                        @if ($anuncio->estado == 'Publicado')
                            <a href="{{ route('admin.anuncio.pausar_anuncio', $anuncio) }}" class="btn btn-success "
                                data-placement="left">
                                Pausar
                            </a>
                        @endif
                        @if ($anuncio->estado == 'Pausado' || $anuncio->estado == 'Suspendido')
                            <a href="{{ route('admin.anuncio.reactivar_anuncio', $anuncio) }}" class="btn btn-success "
                                data-placement="left">
                                Reactivar
                            </a>
                        @endif
                        <a href="{{ route('admin.anuncio.rechazar_anuncio', $anuncio) }}" class="btn btn-danger "
                            data-placement="left">
                            Rechazar
                        </a>
                         <a href="{{ route('admin.anuncio.suspender_anuncio', $anuncio) }}" class="btn btn-warning "
                            data-placement="left">
                            Suspender
                        </a>
                         <a href="{{ route('admin.anuncio.finalizar_anuncio', $anuncio) }}" class="btn btn-warning "
                            data-placement="left">
                            Finalizar
                        </a>
                        </div>
                    </div>
                </div>

                @include('admin.anuncio.partial.notas')

                @include('admin.anuncio.partial.pagos')
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
                            title: 'Listado de Notas de ({{ $anuncio->id }}) {{ $anuncio->nombre }}',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Notas de ({{ $anuncio->id }}) {{ $anuncio->nombre }}',
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
                            title: 'Listado de Notas de ({{ $anuncio->id }}) {{ $anuncio->nombre }}',
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
        $('#pagos').DataTable({
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
                            title: 'Listado de Pagos de ({{ $anuncio->id }}) {{ $anuncio->nombre }}',
                            exportOptions: {
                                columns: ':visible'
                            }

                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Listado de Pagos de ({{ $anuncio->id }}) {{ $anuncio->nombre }}',
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
                            title: 'Listado de Pagos de ({{ $anuncio->id }}) {{ $anuncio->nombre }}',
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
