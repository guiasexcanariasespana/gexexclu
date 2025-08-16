@extends('adminlte::page')

@section('template_title')
    {{__('Create')}} SMS Notificaciones
@endsection
        @vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title"> {{__('Create')}} SMS Notificaciones</span>
                    <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('smsnotifications.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('smsnotifications.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.smsnotification.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
