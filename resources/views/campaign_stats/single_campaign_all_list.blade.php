@extends('layouts.app')

@section('page-title', trans('Clicked'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Lista of all recipients in this campaign ') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('Activity')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('all recipients')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>





    <p><h1><b >Number of recipients: {{$allCounter}}</b></h1></p>
    {{--<p><h1><b >Ukupno Kliknuli: {{$counter}}</b></h1></p>--}}

    <table class="table">

        <thead>
        <tr>
            <th>Recipient</th>
            <th>Sender</th>
            <th>Subject</th>
            <th>Time</th>


        </tr>


        @foreach($allList as $email)



            <tr>
                <td>{{($email->recipient)}}</td>

                <td>{{$email->sender}}</td>
                <td>{{$email->subject}}</td>
                <td>{{$email->created_at}}</td>


            </tr>





        @endforeach
        <tr>




        </tr>

        </thead></table>

@endsection

