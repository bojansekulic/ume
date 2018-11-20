@extends('layouts.app')

@section('page-title', trans('Create Campaign'))



@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Create Campaign') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('campaign')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('Campaign')</li>
                        @endif
                    </ol>
                </div>
            </h1>
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




    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- select template--}}



    {!! Form::open(['method'=>'POST', 'route'=>'campaign_save']) !!}

    <p><b>Campaign Name:</b></p>
    <div>
        {!! Form::text('campaign_name',null,['class'=>'form-control']) !!}

    </div>
    </br>

    <p><b>Template:</b></p>


    <div>{!! Form::select('templates',$templates, null, ['class' => 'form-control']) !!}  </div>

    </br>



    <p><b>Sending Profile:</b></p>
    <div>{!! Form::select('sending_profiles', $profiles, null, ['class' => 'form-control']) !!}</div>

    </br>


    <p><b>Select Contact Group</b></p>
    <div>{!! Form::select('groups', $groups, null, ['class' => 'form-control']) !!}</div>

    </br>


    <div class="form-group">
        {!! Form::submit('Create & Proceed Next', ['class'=>'btn btn-primary']) !!}
    </div>


    {!! Form::close() !!}

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            {{ isset($user) ? $user->present()->nameOrEmail : trans('DELETE Campaign') }}

            </h1>
        </div>
    </div>

    <p>&nbsp</p>

    <table class="table">

        <thead>
        <tr>
            <th>Group Name</th>
            <th>Action</th>

        </tr>
        </thead>



    @foreach($campaigns as $campaign)




        <tr>
            <td>{{$campaign->name}}</td>
            <td>{{Form::open(['method'=>'DELETE','route'=>['campaign.destroy', $campaign->id],])}}
                <button class="btn btn-danger" type="submit">Delete</button></td>

            {{ Form::close() }}
        </tr>



    @endforeach

    </table>
@endsection
@section('styles')
    {!! HTML::style('assets/css/jaofiletree.css') !!}
@stop
