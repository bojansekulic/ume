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


    {!! Form::open(['method'=>'POST', 'route'=>'process_contact']) !!}
    {{--{{ Form::open(['method'=>'POST', 'route'=>'process_contact']) }}--}}
    {{ csrf_field() }}

    <div class="panel-body">
        {{ Form::label('name_label', 'Group:') }}
        {!! Form::select('group_id', $lists,null, ['class' => 'form-control','placeholder' => 'Choose a group']) !!}

    </div>

    <div class="form-group">
        {!! Form::label('name_label','Name:') !!}
        {!! Form::text('f_name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('l_name_label','Last Name:') !!}
        {!! Form::text('l_name',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email_label','Email:') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::button('Save', ['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>





    {!! Form::close() !!}


@stop




