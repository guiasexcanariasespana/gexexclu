@extends('adminlte::page')

@section('template_title')
    {{__('Create')}} {{__('Precio')}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Create')}} {{__('Precio')}} </span>
                         <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('zones.show', $zone) }}">{{__('Back')}} </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('zone.store_precio') }}"  role="form" >
                            @csrf

                           @include('admin.zone.formprecio')

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
        $("#name").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#slug',
        space: '-'
        });
    });
    </script>

@endsection
