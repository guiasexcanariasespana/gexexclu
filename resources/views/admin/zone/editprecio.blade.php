@extends('adminlte::page')

@section('template_title')
    {{__('Update')}} {{__('Precio')}} 
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Update')}} {{__('Precio')}}</span>
                    </div>
                    <div class="card-body">
                        <form method="get" action="{{ route('zone.update_precio', $precio->id) }}"  role="form">
                            
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
