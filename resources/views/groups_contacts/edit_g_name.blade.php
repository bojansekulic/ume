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


    {{--Edit form with route for update--}}

    {{ Form::open(['url' => 'update-group_name']) }}


    <div class="form-group">
        {!! Form::label('name_label','Name:') !!}
        {!! Form::text('group_name',$group->group_name,['class'=>'form-control']) !!}
    </div>





    {{Form::hidden('group_id',$group->id)}}

    <div class="form-group">
        {!! Form::button('Update', ['type'=>'submit','class'=>'btn btn-primary']) !!}
    </div>





    {!! Form::close() !!}


@stop




