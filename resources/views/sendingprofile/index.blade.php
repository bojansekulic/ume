@extends('layouts.app')

@section('page-title', trans('Sending Profile'))


@section('content')



    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Sending Profiles') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('Sending profile')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('Sending profile')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>




    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        New Profile
    </button>

    <p>&nbsp</p>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                {!! Form::open(['method'=>'POST', 'route'=>'sendingprofile.store']) !!}



                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create new Sending profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                    {!! Form::label('name_label','Name:') !!}
                    {!! Form::text('sending_name',null,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                    {!! Form::label('sending_email','Email:') !!}
                    {!! Form::text('sending_email',null,['class'=>'form-control']) !!}
                    </div>




                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">Save</button>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>







{{--</table>--}}

    @if (session()->has('success'))

        <table>
            <div class="alert alert-success text-center animated fadeIn">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('success') !!}
                </strong>
            </div>
        </table>
    @endif

    @if (session()->has('updated'))

        <table>
            <div class="alert alert-info text-center animated fadeIn">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('updated') !!}
                </strong>
            </div>
        </table>
    @endif

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


    @if (session()->has('error'))
        <div class="alert alert-danger text-center animated fadeIn">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
                {!! session()->get('error') !!}
            </strong>
        </div>
    @endif

    <table class="table">

        <thead>
        <tr>
            <th>Name</th>

            <th>Email</th>
            <th>Action</th>
            <th>Action</th>
        </tr>



        @foreach($profiles as $profile)



            <tr>
                <td>{{$profile->sending_name}}</td>

                <td>{{ $profile->sending_email}}</td>

                <td>{{link_to_route('sendingprofile.edit','Edit',[$profile->id],['class'=>'btn btn-success'])}}</td>

                <td>{{Form::open(['method'=>'DELETE','route'=>['sendingprofile.destroy', $profile->id],])}}
                    <button class="btn btn-danger" type="submit">Delete</button></td>

                {{ Form::close() }}

            </tr>





        @endforeach




    </table>


@endsection




