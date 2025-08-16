@extends('adminlte::page')

@section('template_title')
    {{__('Create')}} {{__('Clase')}}
@endsection
        @vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Create')}} {{__('Clase')}}</span>
                                                <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clases.index') }}">{{ __('Back') }} </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('clases.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.clase.form')

                        </form>
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

@endsection
