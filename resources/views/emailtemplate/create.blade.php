@extends('layouts.app')

@section('page-title', trans('Templates'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Novi template') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('app.emailtemplate')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('app.emailtemplate')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    @include('partials.messages')




    {!! Form::open(['method'=>'POST', 'route'=>'emailtemplate.store','files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('name_label','Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>


    {{--<div class="form-group">--}}
    {{--{!! Form::label('mail_from_address_label','From email address:') !!}--}}
    {{--{!! Form::text('mail_from_address',null,['class'=>'form-control']) !!}--}}
    {{--</div>--}}


    <div class="form-group">
        {!! Form::label('subject_label','Subject:') !!}
        {!! Form::text('subject',null,['class'=>'form-control']) !!}
    </div>



    {{--<div class="form-group">--}}

    {{--{!! Form::label('file_label',' File Upload' )!!}--}}
    {{--{!! Form::file('file',['class'=>'form-control']) !!}--}}

    {{--</div>--}}



    <!-- tinyeditor - text editor  -->

    {{--@include('includes.tinyeditor')--}}

    <div class="form-group">
        {!! Form::label('text_body','Body:') !!}
        {!! Form::textarea('body',null,['class'=>'form-control']) !!}


    </div>

    <div class="form-group">
        {!! Form::label('landing_url','Landing URL:') !!}
        {!! Form::text('landing_url',null,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::label('landing_page_html','Landing page HTML:') !!}
        {!! Form::textarea('landing_page_html',null,['class'=>'form-control']) !!}


    </div>

    <div class="form-group">
        {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
    </div>





    {!! Form::close() !!}
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js ')}}"></script>
    <script>
        CKEDITOR.replace( 'body' );
    </script>


    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js ')}}"></script>
    <script>
        CKEDITOR.replace( 'landing_page_html' );
    </script>
@stop
