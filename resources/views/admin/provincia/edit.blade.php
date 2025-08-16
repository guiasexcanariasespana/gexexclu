@extends('adminlte::page')

@section('template_title')
{{__('Update')}} Provincia
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">{{__('Update')}} Provincia</span>
                </div>
                <div class="card-body">
                    {!! Form::model($provincia, [
                    'route' => ['provincias.update', $provincia],
                    'autocomplete' => 'off',
                    'files' => true,
                    'method' => 'post',
                    'class' => 'w-100',
                    ]) !!}
                    @csrf
                    {{-- <form method="POST" action="{{ route('provincias.update', $provincia) }}" role="form" enctype="multipart/form-data"> --}}
                    {{ method_field('PATCH') }}



                </div>
            </div>
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">Notas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">Seo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab3" data-toggle="tab">Accion</a></li>

                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            @include('admin.provincia.form')


                        </div>
                        <div class="tab-pane" id="tab2">


                            @include('admin.anuncio.partial.seo')

                        </div>

                        <div class="tab-pane" id="tab3">


                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>

                        </div>

                        </form>
                    </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
    </div>
</section>
@endsection

@section('js')

<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

<script>
    $(document).ready(function() {
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