@extends('adminlte::page')

@section('title', $anuncio->name ?? __('Manage Images'))

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ __('Set Cover Image') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.anuncios.show', $anuncio) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left mr-1"></i> {{ __('Back') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-info"><i class="fas fa-upload"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('Images to Upload') }}</span>
                            <span class="info-box-number">{{ $anuncio->imagenes_pendientes() }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-warning"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('Images to Verify') }}</span>
                            <span class="info-box-number">{{ $anuncio->cantidad_img_verificar() }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="info-box bg-light">
                        <span class="info-box-icon bg-primary"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('User') }}</span>
                            <span class="info-box-number">
                                {{ $anuncio->user ? '('.$anuncio->user->id.') '.$anuncio->user->name : 'N/D' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <h5><i class="icon fas fa-info-circle"></i> {{ $anuncio->nombre }}</h5>
            </div>

            <form method="POST" action="{{ route('admin.anuncios.guardar_portada', $anuncio) }}" class="needs-validation" novalidate>
                @csrf
                
                <div class="row g-3">
                    @foreach ($anuncio->imagenes_verificadas_ordenadas as $img)
                        @php
                            $isCover = $anuncio->portada_id && $img->id == $anuncio->portada_id;
                        @endphp
                        
                        <div class="col-md-4 col-lg-3">
                            <div class="card h-100 border-{{ $isCover ? 'danger' : 'success' }}">
                                <div class="card-header d-flex justify-content-between align-items-center bg-{{ $isCover ? 'danger' : 'success' }} text-white">
                                    <span>{{ __('Image') }} #{{ $img->position }}</span>
                                    @if($isCover)
                                        <span class="badge bg-white text-dark">{{ __('Cover') }}</span>
                                    @endif
                                </div>
                                
                                <div class="card-body text-center">
                                    <a href="{{ asset('images/anuncio/'.$anuncio->id.'/'.$img->nombre) }}" 
                                       data-toggle="lightbox" data-gallery="gallery-{{ $anuncio->id }}">
                                        <img src="{{ asset('images/anuncio/'.$anuncio->id.'/'.$img->nombre) }}" 
                                             class="img-fluid rounded mb-3" alt="Image {{ $img->position }}" style="max-height: 150px;">
                                    </a>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="portada_id" 
                                               id="portada_{{ $img->id }}" value="{{ $img->id }}"
                                               @checked($isCover)>
                                        <label class="form-check-label font-weight-bold" for="portada_{{ $img->id }}">
                                            {{ __('Set as Cover') }}
                                        </label>
                                    </div>
                                    
                                    <div class="mt-2 text-left small">
                                        <div><strong>{{ __('Name') }}:</strong> {{ $img->nombre }}</div>
                                        <div><strong>{{ __('Position') }}:</strong> {{ $img->position }}</div>
                                        <div><strong>{{ __('Requested as Cover') }}:</strong> 
                                            <span class="badge bg-{{ $img->portada ? 'success' : 'secondary' }}">
                                                {{ $img->portada ? __('Yes') : __('No') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card-footer text-right mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendor/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true,
                    showArrows: true,
                    wrapping: false
                });
            });
        });
    </script>
@endsection