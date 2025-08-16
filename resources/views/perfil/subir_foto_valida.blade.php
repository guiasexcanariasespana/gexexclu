<x-registro-layout>
    <link rel="stylesheet" href="{{ url('public/cssjs/bootstrap.min.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
        .thumb {
            margin: 10px 5px 0 0;
            width: 300px;
        }
    </style>
    <section>
     
    <div class="hero min-h-screen bg-white">
       
        <div class="hero-content flex-col lg:flex-row-reverse">
           
                <div class="mb-20">
                    <img src="{{config('app.url')}}/img/validar_imagen.jpg" />

                </div>
                
                            
           
                
                <div class="grid w-1/2 grid-cols-1 gap-6  md:grid-cols-1 lg:grid-cols-1">
                    <h2 class="text-4xl tracking-tight font-black text-transparent  text-pink-700">
                        Validación de Perfil.</h2>
                        <span>Debes sacarte una foto como muestra la imagen ilustrativa.</br>
                            <strong> Cuerpo completo o cara con el cartel y los datos correspondientes.</span>
                                @if (!is_null($user->imagen_verificacion))
                                <div class="alert alert-warning shadow-lg">
                                    <div class="mb-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                        <span>Ya has subido una foto de verificación.</br>
                                        <strong> Aguarda que la verifiquemos.</span>
                                    </div>
                                </div>
                       
                                 @endif
                    <div class="justify-center p-6 text-1xl bg-gray-100 border-2 border-gray-300 rounded-xl mt-6">
                  
                        <div class="upload_image col-md-12">
                            <div class="form-group mx-auto col-md-10">
                                @if (is_null($user->imagen_verificacion))
                                    <img id="uploadPreview" class="object-contain h-48 w-full" src="{{config('app.url')}}/img/logo.png" />
                                @else
                                    
                                    <img id="uploadPreview" class="object-contain h-48 w-full"
                                        src="{{config('app.url') . '/images/perfil/' . $user->id . '/' . $user->imagen_verificacion }}" />
                                @endif
                                <form method="POST" action="{{ route('verificar_perfil', $user) }}"
                                    enctype="multipart/form-data" >
                                    @csrf



                                    <input class="form-control mx-auto mt-5" id="uploadImage" type="file" name="image" accept="image/*"
                                        onchange="previewImage();" />

                                    <input type="submit"
                                        class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-pink-700 focus:outline-none focus:ring"
                                        value="{{ __('Subir') }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
       
    </div>
       

        <script>
            const MAXIMO_TAMANIO_BYTES = 2000000;
            function previewImage() {
                var reader = new FileReader();
                reader.readAsDataURL(document.getElementById('uploadImage').files[0]);
                const archivo = document.getElementById('uploadImage').files[0]; 
            if (archivo.size > MAXIMO_TAMANIO_BYTES) {
                const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
                alert(`El tamaño máximo es ${tamanioEnMb} MB`);
               document.getElementById('uploadImage').value = '';
            } else {
                reader.onload = function(e) {
                    document.getElementById('uploadPreview').src = e.target.result;
                    document.getElementById('btnrm').style.display = 'block';
                    // document.getElementById('lblportada' + nb).style.display = 'inline';
                }
                };
            }
        </script>
        <script>
            function limpiar() {
                var $img = $user->imagen_verificacion;
                if (img) {
                    document.getElementById('uploadPreview').src = "{{config('app.url')}}/img/logo.png";
                } else {
                    document.getElementById('uploadPreview').src = '{{config('app.url')}}/images/perfil/'.$user->id.
                    '/'.$user->imagen_verificacion;
                }

                document.getElementById('btnrm').style.display = 'none';
                //document.getElementById('lblportada' + nb).style.display = 'none';

                document.getElementById('uploadImage').value = '';
            }
        </script>
</x-registro-layout>
