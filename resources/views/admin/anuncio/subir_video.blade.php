@extends('adminlte::page')

@section('template_title')
    {{ $anuncio->name ?? 'Gest. Imágenes' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Video del Anuncio</span>
                        </div>
                        <div class="float-right">

                            <a class="btn btn-primary" href="{{ route('admin.anuncios.show', $anuncio) }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $anuncio->user ? '(' . $anuncio->user->id . ') ' . $anuncio->user->name : 'N/D' }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $anuncio->nombre }}
                        </div>

                        <form method="POST" action="{{ route('admin.anuncios.guardar_video', $anuncio) }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @if (is_null($anuncio->video))
                               
                            @endif
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="col">
                                        <div class="image-wrapper">
                                            <video width="320" height="240" controls src=''>
                                               
                                            </video>
                                        </div>

                                    </div>
                                    <input class="form-control mx-auto mt-5" id="videoUpload" type="file" name="image"
                                        accept="video/*" onchange="previewImage();" />
                                </div>
                                <br>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                        </form>


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
        <script>
            function limpiar() {
                var $img = $user - > imagen_verificacion;
                if (img) {
                    document.getElementById('uploadPreview').src = "{{config('app.url')}}/img/logo.png";
                } else {
                    document.getElementById('uploadPreview').src = "{{config('app.url')}}/images/perfil/".$user - > id.
                    '/'.$user - > imagen_verificacion;
                }

                document.getElementById('btnrm').style.display = 'none';
                //document.getElementById('lblportada' + nb).style.display = 'none';

                document.getElementById('uploadImage').value = '';
            }
        </script>





    </section>
@endsection
