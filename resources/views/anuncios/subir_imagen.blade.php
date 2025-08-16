<x-registro-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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



    <section>
        <div class="container mx-auto">

            <div class="hero my-4 ">
                <div class="hero-content text-center">
                    <div class="max-w-md">
                        <h2 class="text-6xl  font-bold"> {{ __('Gestiona las imágenes de tu anuncio.') }} </h2>

                        <p class="text-xl text-red-700 sm:block ">
                            {{ __(' Cada imágen tiene un orden, el mismo orden que tendrán en tu anuncio, la primera posición corresponde a la imagen de la portada') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>    
    </section>

    <div id="waitOverlay">
        <div class="text">
            <p class="flex flex-col items-center mb-4">
                <svg width="25" viewBox="-2 -2 42 42" xmlns="http://www.w3.org/2000/svg" stroke="rgb(255, 255, 255)"
                    class="w-8 h-8 text-theme-10">
                    <g fill="none" fill-rule="evenodd">
                        <g transform="translate(1 1)" stroke-width="4">
                            <circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle>
                            <path d="M36 18c0-9.94-8.06-18-18-18">
                                <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18"
                                    dur="1s" repeatCount="indefinite"></animateTransform>
                            </path>
                        </g>
                    </g>
                </svg>
            </p>
            <p class="text-overlay">Cargando imagenes...</p>
        </div>
    </div>

    <section>
      <div class="container">
            

                <form class="dropzone" drop-zone="" id="file-dropzone"></form>

                <div class="grid grid-cols md:grid-cols-2 lg:grid-cols-4 gap-2 justify-center justify-items-center m-5 sortable files">
                    
                    @foreach ($imagenes_drop_zone as $imagen)
                        <div id="{{ $imagen['id'] }}" class=" template  " >
                            <div class="dz-preview dz-file-preview w-52 h-52 ">
                                <img data-dz-thumbnail src="{{ $imagen['url'] }}" class="w-full h-full object-cover" />
                            </div>
                            <div class="text-center  my-2">
                                <button data-dz-remove class="bg-red-700 text-white px-4 py-1 rounded-lg hover:bg-black hover:text-black  delete">
                                    <span>Quitar</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center my-10">
                    <button id="submit"
                        class=" px-12  py-3 text-lg font-medium text-white bg-red-700 rounded hover:bg-green-500 ">
                        {{ __('Submit') }}
                    </button>
                    <a class=" px-14  py-3 text-white bg-black border border-1  hover:bg-gray-300 hover:text-black focus:outline-none <"
                    href="{{ route('dashboard', $anuncio) }}">
                    {{ __('Cancelar') }}
                </a>
                </div>
            

            <div id="previews" class="grid grid-cols md:grid-cols-2 lg:grid-cols-4 gap-2 justify-center justify-items-center m-5  ">
                <div id="template" class="template " >
                    <div class="dz-preview dz-file-preview w-52 h-52">
                        <div>
                            <img data-dz-thumbnail class="w-full h-full object-cover"/>
                        </div>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    </div>
                    <div class="text-center  my-2">
                        <button data-dz-remove class="bg-red-700 text-white px-4 py-1 rounded-lg hover:bg-black hover:text-black  delete">
                            <span>Quitar</span>
                        </button>
                    </div>
                </div>
            </div>
    </div>   
    </section>
 
    <script>
        $(".template").disableSelection();
       
        const MAXIMO_TAMANIO_BYTES = 2000000;

        function reordenar_imagenes() {
            //Reacomodamos la posicion de las imagenes
            $('.sortable').sortable('refreshPositions');
            //Convertimos a array
            let sortedIDs = $(".sortable").sortable("toArray");
            //Enviamos la peticion al servidor para re ordenar
            $.ajax({
                type: "POST",
                url: "{{ route('imagenes_guardar_orden', $anuncio) }}",
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
            url: "{{ route('guardar_imagen', $anuncio) }}",
            headers: {
                "X-CSRF-Token": "{{ csrf_token() }}"
            },
            paramName: "image",
            previewsContainer: '#previews',
            previewTemplate: previewTemplate,
            parallelUploads: 10,
            //             addRemoveLinks: true,
            // dictRemoveFile: "Remove",
            maxFiles: {{10 - $anuncio->imagens()->count()}},
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
                            url: "{{ route('eliminar_imagen') }}",
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
                        window.location.href = '{{ route('dashboard', $anuncio) }}';
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
                    url: "{{ route('eliminar_imagen') }}",
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
                        $('.dropzone')[0].dropzone.options.maxFiles = $('.dropzone')[0].dropzone.options.maxFiles + 1;
                        var canmax = $('.dropzone')[0].dropzone.options.maxFiles;                                                
                    }
                });
            }
        });
    </script>
</x-registro-layout>
