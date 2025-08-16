@extends('adminlte::page')

@section('template_title')
      {{__('Update')}} SMS Notificaciones
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Update')}} SMS Notificaciones</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('smsnotifications.index') }}"> {{__('Back')}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('smsnotifications.update', $smsnotification->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('admin.smsnotification.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
