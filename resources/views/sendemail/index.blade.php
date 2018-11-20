@extends('layouts.app')

@section('page-title', trans('Templates'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('New TEST Email') }}
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



    @if (session()->has('emailsuccess'))

        <table>
            <div class="alert alert-success text-center animated fadeIn">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('emailsuccess') !!}
                </strong>
            </div>
        </table>
    @endif



    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif




    {!! Form::open(['method'=>'POST', 'route'=>'sendtestemail','files'=>true]) !!}

    <p><b>Template:</b></p>

    <div>{!! Form::select('templates',$templates, null, ['class' => 'form-control']) !!}  </div>

    </br>

    <p><b>Sending Profile:</b></p>
    <div>{!! Form::select('sending_profiles', $profiles, null, ['class' => 'form-control']) !!}</div>

    </br>

    <div class="form-group">
        {!! Form::label('mail_subject_label','Subject:') !!}
        {!! Form::text('subject',null,['class'=>'form-control']) !!}
    </div>
    <!--     <div class="form-group">
        {!! Form::label('mail_from_label','From Name:') !!}
    {!! Form::text('mail_from',null,['class'=>'form-control']) !!}
            </div> -->

    <!--
    <div class="form-group">
        {!! Form::label('mail_from_address_label','From email address:') !!}
    {!! Form::text('mail_from_address',null,['class'=>'form-control']) !!}
            </div> -->


    <div class="form-group">
        {!! Form::label('to_label','To:') !!}
        {!! Form::text('sending_to',null,['class'=>'form-control']) !!}
    </div>





    {{--<div class="form-group">--}}

    {{--{!! Form::label('text_body','Body:') !!}--}}
    {{--{!! Form::textarea('text_body',null,['id' => 'text_body','class'=>'form-control']) !!}--}}

    {{--</div>--}}


    <div class="form-group">
        {!! Form::submit('SEND', ['class'=>'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}


    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js ')}}"></script>
    <script>
        CKEDITOR.replace( 'text_body' );
    </script>


@stop