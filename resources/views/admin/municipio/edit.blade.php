@extends('adminlte::page')

@section('template_title')
    {{__('Update')}} Municipio
@endsection
    @vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                @includeif('partials.errors')               
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">Notas</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">Seo</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">Accion</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <span class="card-title">{{__('Update')}} Municipio</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('municipios.update', $municipio) }}"  role="form" enctype="multipart/form-data">
                                         {{ method_field('PATCH') }}
                                           @csrf
                                           @include('admin.municipio.form')                   
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2">
                                @include('admin.municipio.seo')
                            </div>
                            <div class="tab-pane" id="tab3">
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </div>
                                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

   <script>  
    $(document).ready( function() {
        $("#nombre").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#slug',
        space: '-'
        });
    });
    </script>

<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script>
   ClassicEditor
       .create(document.querySelector('#texto_seo'))
       .catch(error => {
           console.error(error);
       });
</script>

@endsection