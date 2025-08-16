<div>

    @if(!$show)

    <section class="bg-white ">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h2 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none  text-black"> Validación de Perfil.</h2>
                <p class="max-w-2xl  font-light text-gray-700  text-base ">Debes sacarte una foto como muestra la imagen ilustrativa.</p>
                <p class="max-w-2xl font-light text-gray-700 text-base  ">Cuerpo completo o cara con el cartel y los datos correspondientes..</p>
                @if ($show)
                <div class="alert alert-warning shadow-lg">
                    <div class="mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Ya has subido una foto de verificación.</br>
                            <strong> Aguarda que la verifiquemos.</span>
                    </div>
                </div>
                @endif
       
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ config('app.url') }}/img/validar_imagen.jpg" />
            </div>                
        </div>
    </section>




        <div class="grid grid-cols-1 bg-white mb-3">
        
            <div>

                <div class="justify-center m-2 p-2 md:p-6 lg:p-2 text-1xl bg-white border border-gray-300 -mt-20">
                   
                   
                    @if ($show)
                        <div class="alert alert-warning shadow-lg">
                            <div class="mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>Ya has subido una foto de verificación.</br>
                                    <strong> Aguarda que la verifiquemos.</span>
                            </div>
                        </div>
                    @endif
                    <div class="upload_image col-md-12">
                        <div class="form-group mx-auto col-md-10">
                            <span wire:loading wire:target="image"
                        class=" animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]">Cargando la imagen ...</span>
                            @if (is_null($anuncio->imagen_verificacion))
                                <img id="uploadPreview" class="object-contain mx-auto h-20 w-96"
                                    src="{{ config('app.url') }}/img/logo.png" />
                                <button id="btnrm" name="button" onclick="limpiar(); return false;"
                                    style="display: none">Quitar
                                </button>
                            @else
                                <img id="uploadPreview" class="object-contain h-48 w-full"
                                    src="{{ config('app.url')}}/images/perfil/{{$anuncio->id}}/{{$imagen_verificacion}}" />
                            @endif
                            {{-- <form method="POST" action="{{ route('verificar_perfil', $user) }}" --}} 
                                <form method="POST" wire:submit.prevent = 'submit'  enctype="multipart/form-data">
                                @csrf

                                <input class="form-control  " id="uploadImage" type="file" name="image"
                                    wire:model='image' accept="image/png, image/jpeg" required
                                   />
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror 
                                <br>                               
                                <input type="submit" wire:loading.remove wire:target="submit, image" id='subir_imagen'
                                    class="mt-5 mb-1 btn text-base text-white bg-[#bb1a19] border border-[#bb1a19] rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-black"
                                    value="{{ __('Subir Imagen') }}" onclick="verifico_cartel_verificacion();">
                                     <span wire:loading wire:target="submit, image"
                    class=" animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]">{{$mensaje}}</span>
                                <h2 class="font-black my-2">Debes hacer click una vez que haz seleccionado el archivo de imagen.</h2>
                                <h2 id='mensaje_cambio_verificacion'
                                    class=" animate-pulse text-2xl  my-2 font-bold text-base text-[#bb1a19]"></h2>
                            </form>
                        </div>
                    </div>
                </div>




            </div>


        </div>
    @else
        <h2 class=" py-3 px-2 rounded-lg border border-1">Ya has subido la foto de verificación, aguarda el mensaje de
            confirmación</h2>
        <img id="uploadPreview" class="object-contain h-[550px] mt-5 " loading="lazy"
            src="{{ config('app.url')}}/images/perfil/{{$anuncio->id}}/{{$imagen_verificacion}}" />
        @if ($anuncio->estado != 'Publicado' && ($anuncio->estado != 'A_Publicar') && ($anuncio->estado != 'Pausado'))
            <a class="mx-auto mt-5 mb-5 px-2 py-1 text-sm font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                href="#" onclick="confirmar_delete_imagen()">
                Eliminar Foto Verificacion
            </a>
        @endif
    @endif
           

    <script>
        function confirmar_delete_imagen() {
            Swal.fire({
                title: 'Seguro quiere eliminar esta foto?',
                text: "Si continua no se podrá revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, quitemosla!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('quitar_foto_verificacion', $anuncio) }}";
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Aguarda. Estamos eliminando tu foto.',
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            })
        }
    </script>

    <script>
        function verifico_cartel_verificacion() {
            var video = document.getElementById("uploadImage").value;
            if (video !== "") {
                emito_mensaje();
            }
        }
    </script>

    <script>
    function set_perfil() {
        alert("{{$imagen_verificacion}}")
        //document.getElementById("pic1").src= searchPic.src;
    }
</script>
</div>
