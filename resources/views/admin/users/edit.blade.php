@extends('adminlte::page')

@section('title', 'Gmarket ADMIN PANEL')

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{__('Update')}} {{__('Usuario')}}</span>
                    </div>
                    <div class="card-body">
                        {{ Form::model($user, ['route' => ['admin.users.update', $user->id]]) }}
                        {{-- <form method="POST" action="{{ route('admin.users.update', $user->id) }}"  role="form" enctype="multipart/form-data"> --}}
                        {{ method_field('PATCH') }}
                        @csrf

                        @include('admin.users.formuseredit')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
