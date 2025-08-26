@extends('adminlte::page')

@section('title', __('Actualizar Anuncio'))

{{-- @section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection --}}

@section('content_header')
    <h1>{{ __('Actualizar Anuncio') }}</h1>
    @livewireStyles
@stop
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
                    <p><strong>{{ __('Usuario') }}:</strong> ({{ $user->id }}) {{ $user->name }}</p>
                    <p><strong>{{ __('Contact') }}:</strong> {{ $user->telefono }} | {{ $user->email }}</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>{{ __('Imágenes a Subir') }}:</strong> {{ $anuncio->imagenes_pendientes() }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>{{ __('Imágenes para Verificar') }}:</strong> {{ $anuncio->cantidad_img_verificar() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    @include('admin.anuncio.partial.verificacion_partial')
                </div>
                <div class="col-md-4">
                    <strong>{{ __('Imagén de portada') }}</strong>
                    @if($anuncio->portada)
                        <div class="image-wrapper">
                            <a href="{{ config('app.url').'/images/anuncio/'.$anuncio->id.'/'.$anuncio->portada->nombre }}" 
                               data-toggle="lightbox" data-gallery="gallery">
                                <img src="{{ config('app.url').'/images/anuncio/'.$anuncio->id.'/'.$anuncio->portada->nombre }}" 
                                     class=" img-fluid img-thumbnail imagen-limitada" alt="imagen de portada">
                            </a>
                            <p>{{ __('Posición') }}: {{ $anuncio->portada->position }}</p>
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
                                {{ __('Aprobar Video') }}
                            </a>
                        @endif
                        <a href="{{ route('admin.rechazar_video', $anuncio) }}" 
                           class="btn btn-danger btn-sm ml-1">
                            {{ __('Rechazar Video') }}
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
                            {{ __('Aprobar / Publicar') }}
                        </a>
                    @endif

                    <a href="{{ route('admin.anuncio.a_borrador', $anuncio) }}" 
                       class="btn btn-info m-2">
                        {{ __('Borrador') }}
                    </a>
                    <a href="{{ route('admin.anuncio.a_a_publicar', $anuncio) }}" 
                       class="btn btn-info m-2">
                        {{ __('A Publicar') }}
                    </a>
                    
                    @if($anuncio->estado == 'Publicado' && $anuncio->dias_restantes() > 0)
                        <a href="{{ route('admin.anuncio.pausar_anuncio', $anuncio) }}" 
                           class="btn btn-success m-2">
                            {{ __('Pausar') }}
                        </a>
                    @endif
                    
                    @if(($anuncio->estado == 'Pausado' && $anuncio->dias_restantes() > 0) || $anuncio->estado == 'Suspendido')
                        <a href="{{ route('admin.anuncio.reactivar_anuncio', $anuncio) }}" 
                           class="btn btn-success m-2">
                            {{ __('Reactivar') }}
                        </a>
                    @endif
                    
                    <a href="{{ route('admin.anuncio.rechazar_anuncio', $anuncio) }}" 
                       class="btn btn-danger m-2">
                        {{ __('Rechazar') }}
                    </a>
                    <a href="{{ route('admin.anuncio.suspender_anuncio', $anuncio) }}" 
                       class="btn btn-warning m-2">
                        {{ __('Suspender') }}
                    </a>
                    <a href="{{ route('admin.anuncio.finalizar_anuncio', $anuncio) }}" 
                       class="btn btn-warning m-2">
                        {{ __('Finalizar') }}
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
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <!-- Opcional: CSS para mejor visualización -->

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
        .imagen-limitada {
            max-width: 400px !important;
            max-height: 300px !important;
            width: auto !important;
            height: auto !important; /* Mantiene la proporción */
        }
    </style>
@endsection

@section('js')

 <!-- Carga jQuery PRIMERO -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <!-- Luego jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    


@vite(['resources/js/app.js'])

<!-- DataTables y plugins -->
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

<script src="https://cdn.tailwindcss.com"></script>
<!-- Dropzone -->
    <script src="https://unpkg.com/dropzone@5.9.3/dist/min/dropzone.min.js"></script>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>


    <script>
// 1. Variable para controlar el estado de Sortable
let sortableInitialized = false;

// 2. Función para inicializar Sortable
function initializeSortable() {
    if ($('.sortable').length && !sortableInitialized) {
        $('.sortable').sortable({
            placeholder: "ui-state-highlight",
            cursor: "move",
            opacity: 0.7,
            containment: "parent",
            update: function(event, ui) {
                // Función que se ejecuta automáticamente al soltar un elemento
                saveImageOrder();
            }
        });
        sortableInitialized = true;
    }
}

$(document).ready(function() {
    initializeSortable();
    
    // Si usas Livewire, agregar este hook
    if (typeof Livewire !== 'undefined') {
        Livewire.hook('message.processed', () => {
            setTimeout(initializeSortable, 100);
        });
    }
});


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

        // Inicialización de DataTables
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración común para ambas tablas
            const datatableConfig = {
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.0.7/i18n/es-AR.json'
                },
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-columns"></i> Columnas'
                    },
                    {
                        extend: 'collection',
                        text: '<i class="fas fa-download"></i> Exportar',
                        buttons: [
                            {
                                extend: 'pdfHtml5',
                                className: 'btn-sm',
                                exportOptions: { columns: ':visible' }
                            },
                            {
                                extend: 'excelHtml5',
                                className: 'btn-sm',
                                exportOptions: { columns: ':visible' }
                            },
                            {
                                extend: 'copy',
                                className: 'btn-sm',
                                exportOptions: { columns: ':visible' }
                            },
                            {
                                extend: 'csv',
                                className: 'btn-sm',
                                exportOptions: { columns: ':visible' }
                            },
                            {
                                extend: 'print',
                                className: 'btn-sm',
                                exportOptions: { columns: ':visible' }
                            }
                        ]
                    }
                ]
            };
            
            // Tabla de notas
            $('#notas').DataTable({
                ...datatableConfig,
                order: [[0, 'desc']]
            });
            
            // Tabla de pagos
            $('#pagos').DataTable({
                ...datatableConfig,
                order: [[0, 'desc']]
            });

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
        });

    const initCKEditor = (selector) => {
        const el = document.querySelector(selector);
        if (!el || el.classList.contains('ck-editor__editable')) return;

        ClassicEditor
            .create(el)
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    // Si usas wire:model en el campo, actualiza el valor en Livewire
                    const event = new CustomEvent('ckeditor-update', {
                        detail: {
                            id: el.getAttribute('id'),
                            value: editor.getData()
                        }
                    });
                    window.dispatchEvent(event);
                });
            })
            .catch(error => {
                console.error(`Error inicializando CKEditor en ${selector}:`, error);
            });
    };

    document.addEventListener('DOMContentLoaded', () => {
        initCKEditor('#descripcion');
        initCKEditor('#presentacion_aux');
        initCKEditor('#horario');
    });

    // Livewire 3 hook: se dispara después de cualquier actualización del DOM
    document.addEventListener('livewire:init', () => {
        Livewire.hook('commit', ({ succeed }) => {
            succeed(() => {
                initCKEditor('#descripcion');
                initCKEditor('#presentacion_aux');
                initCKEditor('#horario');
            });
        });
    });

    window.addEventListener('ckeditor-update', e => {
        const { id, value } = e.detail;
        const el = document.getElementById(id);
        if (el && el.__livewire_input_name) {
            Livewire.find(el.closest('[wire\\:id]').getAttribute('wire:id'))
                .set(el.__livewire_input_name, value);
        }
    }); 


document.getElementById('submit').addEventListener('click', function(e) {
    e.preventDefault();
    
    // Mostrar overlay de carga
    document.getElementById('waitOverlay').style.display = 'flex';
    
    // 1. Reordenar imágenes
    reordenar_imagenes();
    
    // 2. Opcional: Enviar otras configuraciones (portada, etc.)
    setTimeout(() => {
        // Ocultar overlay y recargar después de 1.5 segundos (ajustable)
        document.getElementById('waitOverlay').style.display = 'none';
        window.location.reload(); // O mostrar mensaje de éxito
    }, 1500);
});
    </script>
@stop