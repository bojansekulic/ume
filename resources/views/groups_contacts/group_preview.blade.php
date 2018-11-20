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
                            <li class="active">@lang('Contact list')</li>
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
            <th>Email</th>

            <th>Action</th>
            <th>Action</th>

        </tr>




        @foreach($details as $detail)



            <tr>
                <td>{{$detail->first_name}}</td>
                <td>{{ $detail->last_name}}</td>
                <td>{{ $detail->email}}</td>

                <td>
                    {{link_to_route('edit_delete_c.edit','Edit',[$detail->id],['class'=>'btn btn-success'])}}

                    <td>
                    {{Form::hidden('id',$detail->id)}}
                        {{Form::open(['method'=>'DELETE','route'=>['edit_delete_c.destroy', $detail->id],])}}
                        <button class="btn btn-danger" type="submit">Delete</button>

                        {{ Form::close() }}

                    </td>




            </tr>





        @endforeach

    </table>








@endsection