@extends('adminlte::page')

@section('template_title')
    {{ $anuncio->name ?? 'Gest. Imágenes' }}
@endsection

@section('content')
    

       <form method="POST" action="{{ route('admin.imagenes.guardar_orden', $anuncio) }}" role="form"
        enctype="multipart/form-data">
        <div class="row">
           
                @csrf
                @php
                    $i = 0;
                @endphp
                @foreach ($anuncio->imagenes_ordenadas as $img)
                    @php
                        $i += 1;
                        $portada = false;
                                if (!is_null($img) and !is_null($anuncio->portada_id)) {
                                    if ($img->id == $anuncio->portada_id) {
                                        $portada = true;
                                    }
                                }
                    @endphp
                    <div class="col-sm-3">
                        <div class="card card-outline @if ($portada) card-danger @else card-success @endif">
                            <div class="card-header">
                                <div class="float-left">
                                <span class="card-title">Imágen {{ $img->position }}</span>
                            </div>
                            <div class="float-right">
                                @if ($portada)                                  
                                            Portada
                                @endif

                            </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="col">
                                            <div class="image-wrapper">
                                                <a href="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                    data-toggle="lightbox" data-gallery="gallery">
                                                    <img src="{{ '/images/anuncio/' . $anuncio->id . '/' . $img->nombre }}"
                                                        class="img-fluid mb-2 ">
                                                </a>
                                            </div>
                                            <b>Nombre:</b> {{ $img->nombre }}
                                            <b>Ubicación:</b> <input type="number" name='imagen[{{ $i }}]'
                                                id='imagen{{ $i }}' value={{ $img->position }}>
                                            <input type="hidden" name='image_id[{{ $i }}]'
                                                id='image_id{{ $i }}' value={{ $img->id }}>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
              
        </div>
        <div class="box-footer mt20">
            
            <a class="btn btn-success" href="{{ route('admin.anuncios.show', $anuncio) }}">
                {{ __('Back') }}</a>
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
        
     </form>
   
@endsection
