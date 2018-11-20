@extends('layouts.app')

@section('page-title', trans('app.selectlist'))



@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Contact list') }}
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
            <th>First Name</th>
            <th>Last Name</th>
            <th>Group</th>
            <th>Email</th>

        </tr>






        @foreach($contacts as $contact)



            <tr>
                <td>{{$contact->first_name}}</td>
                <td>{{ $contact->last_name}}</td>
                <td>{{ $contact->group_name}}</td>
                <td>{{ $contact->email}}</td>


            </tr>





        @endforeach

    </table>








@endsection