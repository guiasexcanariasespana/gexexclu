@extends('adminlte::page')

@section('template_title')
    {{__('Create')}} {{__('Lugar')}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Create')}} {{__('Lugar')}}</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('lugars.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('lugars.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('admin.lugar.form')

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