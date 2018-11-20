@extends('layouts.app')
@section('page-title', trans('Groups & Contacts'))
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Groups & Contacts') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('app.selectlist')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('Groups & Contacts')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>





    {{--<h1 >Groups & Contacts </h1>--}}
    <p>&nbsp</p>

    <p>&nbsp</p>



    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <table>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Create New Group
                    </button>
                </table>
            </div>


            <div class="col-md-4">
                <table>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcontact">
                        Add Single contact to Group
                    </button>
                </table>
            </div>

            <div class="col-md-4">
                <table>
                    <!-- Button CSV Import to group -->

                    <td>  <a  href="{{route('csv')}}" class="btn btn-custom ">CSV Bulk Import</a></td>

                </table>
            </div>






        </div>
    </div>


    {{--<!-- Modal for create Group-->--}}

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="#exampleModalCenterTitle">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create New Group</h4>
                </div>
                <div class="modal-body">


                    <!-- use method="post" to send your form to server -->

                    <form action="{{route('create_group')}}" method="post" class="form-horizontal"  >

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <lable for="group_name" class="col-sm-3 control-label">Group Name</lable>
                            <div class="col-sm-6">
                                <input type="text" id="group_name" name="group_name" class="form-control" required/>
                            </div>
                        </div>
                        {{--<div class="modal-footer">--}}


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </div>
                        {{--</div>--}}
                    </form>
                </div>

            </div>
        </div>
    </div>




    <!-- Modal for Sngle contact -->
    <div class="modal fade" id="addcontact" tabindex="-1" role="dialog" aria-labelledby="addcontact" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                {{--{!! Form::open(['method'=>'POST', 'route'=>'process_contact']) !!}--}}



                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create new Contact </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('process_contact')}}" method="post" class="form-horizontal"  >

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="group_list" class="col-sm-3 control-label">Group</label>
                            <div class="col-sm-6">
                        <select name="group_list" id="groups" class="form-control" required>
                            <option value="" disabled selected>Select your option</option>
                            @foreach($lists as $item)
                                <option value="{{ $item->id}}">{{ $item->group_name }}</option>
                            @endforeach
                        </select>
                            </div>
                        </div>
                        <p>&nbsp</p>

                        <div class="form-group">
                            <label for="f_name" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" id="f_name" name="f_name" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="l_name" class="col-sm-3 control-label">Last Name </label>
                            <div class="col-sm-6">
                                <input type="text" id="l_name" name="l_name" class="form-control" required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Last Name </label>
                            <div class="col-sm-6">
                                <input type="email" id="email" name="email" class="form-control" required/>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary " value="Submit">
                            </div>
                        </div>

                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>


    <p>&nbsp</p>

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



    <p>&nbsp</p>

    <p>&nbsp</p>

    <table class="table">

        <thead>
        <tr>
            <th>Group Name</th>
            <th>Action</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
        </thead>
   @foreach($groups as $group)




       <tr>
           <td>{{$group->group_name}}</td>
           <td>{{link_to_route('groups_m.show','Show ',[$group->id],['class'=>'btn btn-primary'])}}</td>

           <td>{{link_to_route('groups_m.edit','Edit',[$group->id],['class'=>'btn btn-success'])}}</td>


           {{Form::hidden('group_id',$group->id)}}
           <td>{{Form::open(['method'=>'DELETE','route'=>['groups_m.destroy', $group->id],])}}
               <button class="btn btn-danger" type="submit">Delete</button></td>

           {{ Form::close() }}

       </tr>

    @endforeach



</table>

@endsection

