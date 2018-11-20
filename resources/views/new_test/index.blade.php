@extends('layouts.app')

@section('page-title', trans('TEST Email'))



@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('TEST Email Campaign') }}
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


    @if (session()->has('emailsuccess'))

        <table>
            <div class="alert alert-success text-center animated fadeIn">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('emailsuccess') !!}
                </strong>
            </div>
        </table>
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

    {!! Form::open(['method'=>'POST', 'route'=>'newsendtestemail']) !!}



    <p><b>Campaign:</b></p>


    <div>{!! Form::select('campaign',$campaign, null, ['class' => 'form-control']) !!}  </div>

    </br>


    </br>


    <p><b>Send To:</b></p>
    <div>
        {!! Form::text('to',null,['class'=>'form-control']) !!}

    </div>
    </br>
    <div class="form-group">
        {!! Form::submit('Send', ['class'=>'btn btn-primary']) !!}
    </div>


    {!! Form::close() !!}



@endsection
@section('styles')
    {!! HTML::style('assets/css/jaofiletree.css') !!}
@stop
