<div>
    <div class="mt-5 mb-5">
        <div class="w-full mb-5">
            <div class="col">
                <div class="image-wrapper">
                    <span wire:loading wire:target="video"
                        class=" animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]">Cargando el video ...</span>
                    <video width="920" height="400" controls loading="lazy"
                        @if ($show) src="{{ config('app.url') . '/videos/anuncios/' . $anuncio->id . '/' . $anuncio->video }}">
                                @else
                                    src='' @endif>
                    </video>
                </div>

            </div>

        </div>
        @if (!$show)
            <form wire:submit.prevent='submit' method="POST" action="{{ route('guardar_video', $anuncio) }}"
                role="form" enctype="multipart/form-data">
                @csrf
                <input wire:model='video' class="form-control mt-5" id="videoUpload" type="file" name="image"
                    accept="video/*" required  />
                <br>
                <div class="box-footer mb-5">
                    <button type="submit" wire:loading.remove wire:target="submit" onclick="verifico_cartel();"
                        class="btn text-white bg-[#bb1a19] border border-[#bb1a19] rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-black">{{ __('Submit') }}
                        Video
                    </button>
                    <a  wire:loading.remove wire:target="submit, video" class="btn text-white bg-gary-700 border rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-black"
                        href="#" onclick="limpiar_video(); return false;" > 
                        {{ __('Cancelar') }}
                    </a>
                    <span wire:loading wire:target="submit, video"
                    class=" animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]">Cargando...</span>
                    <p class="my-4">
                        <strong> Debes hacer click en guardar </strong> una vez que haz seleccionado el archivo
                        de video.
                    </p>
                    <h2 id='mensaje_cambio_video'
                        class=" animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]"></h2>
                </div>
            </form>
        @else
            <a class="btn text-white bg-[#bb1a19] border border-[#bb1a19] rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-black"
                href="#" onclick="confirmar()">
                {{ __('Quitar Video') }}
            </a>
        @endif
        <br>
       
    </div>
   
    <script>
        function previewVideo() {
                var reader = new FileReader();
                reader.readAsDataURL(document.getElementById('videoUpload').files[0]);
                const file = document.getElementById('videoUpload').files[0];
                var fileInput = document.getElementById('videoUpload');
                var filePath = fileInput.value;
                var allowedExtensions = /(.mpg|.avi|.mpeg|.mp4)$/i; 
                if (!allowedExtensions.exec(filePath)) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: 'error',
                        title: 'Hay errores en el video.',
                        text: 'Solo se admiten archivos con extensión  avi, .mpg, .mpeg, .mp4 .',
                        showConfirmButton: true,
                    });
                    fileInput.value = '';
                    document.getElementById("mensaje_cambio_video").innerHTML = '';
                    return false;
                } else {
                    reader.onload = function(e) {
                        let blobURL = URL.createObjectURL(file);                      
                        document.querySelector("video").src = blobURL;
                        document.getElementById('videoUpload').src = e.target.result;
                       // document.getElementById('btnrm').style.display = 'block';
                        document.getElementById("mensaje_cambio_video").innerHTML =
                            '  Haz seleccionado un video, debes presionar "GUARDAR VIDEO" para guardarlo, sino se perdera.'
                        // document.getElementById('lblportada' + nb).style.display = 'inline';

                    };
                };




            }
    </script>



    <script>
        function verifico_cartel() {
            var video = document.getElementById("videoUpload").value;
            if (video !== "") {
                emito_mensaje();
            }
        }
    </script>

<script>
    function limpiar_video() {
        document.getElementById('videoUpload').value = null;
         document.querySelector("video").src = '';
        //document.getElementById('uploadPreview').src = "{{ config('app.url') }}/img/logo.png";
       // document.getElementById('btnrm').style.display = 'none';
        //document.getElementById('lblportada' + nb).style.display = 'none';
       
        document.getElementById("mensaje_cambio_video").innerHTML = '';


    }
</script>



    <script>
        function confirmar() {
            Swal.fire({
                title: 'Seguro quiere eliminar este video?',
                text: "Si continua no se podrá revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Quitemoslo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('eliminar_video', $anuncio) }}";
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Aguarda. Estamos eliminando tu video.',
                        showConfirmButton: false,
                        timer: 3000
                    })

                }
            })
        }
    </script>
</div>
