@extends('adminlte::page')

@section('template_title')
    {{ __('Update') }} {{ __('Plane') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} {{ __('Plane') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('planes.index') }}"> {{ __('Back') }} </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('planes.update', $plane) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.planes.form')

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