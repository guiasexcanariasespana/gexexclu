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

        <div class="hero min-h-screen bg-base-200">

            <div class="hero-content text-center">
                <div class="max-w-md">

                    <h2 class="text-4xl tracking-tight font-black text-transparent  text-pink-700">
                        Subir Video.</h2>
                    <div class="grid grid-cols-1 gap-6  md:grid-cols-1 lg:grid-cols-1">
                        <div
                            class="flex justify-center p-6 text-1xl bg-gray-100 border-2 border-gray-300 rounded-xl mt-6">
                            <div class="upload_image col-md-12">
                                <div class="form-group mx-auto col-md-10">

                                    <form method="POST" action="{{ route('guardar_video', $anuncio) }}" role="form"
                                        enctype="multipart/form-data">
                                        @csrf

                                        @if (is_null($anuncio->video))
                                        @endif
                                        <div class="form-group">
                                            <div class="col-sm-3">
                                                <div class="col">
                                                    <div class="image-wrapper">
                                                        <video width="320" height="240" controls
                                                            @if (!is_null($anuncio->video)) src="{{ '/videos/anuncios/' . $anuncio->id . '/' . $anuncio->video }}">
                                                            
                                                            @else
                                                            src='' @endif>
                                                        </video>
                                                    </div>

                                                </div>
                                                <input class="form-control mx-auto mt-5" id="videoUpload" type="file"
                                                    name="image" accept="video/*" onchange="previewImage();" />
                                            </div>
                                            <br>
                                            <div class="box-footer mt20">
                                                <button type="submit"
                                                    class="btn btn-primary">{{ __('Submit') }}</button>
                                                <a class="btn btn-primary text-white bg-blue-600 border border-blue-600  hover:bg-transparent hover:text-pink-700 focus:outline-none <"
                                                    href="{{ route('dashboard', $anuncio) }}">
                                                    {{ __('Cancelar') }}
                                                </a>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            document.getElementById("videoUpload")
                .onchange = function(event) {
                    let file = event.target.files[0];
                    let blobURL = URL.createObjectURL(file);
                    document.querySelector("video").src = blobURL;
                }
        </script>


</x-registro-layout>
