<div id="waitOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="text-center text-white">
        <div class="flex flex-col items-center mb-4">
            <svg width="25" viewBox="-2 -2 42 42" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" class="w-8 h-8 animate-spin">
                <g fill="none" fill-rule="evenodd">
                    <g transform="translate(1 1)" stroke-width="4">
                        <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                        <path d="M36 18c0-9.94-8.06-18-18-18">
                            <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform>
                        </path>
                    </g>
                </g>
            </svg>
        </div>
        <p class="text-lg font-medium">Cargando imágenes...</p>
    </div>
</div>


<section class="container mx-auto px-4 py-6">
    <form class="dropzone border-2 border-dashed border-gray-300 rounded-lg p-6 mb-6" id="file-dropzone"></form>

    <p class="text-gray-600 mb-6">
        {{ __('Cada imagen tiene un orden, el mismo orden que tendrán en tu anuncio, la primera posición corresponde a la imagen de la portada') }}
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 justify-center items-start sortable files">
        @foreach ($imagenes_drop_zone as $imagen)
            <div id="{{ $imagen['id'] }}" class="template m-2 bg-white rounded-lg overflow-hidden shadow-md">
                <div class="dz-preview dz-file-preview w-full aspect-square">
                    <img src="{{ $imagen['url'] }}" alt="Imagen del anuncio" class="w-full h-full object-cover">
                </div>
                <div class="p-3 text-center">
                    <p class="mb-1">
                        <span class="font-medium">Portada:</span> 
                        @if ($imagen['id'] == $anuncio->portada_id)
                            <span class="text-green-600">Actual</span>
                        @endif
                    </p>
                    <p class="mb-3">
                        <span class="font-medium">Portada Doble:</span> 
                        @if ($imagen['id'] == $anuncio->dobleportada_id)
                            <span class="text-green-600">Actual</span>
                        @endif
                    </p>
                    
                    <div class="flex flex-wrap justify-center gap-2">
                        @if ($imagen['id'] != $anuncio->dobleportada_id)
                            <form action="{{ route('admin.anuncio.marcar_portada_doble', $anuncio->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
                                <input type="hidden" name="imagen_id" value="{{ $imagen['id'] }}">
                                <button type="submit" class="bg-red-700 text-white text-sm px-3 py-1 rounded hover:bg-black transition-colors">
                                    PD
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.anuncio.quitar_portada_doble', $anuncio->id) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="anuncio_id" value="{{ $anuncio->id }}">
                                <input type="hidden" name="imagen_id" value="{{ $imagen['id'] }}">
                                <button type="submit" class="bg-red-700 text-white text-sm px-3 py-1 rounded hover:bg-black transition-colors">
                                    Quitar PD
                                </button>
                            </form>
                        @endif

                        <a href="{{ config('app.url') . '/images/anuncio/' . $anuncio->id . '/original/' . $imagen['name'] }}" 
                           target="_blank" 
                           class="inline-flex items-center justify-center bg-blue-600 text-white text-sm px-3 py-1 rounded hover:bg-blue-800 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>

                        <button data-dz-remove class="bg-red-700 text-white text-sm px-3 py-1 rounded hover:bg-black transition-colors">
                            Quitar
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-left my-6">
        <button id="submit_imagenes" class="px-4 py-2 text-lg font-medium text-white bg-red-700 rounded-lg hover:bg-green-600 transition-colors">
            {{ __('Confirmar Imágenes y Orden') }}
        </button>
    </div>

    <div id="previews" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 justify-center items-start">
        <div id="template" class="template m-2 bg-white rounded-lg overflow-hidden shadow-md hidden">
            <div class="dz-preview dz-file-preview w-full aspect-square">
                <div class="relative w-full h-full">
                    <img data-dz-thumbnail class="w-full h-full object-cover">
                    <div class="dz-progress absolute bottom-0 left-0 right-0 h-1 bg-gray-200">
                        <span class="dz-upload block h-full bg-blue-500" data-dz-uploadprogress></span>
                    </div>
                </div>
            </div>
            <div class="p-3 text-center">
                <p class="mb-3 font-medium">Portada: </p>
                <button data-dz-remove class="bg-red-700 text-white text-sm px-3 py-1 rounded hover:bg-black transition-colors">
                    Quitar
                </button>
            </div>
        </div>
    </div>
</section>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    
    <script>
        // Funciones para mostrar/ocultar el overlay
        function showOverlay() {
            document.getElementById('waitOverlay').style.display = 'flex';
        }
        
        function hideOverlay() {
            document.getElementById('waitOverlay').style.display = 'none';
        }
        
        // Inicializar Sortable para el arrastre de imágenes
        document.addEventListener('DOMContentLoaded', function() {
            const sortable = new Sortable(document.getElementById('existing-images'), {
                animation: 150,
                ghostClass: 'sortable-fallback',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                handle: '.dz-preview',
                onStart: function() {
                    showOverlay();
                },
                onEnd: function() {
                    // Ocultar overlay después de reordenar
                    setTimeout(hideOverlay, 300);
                }
            });
        });

        function reordenar_imagenes() {
            //Reacomodamos la posicion de las imagenes
            alert('Reordenando imágenes...');
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
        // Evento para el botón de confirmar
        document.getElementById('submit_imagenes').addEventListener('click', function() {
            // showOverlay();
            
           // 1. Reordenar imágenes
            reordenar_imagenes();
            
            // 2. Opcional: Enviar otras configuraciones (portada, etc.)
            setTimeout(() => {
                // Ocultar overlay y recargar después de 1.5 segundos (ajustable)
                document.getElementById('waitOverlay').style.display = 'none';
                window.location.reload(); // O mostrar mensaje de éxito

            }, 1500);
        });
        
        // Manejar clics en botones de quitar
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-btn')) {
                showOverlay();
                
                // Encontrar el contenedor padre y eliminarlo
                const item = e.target.closest('.template');
                if (item) {
                    // Simular una demora para la eliminación
                    setTimeout(function() {
                        item.remove();
                        hideOverlay();
                    }, 800);
                }
            }
        });
    </script>