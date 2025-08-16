           <div class="mt-5 mb-5">
               <div class="w-full mb-5">
                   <div class="col">
                       <div class="image-wrapper">
                           <video width="650" height="400" controls loading="lazy"
                               @if (!is_null($anuncio->video)) src="{{ config('app.url') . '/videos/anuncios/' . $anuncio->id . '/' . $anuncio->video }}">
                                @else
                                    src='' @endif>
                           </video>
                       </div>

                   </div>

               </div>
               @if (is_null($anuncio->video))
                   <form method="POST" action="{{ route('guardar_video', $anuncio) }}" role="form"
                       enctype="multipart/form-data">
                       @csrf
                       <input class="form-control mt-5" id="videoUpload" type="file" name="image" accept="video/*"
                           required onchange="previewImage();" />
                       <br>
                       <div class="box-footer mb-5">
                           <button type="submit" onclick="verifico_cartel();"
                               class="btn text-white bg-[#bb1a19] border border-[#bb1a19] rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-black">{{ __('Submit') }}
                               Video
                           </button>
                           <a class="btn text-white bg-gary-700 border rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-black"
                               href="{{ route('dashboard') }}">
                               {{ __('Cancelar') }}
                           </a>
                           <p class="mt-4">
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
               document.getElementById("videoUpload")
                   .onchange = function(event) {
                       let file = event.target.files[0];
                       let blobURL = URL.createObjectURL(file);
                       document.querySelector("video").src = blobURL;
                       document.getElementById("mensaje_cambio_video").innerHTML =
                           ' Haz seleccionado un video, debes presionar "GUARDAR VIDEO" para guardarlo, sino se perdera.'
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
