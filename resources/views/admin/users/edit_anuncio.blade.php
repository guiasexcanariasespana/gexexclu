@extends('adminlte::page')

@section('title', __('Actualizar Anuncio'))

@section('content_header')
    <h1>{{ __('Actualizar Anuncio') }}</h1>
@stop
@livewireStyles
@livewireScripts

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('Detalle del Anuncio') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.anuncio.registrar_pago', $anuncio) }}" class="btn btn-success">
                    <i class="fas fa-edit mr-1"></i> {{ __('Registrar Pago') }}
                </a>
                <a href="{{ route('admin.anuncios.index', $user) }}" class="btn btn-primary ml-2">
                    {{ __('Back') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>{{ __('User') }}:</strong> ({{ $user->id }}) {{ $user->name }}</p>
                    <p><strong>{{ __('Contact') }}:</strong> {{ $user->telefono }} | {{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>{{ __('Images to Upload') }}:</strong> {{ $anuncio->imagenes_pendientes() }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>{{ __('Images to Verify') }}:</strong> {{ $anuncio->cantidad_img_verificar() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    @include('admin.anuncio.partial.verificacion_partial')
                </div>

                <div class="col-md-4">
                    <h5>{{ __('Cover Image') }}</h5>
                    @if($anuncio->portada)
                        <div class="image-wrapper">
                            <a href="{{ config('app.url').'/images/anuncio/'.$anuncio->id.'/'.$anuncio->portada->nombre }}" 
                               data-toggle="lightbox" data-gallery="gallery">
                                <img src="{{ config('app.url').'/images/anuncio/'.$anuncio->id.'/'.$anuncio->portada->nombre }}" 
                                     class="img-fluid mb-2" alt="Cover image">
                            </a>
                            <p>{{ __('Position') }}: {{ $anuncio->portada->position }}</p>
                        </div>
                    @endif
                </div>

                <div class="col-md-4">
                    @if(is_null($anuncio->video))
                        @include('admin.anuncio.partial.subir_video_partial')
                    @else
                        <video width="100%" controls class="mb-2">
                            <source src="{{ config('app.url').'/videos/anuncios/'.$anuncio->id.'/'.$anuncio->video }}" 
                                    type="video/mp4">
                        </video>
                        <p>{{ __('Video Status') }}: {{ $anuncio->estado_video }}</p>
                        
                        @if($anuncio->estado_video != 'Verificado')
                            <a href="{{ route('admin.aceptar_video', $anuncio) }}" 
                               class="btn btn-success btn-sm">
                                {{ __('Approve Video') }}
                            </a>
                        @endif
                        <a href="{{ route('admin.rechazar_video', $anuncio) }}" 
                           class="btn btn-danger btn-sm ml-1">
                            {{ __('Reject Video') }}
                        </a>
                    @endif
                </div>
            </div>

            <hr>
           <div class="row">

               <div class="col-md-12 bg-light">
                   @include('admin.anuncio.partial.create_images_partial')
               </div>
           </div>

            <hr>

            <form method="POST" action="{{ route('admin.users.update_anuncio', $anuncio) }}" 
                  enctype="multipart/form-data" class="w-100">
                @csrf
                @method('PUT')

                @include('admin.users.form')

                <div class="d-flex flex-wrap mt-4">
                    @if(in_array($anuncio->estado, ['Rechazado', 'A_Publicar', 'Borrador']))
                        <a href="{{ route('admin.anuncio.aprobar_anuncio', $anuncio) }}" 
                           class="btn btn-success m-2">
                            {{ __('Approve / Publish') }}
                        </a>
                    @endif

                    <a href="{{ route('admin.anuncio.a_borrador', $anuncio) }}" 
                       class="btn btn-info m-2">
                        {{ __('Draft') }}
                    </a>
                    <a href="{{ route('admin.anuncio.a_a_publicar', $anuncio) }}" 
                       class="btn btn-info m-2">
                        {{ __('To Publish') }}
                    </a>
                    
                    @if($anuncio->estado == 'Publicado' && $anuncio->dias_restantes() > 0)
                        <a href="{{ route('admin.anuncio.pausar_anuncio', $anuncio) }}" 
                           class="btn btn-success m-2">
                            {{ __('Pause') }}
                        </a>
                    @endif
                    
                    @if(($anuncio->estado == 'Pausado' && $anuncio->dias_restantes() > 0) || $anuncio->estado == 'Suspendido')
                        <a href="{{ route('admin.anuncio.reactivar_anuncio', $anuncio) }}" 
                           class="btn btn-success m-2">
                            {{ __('Reactivate') }}
                        </a>
                    @endif
                    
                    <a href="{{ route('admin.anuncio.rechazar_anuncio', $anuncio) }}" 
                       class="btn btn-danger m-2">
                        {{ __('Reject') }}
                    </a>
                    <a href="{{ route('admin.anuncio.suspender_anuncio', $anuncio) }}" 
                       class="btn btn-warning m-2">
                        {{ __('Suspend') }}
                    </a>
                    <a href="{{ route('admin.anuncio.finalizar_anuncio', $anuncio) }}" 
                       class="btn btn-warning m-2">
                        {{ __('Finish') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
    @include('admin.anuncio.partial.notas')
    @include('admin.anuncio.partial.pagos')
@endsection

@section('css')
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <style>
        #waitOverlay {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 10001;
            display: none;
        }

        #waitOverlay .text {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        #waitOverlay .text p {
            font-size: 1.25rem;
            color: white;
            text-align: center;
        }

        #waitOverlay .text i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('js')
    @vite(['resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.js"></script>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script>
        // Dropzone and other JS functionality remains the same
        // Just modernize the syntax where needed
        const MAXIMO_TAMANIO_BYTES = 2000000;

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize editors
            ClassicEditor
                .create(document.querySelector('#presentacion_aux'))
                .catch(error => console.error(error));

            ClassicEditor
                .create(document.querySelector('#horario'))
                .catch(error => console.error(error));

            // Initialize DataTables
            $('#notas, #pagos').DataTable({
                order: [[0, 'desc']],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/es-AR.json'
                },
                responsive: true,
                autoWidth: false,
                dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-4'i><'col-sm-4'p>>",
                buttons: [
                    {
                        extend: 'colvis',
                        text: '{{ __("Visible Columns") }}'
                    },
                    {
                        extend: 'collection',
                        text: '{{ __("Export") }}',
                        buttons: [
                            'pdfHtml5',
                            'excelHtml5',
                            'copy',
                            'csv',
                            {
                                extend: 'print',
                                text: '{{ __("Print") }}'
                            }
                        ]
                    }
                ]
            });

            // Video upload preview
            document.getElementById("videoUpload").addEventListener('change', function(event) {
                const file = event.target.files[0];
                const blobURL = URL.createObjectURL(file);
                document.querySelector("video").src = blobURL;
            });
        });

        function limpiar() {
            const img = document.getElementById('uploadPreview').dataset.imagen;
            const userId = document.getElementById('uploadPreview').dataset.userId;
            
            document.getElementById('uploadPreview').src = img 
                ? `/images/perfil/${userId}/${img}` 
                : '/img/logo.png';
                
            document.getElementById('btnrm').style.display = 'none';
            document.getElementById('uploadImage').value = '';
        }
           // Configuración de Dropzone
            if (document.getElementById('file-dropzone')) {
                const dropzone = new Dropzone('#file-dropzone', {
                    url: "{{ route('admin.guardar_imagen', $anuncio) }}",
                    headers: {
                        "X-CSRF-Token": "{{ csrf_token() }}"
                    },
                    paramName: "image",
                    maxFilesize: 2, // MB
                    acceptedFiles: 'image/jpeg,image/png',
                    addRemoveLinks: true,
                    dictRemoveFile: "Eliminar",
                    maxFiles: {{ 14 - $anuncio->imagens()->count() }},
                    init: function() {
                        this.on('success', function(file, response) {
                            if (response.result) {
                                file.previewElement.dataset.id = response.id;
                            } else {
                                this.removeFile(file);
                                alert(response.message);
                            }
                        });
                        
                        this.on('removedfile', function(file) {
                            if (confirm("¿Estás seguro de eliminar esta imagen?")) {
                                const imageId = file.previewElement.dataset.id;
                                if (imageId) {
                                    fetch("{{ route('admin.eliminar_imagen') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-Token': "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({ image_id: imageId })
                                    });
                                }
                            }
                        });
                    }
                });
            }
    
    </script>
@endsection