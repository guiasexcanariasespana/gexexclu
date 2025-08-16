@extends('adminlte::page')

@section('template_title')
    {{__('Create')}} Forma Pago
@endsection
        @vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Create')}} Forma Pago</span>
                                                <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('formapagos.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('formapagos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.formapago.form')

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