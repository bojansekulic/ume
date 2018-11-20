@extends('layouts.app')

@section('page-title', trans('Campaign Statistics'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Campaign Statistics') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('campaign')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('Campaign Stats')</li>
                        @endif
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
                            <div class="text-huge">{{ $opens }}</div>
                        </div>
                        <div class="icon">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            <i class="pull-left  fa fa-envelope-open-o fa-5x"></i>
                        </div>
                    </div>
                </div>


                <a href="{{ route('allopen') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('All Opened Emails List')</span>
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
                            <div class="text-huge">{{ $clicks }}</div>
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
                            <div class="text-huge">{{ $submited }}</div>
                        </div>
                        <div class="icon">
                            <i class="pull-left fa fa-pencil-square-o fa-5x "></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('allsubmited') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('View List with details')</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>




    </div>

    @if (session()->has('deleted'))
        <div class="alert alert-danger text-center animated fadeIn">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                {!! session()->get('deleted') !!}
            </strong>
        </div>
    @endif


<div class="row">



    <table class="table">

        <thead>
        <tr>
            <th>Name</th>

            <th>Launching Date</th>

            <th>Action</th>
            <th>Action</th>


        </tr>

        </thead>



    @foreach($joins as $data)



        <tr>
            <td>{{ $data->name}}</td>
            <td>{{ $data->created_at}}</td>

            <td>{{link_to_route('campaign_show.show','View Details',[$data->id],['class'=>'btn btn-primary'])}}</td>


            <td>{{Form::open(['method'=>'DELETE','route'=>['campaign_show.destroy', $data->id],])}}
                <button class="btn btn-danger" type="submit">Delete</button></td>

            {{ Form::close() }}

        </tr>


            @endforeach


    </table>
</div>

@stop



@section('scripts')

    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-default.js') !!}
@stop