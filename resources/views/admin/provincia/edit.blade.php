@extends('adminlte::page')

@section('title', __('Update') . ' Provincia')

@section('content')

<section class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            @includeIf('partials.errors')

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h1 class="card-title mb-0">{{ __('Update') }} Provincia</h1>
                </div>
                
                <form method="POST" action="{{ route('provincias.update', $provincia) }}" 
                      class="needs-validation" novalidate 
                      enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PATCH')

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="tab1-btn" data-bs-toggle="tab" 
                                            data-bs-target="#tab1" type="button" role="tab" 
                                            aria-controls="tab1" aria-selected="true">
                                        Notas
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab2-btn" data-bs-toggle="tab" 
                                            data-bs-target="#tab2" type="button" role="tab" 
                                            aria-controls="tab2" aria-selected="false">
                                        SEO
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab3-btn" data-bs-toggle="tab" 
                                            data-bs-target="#tab3" type="button" role="tab" 
                                            aria-controls="tab3" aria-selected="false">
                                        Acción
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-btn">
                                    @include('admin.provincia.form')
                                </div>

                                <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-btn">
                                    @include('admin.anuncio.partial.seo')
                                </div>

                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-btn">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="fas fa-save me-2"></i>{{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@vite(['resources/js/string-to-slug.js'])
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Slug generator mejorado
        const nombreInput = document.getElementById('nombre');
        const slugInput = document.getElementById('slug');
        
        if(nombreInput && slugInput) {
            nombreInput.addEventListener('input', function() {
                slugInput.value = this.value
                    .toLowerCase()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '') // Elimina acentos
                    .replace(/\s+/g, '-')
                    .replace(/[^\w-]+/g, '')
                    .replace(/--+/g, '-')
                    .replace(/^-+|-+$/g, '');
            });
        }

        // CKEditor
        const textoSecElement = document.querySelector('#texto_seo');
        if(textoSecElement) {
            ClassicEditor
                .create(textoSecElement)
                .catch(error => {
                    console.error('Error inicializando CKEditor:', error);
                });
        }

        // Validación de formulario nativa
        const form = document.querySelector('.needs-validation');
        if(form) {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        }

        // Mejor manejo de pestañas
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const target = document.querySelector(button.getAttribute('data-bs-target'));
                if(target) {
                    target.classList.add('show');
                }
            });
        });
    });
</script>
@endsection