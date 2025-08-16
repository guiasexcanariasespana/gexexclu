    <strong>Foto Verificación:</strong>
    @if (is_null($anuncio->imagen_verificacion))
        Aún no subió una imagen para verificar su perfil.
        <form method="POST" action="{{ route('admin.subir_verificar_perfil', $anuncio) }}" role="form"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">


                <div class="image-wrapper">
                    <img id="uploadPerfilPreview" class="img-fluid" src="{{ config('app.url') }}/img/logo.png" />
                    <button id="btnrm" name="button" onclick="limpiar_perfil(); return false;"
                        style="display: none">Quitar
                    </button>
                </div>


                <input class="form-control mx-auto mt-5" id="uploadPerfil" type="file" name="uploadPerfil"
                    accept="image/png, image/jpeg, image/jpg" required onchange="previewPerfil();" />

                <br>
                <div class="box-footer mt20">
                    <button type="submit" class="btn btn-primary  bg-blue-600  ">{{ __('Submit') }} Foto Verif.</button>
                </div>
            </div>
        </form>
    @else
        <div class="col-lg-6 mb-2">
            <a href="{{ config('app.url') . '/images/perfil/' . $anuncio->id . '/' . $anuncio->imagen_verificacion }}"
                data-toggle="lightbox" data-gallery="gallery">
                <img src="{{ config('app.url') . '/images/perfil/' . $anuncio->id . '/' . $anuncio->imagen_verificacion }}"
                    class=" img-fluid img-thumbnail" style="height: 100px;">
            </a>
        </div>
        <div class="form-group">
            <a class="btn btn-info btn-sm" target="blank"
                href="{{ config('app.url') . '/images/perfil/' . $anuncio->id . '/' . $anuncio->imagen_verificacion }}">
                {{ __('Original') }}</a>

            <a class="btn btn-danger btn-sm" href="{{ route('admin.quitar_foto_verificacion', $anuncio) }}">
                {{ __('Rechazar Foto') }}</a>


        </div>
    @endif
