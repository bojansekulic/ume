@extends('layouts.app')

@section('page-title', trans('Sending profiles'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Edit profile') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('app.sendingprofile')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('app.sendingprofile')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    @include('partials.messages')


    {{--Edit form with route for update--}}

    {{ Form::open(['url' => 'update-sending_profile']) }}


    <div class="form-group">
        {!! Form::label('name_label','Name:') !!}
        {!! Form::text('sending_name',$profile->sending_name,['class'=>'form-control']) !!}
    </div>





    <div class="form-group">
        {!! Form::label('subject_label','Email:') !!}
        {!! Form::text('sending_email',$profile->sending_email,['class'=>'form-control']) !!}
    </div>


    {{Form::hidden('profile_id',$profile->id)}}

    <div class="form-group">
        {!! Form::button('Update', ['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>






    {!! Form::close() !!}


@stop




