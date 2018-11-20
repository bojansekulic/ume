@extends('layouts.app')

@section('page-title', trans('Templates'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Edit Group Name') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('group name')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('group name')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    @include('partials.messages')


    {!! Form::open(['method'=>'POST', 'route'=>'update-single-contact']) !!}
    {{--{{ Form::open(['method'=>'POST', 'route'=>'process_contact']) }}--}}
    {{ csrf_field() }}



    <div class="form-group">
        {!! Form::label('name_label','Name:') !!}
        {!! Form::text('first_name',$detail->first_name,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('l_name_label','Last Name:') !!}
        {!! Form::text('last_name',$detail->last_name,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email_label','Email:') !!}
        {!! Form::text('email',$detail->email,['class'=>'form-control']) !!}
    </div>


    {{Form::hidden('id',$detail->id)}}
    <div class="form-group">
        {!! Form::button('Save', ['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>





    {!! Form::close() !!}


@stop