@extends('adminlte::page')

@section('title', __('Update') . ' Provincia')

@section('content')
<section class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">

            @includeif('partials.errors')

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">{{ __('Update') }} Provincia</h5>
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
                                    <a class="nav-link active" href="#tab1" data-bs-toggle="tab" role="tab">Notas</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="#tab2" data-bs-toggle="tab" role="tab">SEO</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" href="#tab3" data-bs-toggle="tab" role="tab">Acción</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                    @include('admin.provincia.form')
                                </div>

                                <div class="tab-pane fade" id="tab2" role="tabpanel">
                                    @include('admin.anuncio.partial.seo')
                                </div>

                                <div class="tab-pane fade" id="tab3" role="tabpanel">
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
        // Slug generator
        if(document.getElementById('nombre') && document.getElementById('slug')) {
            document.getElementById('nombre').addEventListener('input', function() {
                document.getElementById('slug').value = this.value
                    .toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w-]+/g, '');
            });
        }

        // CKEditor
        if(document.querySelector('#texto_seo')) {
            ClassicEditor
                .create(document.querySelector('#texto_seo'))
                .catch(error => {
                    console.error(error);
                });
        }
    });
</script>
@endsection