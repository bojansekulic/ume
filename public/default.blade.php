@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.welcome') <?= Auth::user()->username ?: Auth::user()->first_name ?>!
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li class="active">@lang('app.dashboard')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

<div class="row">

    <div class="col-lg-3 col-md-6 ">
        <div class="panel panel-widget panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="title">@lang('Email Sent')</div>
                        <div class="text-huge">{{ $all }}</div>
                    </div>
                    <div class="icon">
                        <i class="pull-left  fa fa-envelope-o fa-5x"></i>
                    </div>
                </div>
            </div>


            <a href="{{ route('allsent') }}">
            <div class="panel-footer">
            <span class="pull-left">@lang('All Sent Emails List')</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
            </div>
            </a>
        </div>
    </div>






    {{--<div class="row">--}}
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-widget panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="title">@lang('email opened')</div>
                            <div class="text-huge">{{ $all }}</div>
                        </div>
                        <div class="icon">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            <i class="pull-left  fa fa-envelope-open-o fa-5x"></i>
                        </div>
                    </div>
                </div>


                <a href="{{ route('allsent') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('All Sent Emails List')</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>



    <div class="col-lg-3 col-md-6">
        <div class="panel panel-widget panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="title">@lang('clicked link')</div>
                        <div class="text-huge">{{ $counter }}</div>
                    </div>
                    <div class="icon">
                        <i class="pull-left fa fa-link fa-5x "></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('clicked') }}">
                <div class="panel-footer">
                    <span class="pull-left">@lang('View List with details')</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>



    <div class="col-lg-3 col-md-6">
        <div class="panel panel-widget panel-danger">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-7">
                        <div class="title">@lang('submitted data')</div>
                        <div class="text-huge">{{ $counter }}</div>
                    </div>
                    <div class="icon">
                        <i class="pull-left fa fa-pencil-square-o fa-5x "></i>
                    </div>
                </div>
            </div>
            <a href="{{ route('clicked') }}">
                <div class="panel-footer">
                    <span class="pull-left">@lang('View List with details')</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>




</div>



    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('emailtemplate.index') }}" class="panel-link">
                <div class="panel panel-default dashboard-panel">
                    <div class="panel-body">
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <p class="lead">@lang(' Template Management')</p>
                    </div>
                </div>
            </a>
        </div>

{{--<div class="row">--}}


    <div class="col-md-3">
        <a href="{{ route('sendingprofile.index') }}" class="panel-link">
            <div class="panel panel-default dashboard-panel">
                <div class="panel-body">
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <p class="lead">@lang('Sending Profiles')</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
            <a href="{{ route('csv') }}" class="panel-link">
                <div class="panel panel-default dashboard-panel">
                    <div class="panel-body">
                        <div class="icon">
                            <i class="fa fa-group"></i>
                        </div>
                        <p class="lead">@lang('Groups & Contacts')</p>
                    </div>
                </div>
            </a>
        </div>



        <div class="col-md-3">
            <a href="{{ route('contactlist') }}" class="panel-link">
                <div class="panel panel-default dashboard-panel">
                    <div class="panel-body">
                        <div class="icon">
                            <i class="fa fa-list-alt"></i>
                        </div>
                        <p class="lead">@lang('Contact list')</p>
                    </div>
                </div>
            </a>
        </div>



        <div class="col-md-3">
            <a href="{{ route('selectlist.index') }}" class="panel-link">
                <div class="panel panel-default dashboard-panel">
                    <div class="panel-body">
                        <div class="icon">
                            <i class="fa fa-send-o"></i>
                        </div>
                        <p class="lead">@lang('Launch Campaign')</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('sendemailform') }}" class="panel-link">
                <div class="panel panel-default dashboard-panel">
                    <div class="panel-body">
                        <div class="icon">
                            <i class="fa fa-send"></i>
                        </div>
                        <p class="lead">@lang('Test Campaign')</p>
                    </div>
                </div>
            </a>
        </div>



        {{--<div class="row">--}}
        {{--<div class="col-md-3">--}}
        {{--<a href="{{ route('profile') }}" class="panel-link">--}}
        {{--<div class="panel panel-default dashboard-panel">--}}
        {{--<div class="panel-body">--}}
        {{--<div class="icon">--}}
        {{--<i class="fa fa-user"></i>--}}
        {{--</div>--}}
        {{--<p class="lead">@lang('app.update_profile')</p>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</div>--}}




    {{--@if (config('session.driver') == 'database')--}}
        {{--<div class="col-md-3">--}}
            {{--<a href="{{ route('profile.sessions') }}" class="panel-link">--}}
                {{--<div class="panel panel-default dashboard-panel">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-list"></i>--}}
                        {{--</div>--}}
                        {{--<p class="lead">@lang('app.my_sessions')</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--@endif--}}
    {{--<div class="col-md-3">--}}
        {{--<a href="{{ route('profile.activity') }}" class="panel-link">--}}
            {{--<div class="panel panel-default dashboard-panel">--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="icon">--}}
                        {{--<i class="fa fa-list-alt"></i>--}}
                    {{--</div>--}}
                    {{--<p class="lead">@lang('Activity log')</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
    {{--<div class="col-md-3">--}}
        {{--<a href="{{ route('auth.logout') }}" class="panel-link">--}}
            {{--<div class="panel panel-default dashboard-panel">--}}
                {{--<div class="panel-body">--}}
                    {{--<div class="icon">--}}
                        {{--<i class="fa fa-sign-out"></i>--}}
                    {{--</div>--}}
                    {{--<p class="lead">@lang('app.logout')</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">@lang('app.activity') (@lang('app.last_two_weeks')</div>
            <div class="panel-body">
                <div>
                    <canvas id="myChart" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>



@stop



@section('scripts')
    <script>
        var labels = {!! json_encode(array_keys($activities)) !!};
        var activities = {!! json_encode(array_values($activities)) !!};
    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-default.js') !!}
@stop