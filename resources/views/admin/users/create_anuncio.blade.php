@extends('adminlte::page')

@section('template_title')
    {{__('Create')}} Anuncio
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Create')}} Anuncio</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('admin.users.show', $user) }}"> {{__('Back')}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store_anuncio', $user) }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.users.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')


<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
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

<script>
        ClassicEditor
        .create( document.querySelector( '#presentacion_aux' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
            .create(document.querySelector('#horario'))
            .catch(error => {
                console.error(error);
            });

</script>
    

@endsection