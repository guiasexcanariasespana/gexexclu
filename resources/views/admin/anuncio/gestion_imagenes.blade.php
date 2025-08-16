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
                            <span class="card-title">Gestión Imágenes</span>
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


                        @foreach ($anuncio->imagens->sortBy('estado') as $img)
                            <div class="form-group">
                                <div class="col-sm-3">
                                    <div class="col">
                                        <div class="image-wrapper">
                                            <a href="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                data-toggle="lightbox" data-gallery="gallery">
                                                <img src="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                    class="img-fluid mb-2">
                                            </a>
                                        </div>
                                        
                                        <b>Nombre:</b> {{ $img->nombre }}<br>
                                        <b>Ubicación:</b> {{ $img->position }}<br>
                                        <b>Portada Solicitada:</b> {{ $img->portada }}<br>
                                        <b>Estado:</b> {{ $img->estado }}
                                    </div>

                                    @if ($img->estado == 'Pendiente' or $img->estado == 'Rechazado')
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('admin.imagens.aceptar_imagen', $img) }}">
                                            {{ __('Aprobar') }}</a>
                                    @endif
                                    <a class="btn btn-info btn-sm" target="blank"
                                        href="{{ '/images/anuncio/' . $anuncio->id . '/original/' . $img->nombre }}">
                                        {{ __('Ver Original') }}</a>
                                    @if ($img->estado == 'Pendiente' or $img->estado == 'Verificada')
                                        <a class="btn btn-danger btn-sm"
                                            href="{{ route('admin.imagens.rechazar_imagen', $img) }}">
                                            {{ __('Rechazar') }}</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
