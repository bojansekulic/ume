@extends('layouts.app')

@section('page-title', trans('app.selectlist'))



@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Template preview') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('app.selectlist')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('app.selectlist')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>




    <table class="table">

        <thead>
        <tr>
            <th>Name</th>
            <th>Subject </th>

        </tr>
        <td>{{$template->name}}</td>

        <td>{{ $template->subject}}</td>


        </thead>
    </table>
    <table class="table">
        <tr>
            <th>Body text</th>
        </tr>
        <td>{!! $template->text !!}</td>
        <tr>
            <td>{{link_to_route('emailtemplate.edit','Edit',[$template->id],['class'=>'btn btn-success'])}}</td>
        </tr>

    </table>








@endsection