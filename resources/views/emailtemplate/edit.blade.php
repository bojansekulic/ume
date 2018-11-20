@extends('layouts.app')

@section('page-title', trans('Templates'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Edit template') }}
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


{{--Edit form with route for update--}}

    {{ Form::open(['url' => 'update-template']) }}


    <div class="form-group">
        {!! Form::label('name_label','Name:') !!}
        {!! Form::text('name',$template->name,['class'=>'form-control']) !!}
    </div>





    <div class="form-group">
        {!! Form::label('subject_label','Subject:') !!}
        {!! Form::text('subject',$template->subject,['class'=>'form-control']) !!}
    </div>






    <!-- tinyeditor - text editor  -->

    {{--@include('includes.tinyeditor')--}}

    <div class="form-group">
        {!! Form::label('text_body','Body:') !!}
        {!! Form::textarea('text_body',$template->text,['class'=>'form-control']) !!}
    </div>


    {{Form::hidden('template_id',$template->id)}}

    <div class="form-group">
        {!! Form::button('Update', ['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>





    {!! Form::close() !!}

    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js ')}}"></script>
    <script>
        CKEDITOR.replace( 'text_body' );
    </script>
@stop




