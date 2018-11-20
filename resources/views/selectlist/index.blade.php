@extends('layouts.app')

@section('page-title', trans('app.selectlist'))



@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ isset($user) ? $user->present()->nameOrEmail : trans('Launch Campaign') }}
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

{!! Form::open(['method'=>'POST', 'route'=>'send']) !!}

<p><b>Campaign Name:</b></p>
<div>
    {!! Form::text('campaign_name',null,['class'=>'form-control']) !!}

</div>
</br>

<p><b>Template:</b></p>


<div>{!! Form::select('templates',$templates, null, ['class' => 'form-control']) !!}  </div>

</br>

<p><b>Write Subject:</b></p>
<div>
{!! Form::text('subject',null,['class'=>'form-control']) !!}

</div>

</br>

<p><b>Sending Profile:</b></p>
<div>{!! Form::select('sending_profiles', $profiles, null, ['class' => 'form-control']) !!}</div>

</br>


<p><b>Select Contact Group</b></p>
<div>{!! Form::select('groups', $groups, null, ['class' => 'form-control']) !!}</div>

</br>


<div class="form-group">
    {!! Form::submit('SEND', ['class'=>'btn btn-primary']) !!}
</div>
{{--<p>Select sending profile</p>--}}

{{--<select class="form-control" name="item_id">--}}
    {{--@foreach($profiles as $profile)--}}
        {{--<option value="{{$profile->sending_name, $profile->sending_email}}">{{$profile->sending_name}}  {{$profile->sending_email}} </option>--}}
    {{--@endforeach--}}
{{--</select>--}}

{{--</br>--}}

{!! Form::close() !!}



    @endsection
@section('styles')
    {!! HTML::style('assets/css/jaofiletree.css') !!}
@stop
