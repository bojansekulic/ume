@extends('layouts.app')

@section('content')

    <p>&nbsp</p>

    <p>&nbsp</p>




    {{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
    {{--<table>--}}
        {{--<!-- Button trigger modal -->--}}
        {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">--}}
            {{--Create New Group--}}
        {{--</button>--}}
    {{--</table></div></div></div>--}}
        {{--<!-- Modal -->--}}
        {{--<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
            {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
                {{--<div class="modal-content">--}}


                    {{--{!! Form::open(['method'=>'POST', 'route'=>'create_group']) !!}--}}



                    {{--<div class="modal-header">--}}
                        {{--<h5 class="modal-title" id="exampleModalLongTitle">Create new Group </h5>--}}
                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                            {{--<span aria-hidden="true">&times;</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="modal-body">--}}


                        {{--<div class="form-group">--}}
                            {{--{!! Form::label('name_label','Name:') !!}--}}
                            {{--{!! Form::text('group_name',null,['class'=>'form-control']) !!}--}}
                        {{--</div>--}}



                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        {{--<button type="submit"  class="btn btn-primary">Create</button>--}}


                        {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}





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



    <p>&nbsp</p>

    @if (session()->has('csvfail'))
        <div class="alert alert-danger text-center animated fadeIn">

            <strong>
                {!! session()->get('csvfail') !!}
            </strong>
        </div>
    @endif




<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import</div>
                    <p>&nbsp</p>


                    {{--<div class="panel-body">--}}
                        {{--{{ Form::label('name_label', 'Group:') }}--}}
                        {{--{!! Form::select('groups', $lists,null, ['class' => 'form-control','data-placeholder' => 'Choose a group']) !!}--}}

                    {{--</div>--}}










                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('import_parse') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" value="check" checked> File contains header row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Parse CSV
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
