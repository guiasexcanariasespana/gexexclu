@extends('adminlte::page')

@section('template_title')
    {{ $anuncio->name ?? 'Gest. Imágenes' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Registrar Pago</h5>
                        <a class="btn btn-primary" href="{{ route('admin.anuncios.show', $anuncio) }}">
                            <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Usuario:</strong>
                            {{ $anuncio->user ? '('.$anuncio->user->id.') '.$anuncio->user->name : 'N/D' }}
                        </div>
                        <div class="mb-3">
                            <strong>Nombre:</strong>
                            {{ $anuncio->nombre }}
                        </div>

                        <form method="POST" action="{{ route('admin.anuncios.store_pago', $anuncio) }}" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="user_id" value="{{ $pago->user_id }}" class="form-control @error('user_id') is-invalid @enderror">

                            <div class="mb-3">
                                <label for="mail_pago" class="form-label">Correo de Pago</label>
                                <input type="text" name="mail_pago" id="mail_pago" value="{{ $pago->mail_pago }}" 
                                    class="form-control @error('mail_pago') is-invalid @enderror" placeholder="Mail Pago">
                                @error('mail_pago')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="anuncio_id" value="{{ $pago->anuncio_id }}" class="form-control @error('anuncio_id') is-invalid @enderror">

                            <div class="mb-3">
                                <label for="moneda_precio" class="form-label">Moneda Precio</label>
                                <input type="text" name="moneda_precio" id="moneda_precio" value="EUR" 
                                    class="form-control @error('moneda_precio') is-invalid @enderror" placeholder="Moneda Precio">
                                @error('moneda_precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" name="precio" id="precio" value="{{ $pago->precio }}" 
                                    class="form-control @error('precio') is-invalid @enderror" placeholder="Precio">
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="moneda_pago" class="form-label">Moneda de Pago</label>
                                <input type="text" name="moneda_pago" id="moneda_pago" value="{{ $pago->moneda_pago }}" 
                                    class="form-control @error('moneda_pago') is-invalid @enderror" placeholder="Moneda Pago">
                                @error('moneda_pago')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="monto_pago" class="form-label">Monto de Pago</label>
                                <input type="text" name="monto_pago" id="monto_pago" value="{{ $pago->monto_pago }}" 
                                    class="form-control @error('monto_pago') is-invalid @enderror" placeholder="Monto Pago">
                                @error('monto_pago')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="medio_pago" class="form-label">Medio de Pago</label>
                                <input type="text" name="medio_pago" id="medio_pago" value="{{ $pago->medio_pago }}" 
                                    class="form-control @error('medio_pago') is-invalid @enderror" placeholder="Medio Pago">
                                @error('medio_pago')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nro_transac" class="form-label">Número de Transacción</label>
                                <input type="text" name="nro_transac" id="nro_transac" value="{{ $pago->nro_transac }}" 
                                    class="form-control @error('nro_transac') is-invalid @enderror" placeholder="Nro Transac">
                                @error('nro_transac')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="fecha_transac" class="form-label">Fecha de Transacción</label>
                                <input type="date" name="fecha_transac" id="fecha_transac" value="{{ $pago->fecha_transac }}" 
                                    class="form-control @error('fecha_transac') is-invalid @enderror" placeholder="Fecha Transaccion">
                                @error('fecha_transac')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <p class="fw-bold">Estado</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="estado" id="estado_aprobado" 
                                        value="Aprobado" {{ ($anuncio->estado == '' || $anuncio->estado == 'Aprobado') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="estado_aprobado">Aprobado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="estado" id="estado_rechazado" 
                                        value="Rechazado" {{ $anuncio->estado == 'Rechazado' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="estado_rechazado">Rechazado</label>
                                </div>
                                @error('estado')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ __('Submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        document.getElementById("videoUpload").addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                let blobURL = URL.createObjectURL(file);
                document.querySelector("video").src = blobURL;
            }
        });

        function limpiar() {
            const preview = document.getElementById('uploadPreview');
            const btnRemove = document.getElementById('btnrm');
            const uploadInput = document.getElementById('uploadImage');
            
            @if($user->imagen_verificacion)
                preview.src = '/images/perfil/{{ $user->id }}/{{ $user->imagen_verificacion }}';
            @else
                preview.src = "/img/logo.png";
            @endif
            
            btnRemove.style.display = 'none';
            uploadInput.value = '';
        }
    </script>
@endsection