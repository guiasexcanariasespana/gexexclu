@extends('adminlte::page')

@section('template_title')
    {{ $anuncio->name ?? 'Gest. Imágenes' }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <span class="card-title">Definir Imágen de Portada</span>
            </div>
            <div class="float-right">

                <a class="btn btn-primary" href="{{ route('admin.anuncios.show', $anuncio) }}">
                    {{ __('Back') }}</a>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group">
                <strong>Imagenes a Cargar:</strong>
                {{ $anuncio->imagenes_pendientes() }}
            </div>
            <div class="form-group">
                <strong>Imágenes a Verificar:</strong>
                {{ $anuncio->cantidad_img_verificar() }}
            </div>
            <div class="form-group">
                <strong>Usuario:</strong>
                {{ $anuncio->user ? '(' . $anuncio->user->id . ') ' . $anuncio->user->name : 'N/D' }}
            </div>
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $anuncio->nombre }}
            </div>



            <form method="POST" action="{{ route('admin.anuncios.guardar_portada', $anuncio) }}" role="form"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @foreach ($anuncio->imagenes_verificadas_ordenadas as $img)
                        <div class="col-sm-3">
                            @php
                            $portada = false;
                                if (!is_null($img) and !is_null($anuncio->portada_id)) {
                                    if ($img->id == $anuncio->portada_id) {
                                        $portada = true;
                                    }
                                }
                                
                            @endphp

                            <div class="card card-outline @if($portada)card-danger @else card-success @endif">
                                <div class="card-header">
                                    <div class="float-left">
                                        <span class="card-title">Imágen {{ $img->position }}</span>
                                    </div>
                                    <div class="float-right">
                                        @if (!is_null($img) and !is_null($anuncio->portada_id))
                                            @if ($img->id == $anuncio->portada_id)
                                                Portada
                                            @endif
                                        @endif

                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group">


                                        <div class="image-wrapper">
                                            <a href="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                data-toggle="lightbox" data-gallery="gallery">
                                                <img src="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                    class="img-fluid mb-2">
                                            </a>
                                        </div>
                                        <label class="mr-2">
                                            {!! Form::radio('portada_id', $img->id, $anuncio->portada_id == $img->id) !!}
                                            <b>Portada:</b>
                                        </label><br>
                                        <b>Nombre:</b> {{ $img->nombre }}<br>
                                        <b>Ubicación:</b> {{ $img->position }}<br>
                                        <b>Portada Solicitada:</b> {{ $img->portada }}




                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="box-footer mt20">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>
            </form>


        </div>
    </div>
@endsection
