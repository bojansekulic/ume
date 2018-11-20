@extends('layouts.app')

@section('page-title', trans('app.dashboard'))

@section('content')
<head>


    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>

</head>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Campaign Preview') }}
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
                            <div class="text-huge">{{ $allSent }}</div>
                        </div>
                        <div class="icon">
                            <i class="pull-left  fa fa-envelope-o fa-5x"></i>
                        </div>
                    </div>
                </div>


                <a href="{{ route('all_list_details') }}">
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
                            <div class="text-huge">{{ $allOpens }}</div>
                        </div>
                        <div class="icon">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                            <i class="pull-left  fa fa-envelope-open-o fa-5x"></i>
                        </div>
                    </div>
                </div>


                <a href="{{ route('opens_details') }}">
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
                            <div class="text-huge">{{ $allClicks }}</div>
                        </div>
                        <div class="icon">
                            <i class="pull-left fa fa-link fa-5x "></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('click_details') }}">
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
                            <div class="text-huge">{{ $allSubmited }}</div>
                        </div>
                        <div class="icon">
                            <i class="pull-left fa fa-pencil-square-o fa-5x "></i>
                        </div>
                    </div>
                </div>
                <a href="{{ route('submited_details') }}">
                    <div class="panel-footer">
                        <span class="pull-left">@lang('View List with details')</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>




    </div>





            @foreach($joins as $data)
                {{--<div class="row">--}}



                    <table class="table" >

                        <thead>
                        <tr>
                            <th>Campaign Name : &nbsp <font color="red" >{{ $data->name}}</font></th>
                        </tr>

                        <tr>
                            <th>Launching Date : &nbsp  <font color="red" >{{ $data->date}}</font></th>
                        </tr>

                        <tr>
                            <th>Sent From Name & Address : &nbsp <font color="red" >{{ $data->sending_name}} [ {{ $data->sending_email}} ]</font> </th>
                        </tr>

                        <tr>
                            <th>Subject : &nbsp <font color="red" >{{ $data->subject}} </font></th>
                        </tr>

                        <tr>
                            <th>Recipients in Group : &nbsp  <font color="red" >{{ $data->group_name}}</font></th>
                        </tr>
                        <tr>
                            <th>Campaign created and launched by : &nbsp  <font color="red" ><?= Auth::user()->username ?: Auth::user()->first_name ?></font></th>
                        </tr>




                        </thead>


                <tr>

                    <td></td>


                </tr>


            @endforeach


        </table>

                <a class="btn btn-danger" href="{{route('report')}}" role="button" >Download Report</a>


                <script type="text/javascript">

                    $(document).ready(function () {
                        $('.btn').printPage();

                    })

                </script>
@stop



@section('scripts')

    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-default.js') !!}
@stop