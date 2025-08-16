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

        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl tracking-tight font-black text-transparent  text-pink-700">
                Gestiona las imágenes de tu anuncio.</h2>

            <p class="max-w-xl mx-auto mt-8 lg:text-xs sm:leading-relaxed sm:text-xs">
                Cada imágen tiene un orden, el mismo orden que tendrán en tu anuncio</p>

        </div>
        <form action="{{ route('guardar_imagenes', $anuncio) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container mx-auto">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div class="flex justify-center p-6 text-1xl bg-gray-100 border-2 border-gray-300 rounded-xl">
                        <div class="upload_image col-md-12">

                            <div class="col-md-2">
                                @if (is_null(Auth::user()))
                                    <img id="uploadPreview{{ $i }}" class="object-contain h-48 w-full"
                                        src="{{config('app.url')}}/img/logo.png" />
                                    <div class="form-group col-md-10">
                                        <div id="porta{{ $i }}" style="display: none">
                                            <span id='lblportada{{ $i }}'
                                                class="label-text text-3xl font-bold text-pink-700">portada</span>
                                            <input type="radio" name="portada" id='portada{{ $i }}'
                                                value="{{ $i }}" class="radio radio-primary" />
                                        </div>
                                        <button id="btnrm{{ $i }}" name="button"
                                            onclick="limpiar({{ $i }}); return false;"
                                            class="mt-5 mb-5 px-6 py-3 text-sm font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-white focus:outline-none focus:ring"
                                            style="display: none">Quitar</button>
                                        <label>Image {{ $i }}</label>
                                        <input class="form-control" id="uploadImage{{ $i }}" type="file"
                                            name="images[{{ $i }}]" accept="image/*"
                                            onchange="previewImage({{ $i }});" />
                                    </div>
                                @else
                                    <img id="uploadPreview{{ $i }}" class="object-contain h-48 w-full"
                                        src="{{ '{{config('app.url')}}/images/anuncio/' . $anuncio->id . '/' . $imagen->nombre }}" />
                                    <span class="label-text text-3xl font-bold text-pink-700">portada</span>
                                    <input type="radio" name="portada" value="{{ $i }}"
                                        {{ $imagen->portada == 'Si' ? 'checked="checked"' : '' }}
                                        class="radio radio-primary" />
                                    <p>{{ $imagen->estado }}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div>
                <input type="submit"
                    class="mt-10 mb-10 px-12 py-3 text-lg font-medium text-white bg-pink-600 border border-pink-600 rounded sm:w-auto active:text-opacity-75 hover:bg-transparent hover:text-white focus:outline-none focus:ring"
                    value="{{ __('Submit') }}">

            </div>
        </form>
        <a class="btn btn-sm btn-primary " href="{{ route('dashboard', $anuncio) }}"><i class="fa fa-fw  fa-eye"></i>
            {{ __('Back') }}
        </a>
    </section>


    <script>
        function previewImage(nb) {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById('uploadImage' + nb).files[0]);
            reader.onload = function(e) {
                document.getElementById('uploadPreview' + nb).src = e.target.result;
                document.getElementById('btnrm' + nb).style.display = 'block';
                // document.getElementById('lblportada' + nb).style.display = 'inline';
                document.getElementById('porta' + nb).style.display = 'block';
            };
        }
    </script>
    <script>
        function limpiar(nb) {
            document.getElementById('uploadPreview' + nb).src = "{{config('app.url')}}/img/logo.png";
            document.getElementById('btnrm' + nb).style.display = 'none';
            //document.getElementById('lblportada' + nb).style.display = 'none';
            document.getElementById('porta' + nb).style.display = 'none';

            document.getElementById('uploadImage' + nb).value = '';;
        }
    </script>
</x-registro-layout>
