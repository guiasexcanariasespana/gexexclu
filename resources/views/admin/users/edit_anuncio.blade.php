@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} Anuncio
@endsection
@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


    <style>
        #waitOverlay {
            position: fixed;
            /* Sit on top of the page content */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.8);
            /* Black background with opacity */
            z-index: 10001;
            /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;
            /* Add a pointer on hover */
            display: none
        }

        #waitOverlay .text {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }

        #waitOverlay .text p {
            font-size: 20px;
            color: white;
            text-align: center;
        }

        #waitOverlay .text p i {
            font-size: 50px;
            margin: 0 0 20px;
        }
    </style>
@endsection
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Anuncio</span>

                        <div class="float-right">
                            {{-- @if (count($anuncio->imagenes_verificadas()) > 0)
                                <a href="{{ route('admin.anuncio.ordernar_imagenes', $anuncio) }}" class="btn btn-success"
                                    data-placement="left">
                                    Ordenar Imágenes
                                </a>

                                <a href="{{ route('admin.anuncio.definir_portada', $anuncio) }}" class="btn btn-primary "
                                    data-placement="left">
                                    Imágen de Portada
                                </a>
                            @endif --}}

                            <a class="btn  btn-success" href="{{ route('admin.anuncio.registrar_pago', $anuncio) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Registrar Pago') }}</a>
                            <a class="btn btn-primary" href="{{ route('admin.anuncios.index', $user) }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        {{ Form::label('usuario: (' . $user->id . ') ' . $user->name) }}
                        {{ Form::label('Contacto: (' . $user->telefono . ') ' . ' Email:' . $user->email) }}
                        <div class="row">

                            <div class="form-group col-lg-6">
                                <strong>Imagenes a Cargar:</strong>
                                {{ $anuncio->imagenes_pendientes() }}
                            </div>
                            <div class="form-group col-lg-6">
                                <strong>Imagenes a Verificar:</strong>
                                {{ $anuncio->cantidad_img_verificar() }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-4">

                                @include('admin.anuncio.partial.verificacion_partial')

                            </div>



                            <div class="form-group col-lg-4">
                                <strong>Portada:</strong>
                                <div class="form-group">
                                    <div class="col-sm-6">
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

                            <div class="form-group col-lg-4">
                                @if (is_null($anuncio->video))
                                    @include('admin.anuncio.partial.subir_video_partial')
                                @else
                                    <video width="320" height="240" controls
                                        src="{{ config('app.url') . '/videos/anuncios/' . $anuncio->id . '/' . $anuncio->video }}">
                                    </video>
                                    <br>
                                    Estado del Video: {{ $anuncio->estado_video }}

                                    <br>
                                    @if ($anuncio->estado_video != 'Verificado')
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('admin.aceptar_video', $anuncio) }}">
                                            {{ __('Aprobar Video') }}</a>
                                    @endif
                                    <a class="btn btn-danger btn-sm" href="{{ route('admin.rechazar_video', $anuncio) }}">
                                        {{ __('Rechazar Video') }}</a>

                                    <br>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="bg p-4 bg-gray-200 w-100">
                            @include('admin.anuncio.partial.create_images_partial')
                        </div>
                        <hr>

                        {{-- <form method="POST" action="{{ route('admin.users.update_anuncio', $anuncio) }}"  role="form" enctype="multipart/form-data"> --}}
                        {!! Form::model($anuncio, [
                            'route' => ['admin.users.update_anuncio', $anuncio],
                            'autocomplete' => 'off',
                            'files' => true,
                            'method' => 'post',
                            'class' => 'w-100',
                        ]) !!}
                        @csrf

                        @include('admin.users.form')


                        </form>
                        <div class="row">
                            @if ($anuncio->estado == 'Rechazado' || $anuncio->estado == 'A_Publicar' || $anuncio->estado == 'Borrador')
                                <a href="{{ route('admin.anuncio.aprobar_anuncio', $anuncio) }}"
                                    class="btn m-2 btn-success " data-placement="left">
                                    Aprobar / Publicar
                                </a>
                            @endif

                            <a href="{{ route('admin.anuncio.a_borrador', $anuncio) }}" class="btn m-2 btn-info "
                                data-placement="left">
                                Borrador
                            </a>
                            <a href="{{ route('admin.anuncio.a_a_publicar', $anuncio) }}" class="btn m-2 btn-info "
                                data-placement="left">
                                A Publicar
                            </a>
                            @if ($anuncio->estado == 'Publicado' && $anuncio->dias_restantes() > 0)
                                <a href="{{ route('admin.anuncio.pausar_anuncio', $anuncio) }}"
                                    class="btn  m-2 btn-success " data-placement="left">
                                    Pausar
                                </a>
                            @endif
                            @if (($anuncio->estado == 'Pausado' && $anuncio->dias_restantes() > 0) || $anuncio->estado == 'Suspendido')
                                <a href="{{ route('admin.anuncio.reactivar_anuncio', $anuncio) }}"
                                    class="btn m-2 btn-success " data-placement="left">
                                    Reactivar
                                </a>
                            @endif
                            <a href="{{ route('admin.anuncio.rechazar_anuncio', $anuncio) }}" class="btn m-2 btn-danger "
                                data-placement="left">
                                Rechazar
                            </a>
                            <a href="{{ route('admin.anuncio.suspender_anuncio', $anuncio) }}" class="btn m-2 btn-warning "
                                data-placement="left">
                                Suspender
                            </a>
                            <a href="{{ route('admin.anuncio.finalizar_anuncio', $anuncio) }}" class="btn m-2 btn-warning "
                                data-placement="left">
                                Finalizar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('admin.anuncio.partial.notas')

        @include('admin.anuncio.partial.pagos')
    </section>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        const MAXIMO_TAMANIO_BYTES = 2000000;

        function reordenar_imagenes() {
            //Reacomodamos la posicion de las imagenes
            $('.sortable').sortable('refreshPositions');
            //Convertimos a array
            let sortedIDs = $(".sortable").sortable("toArray");
            //Enviamos la peticion al servidor para re ordenar
            $.ajax({
                type: "POST",
                url: "{{ route('admin.imagenes_guardar_orden', $anuncio) }}",
                headers: {
                    "X-CSRF-Token": "{{ csrf_token() }}"
                },
                data: {
                    'images': JSON.stringify(sortedIDs)
                },
                dataType: "json",
                success: function(data) {
                    console.log(data)
                }
            });
        }

        //Seleccionamos el template donde va a ser mostrado el preview
        var previewNode = document.querySelector("#template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        Dropzone.autoDiscover = false;
        $('#file-dropzone').dropzone({
            url: "{{ route('admin.guardar_imagen', $anuncio) }}",
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}"
            },
            paramName: "image",
            previewsContainer: '#previews',
            previewTemplate: previewTemplate,
            parallelUploads: 10,
            //             addRemoveLinks: true,
            // dictRemoveFile: "Remove",
            maxFiles: {{ 10 - $anuncio->imagens()->count() }},
            maxFilesize: MAXIMO_TAMANIO_BYTES,
            acceptedFiles: '.jpg,.jpeg,.png',
            init: function() {

                var myDropzone = this;

                myDropzone.on('success', function(file, json) {
                    if (json.result) {
                        $(file.previewElement).attr("id", json.id);
                    } else {
                        $(file.previewElement).find('.dz-error-message').html(json.message)
                    }
                });

                myDropzone.on('addedfile', function(file) {

                    if ($('#waitOverlay').length > 0) {
                        $('#waitOverlay').fadeIn('fast');
                    }

                    $('.files').append(file.previewTemplate);
                });

                myDropzone.on('queuecomplete', function() {
                    $('#waitOverlay').fadeOut();
                });

                this.on('removedfile', function(file) {
                    if (confirm("Estais seguro que deseas eliminar la imagen?")) {
                        let image_id = file.previewElement.id;
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.eliminar_imagen') }}",
                            headers: {
                                "X-CSRF-Token": "{{ csrf_token() }}"
                            },
                            data: {
                                'image_id': image_id
                            },
                            dataType: "json",
                            success: function(data) {
                                if (data.result) {
                                    delete_button.parents('.template').remove();
                                    reordenar_imagenes();
                                }
                                // var maxImg = myDropzone[0].dropzone.options.maxFiles;
                                // myDropzone[0].dropzone.options.maxFiles = 1 + maxImg;
                            }
                        });
                    }
                });
            },
            drop: function() {
                console.log('drop')
            }
        });

        $(document).ready(function() {

            $('.sortable').sortable({
                cursor: "move",
                forcePlaceholderSize: true,
                containment: "parent",
                forceHelperSize: true,
                opacity: 0.5
            });

            $("#submit").on("click", function(e) {
                reordenar_imagenes();
                $('#waitOverlay .text-overlay').html('Guardando cambios..');
                $('#waitOverlay').fadeIn('fast');
                setTimeout(() => {
                    $('#waitOverlay .text-overlay').html('Los cambios han sido guardados.');
                    setTimeout(() => {
                        window.location.href =
                            '{{ route('admin.users.edit_anuncio', $anuncio) }}';
                    }, 500);
                }, 1000);
            });
        });

        $(".delete").on('click', function(e) {
            let delete_button = $(this);
            if (confirm("Estais seguro que deseas eliminar la imagen?")) {
                let image_id = $(this).parents('.template').attr('id');
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.eliminar_imagen') }}",
                    headers: {
                        "X-CSRF-Token": "{{ csrf_token() }}"
                    },
                    data: {
                        'image_id': image_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.result) {
                            delete_button.parents('.template').remove();
                            reordenar_imagenes();
                        }
                        $('.dropzone')[0].dropzone.options.maxFiles = $('.dropzone')[0].dropzone.options
                            .maxFiles + 1;
                        var canmax = $('.dropzone')[0].dropzone.options.maxFiles;
                    }
                });
            }
        });
    </script>





    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("#nombre").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#presentacion_aux'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#horario'))
            .catch(error => {
                console.error(error);
            });
    </script>




    <script>
        const MAXIMO_TAMANIO_BYTES = 2000000;

        function previewPerfil() {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById('uploadPerfil').files[0]);
            const archivo = document.getElementById('uploadPerfil').files[0];
            if (archivo.size > MAXIMO_TAMANIO_BYTES) {
                const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
                alert(`El tamaño máximo es ${tamanioEnMb} MB`);
                document.getElementById('uploadPerfil').value = '';
            } else {
                reader.onload = function(e) {
                    document.getElementById('uploadPerfilPreview').src = e.target.result;
                    document.getElementById('btnrm').style.display = 'block';

                };
            }

        }
    </script>
    <script>
        function limpiar_perfil() {
            document.getElementById('uploadPerfilPreview').src = "{{ config('app.url') }}/img/logo.png";
            document.getElementById('btnrm').style.display = 'none';
            document.getElementById('uploadPerfil').value = '';
        }
    </script>


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
    <script>
        document.getElementById("videoUpload")
            .onchange = function(event) {
                let file = event.target.files[0];
                let blobURL = URL.createObjectURL(file);
                document.querySelector("video").src = blobURL;
            }
    </script>
    <script>
    function limpiar() {
        // Obtener las variables desde el HTML
        var img = document.getElementById('uploadPreview').getAttribute('data-imagen');
        var userId = document.getElementById('uploadPreview').getAttribute('data-user-id');

        if (!img) {
            document.getElementById('uploadPreview').src = "/img/logo.png";
        } else {
            document.getElementById('uploadPreview').src = "/images/perfil/" + userId + "/" + img;
        }

        document.getElementById('btnrm').style.display = 'none';
        document.getElementById('uploadImage').value = '';
    }
</script>
@endsection
