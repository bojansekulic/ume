@extends('layouts.app')
@section('page-title', trans('app.dashboard'))
@section('content')

    <p>&nbsp</p>





   {{--<div class="row" >--}}
        {{--<div class="col-md-3">--}}
            {{--<a href="{{ route('group_show') }}" class="panel-link">--}}
                {{--<div class="panel panel-default dashboard-panel">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-envelope"></i>--}}
                        {{--</div>--}}
                        {{--<p class="lead">@lang(' Group Management')</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}






        {{--<div class="col-md-3">--}}
            {{--<a href="{{ route('groups_m.index') }}" class="panel-link">--}}
                {{--<div class="panel panel-default dashboard-panel">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-envelope"></i>--}}
                        {{--</div>--}}
                        {{--<p class="lead">@lang(' Contact Manager')</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}



        {{--<div class="col-md-3">--}}
            {{--<a href="{{ route('groups_m.index') }}" class="panel-link">--}}
                {{--<div class="panel panel-default dashboard-panel">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-envelope"></i>--}}
                        {{--</div>--}}
                        {{--<p class="lead">@lang(' Import single contact')</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}



        {{--<div class="col-md-3">--}}
            {{--<a href="{{ route('groups_m.index') }}" class="panel-link">--}}
                {{--<div class="panel panel-default dashboard-panel">--}}
                    {{--<div class="panel-body">--}}
                        {{--<div class="icon">--}}
                            {{--<i class="fa fa-envelope"></i>--}}
                        {{--</div>--}}
                        {{--<p class="lead">@lang(' Import Bulk CSV')</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}


@endsection
