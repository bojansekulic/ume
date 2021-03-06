@extends('layouts.app')

@section('page-title', trans('SubmitedList'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('List of users who submited form') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('Activity')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('Clicked List')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>





    {{--<p><h1><b >Ukupno Poslato: {{$all}}</b></h1></p>--}}
    <p><h1><b >Submited: {{$submitedCounter}}</b></h1></p>

    <table class="table">

        <thead>
        <tr>
            <th>Who</th>
            <th>How many times</th>


        </tr>


        @foreach($submits as $submit)



            <tr>
                <td>{{($submit->recipient)}}</td>

                <td>{{$submit->submited}}</td>


            </tr>





        @endforeach
        <tr>




        </tr>

        </thead></table>

@endsection

