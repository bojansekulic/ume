@extends('layouts.app')

@section('page-title', trans('Template Management'))



@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ isset($user) ? $user->present()->nameOrEmail : trans('Template Menagement') }}
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        @if (isset($user) && isset($adminView))
                            <li><a href="{{ route('activity.index') }}">@lang('Template Menagement')</a></li>
                            <li class="active">{{ $user->present()->nameOrEmail }}</li>
                        @else
                            <li class="active">@lang('Template Menagement')</li>
                        @endif
                    </ol>
                </div>
            </h1>
        </div>
    </div>



{{--<table>--}}
    {{--<!-- Button trigger modal -->--}}
    {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">--}}
        {{--Create new Template--}}
    {{--</button>--}}

    {{--<!-- Modal -->--}}
    {{--<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-dialog-centered" role="document">--}}
            {{--<div class="modal-content">--}}



                {{--{!! Form::open(['method'=>'POST', 'route'=>'emailtemplate.store']) !!}--}}



                {{--<div class="modal-header">--}}
                    {{--<h5 class="modal-title" id="exampleModalLongTitle">Create new Template</h5>--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">&times;</span>--}}
                    {{--</button>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}


                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('name_label','Name:') !!}--}}
                        {{--{!! Form::text('name',null,['class'=>'form-control']) !!}--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('subject_label','Subject:') !!}--}}
                        {{--{!! Form::text('subject',null,['class'=>'form-control']) !!}--}}
                    {{--</div>--}}





                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('body_label','Body:') !!}--}}
                        {{--{!! Form::textarea('body',null,['class'=>'form-control']) !!}--}}
                    {{--</div>--}}





                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--<button type="submit"  class="btn btn-primary">Save</button>--}}


                    {{--{!! Form::close() !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}




{{--Route to page for creating new Template--}}
<table class="table">

    <thead>

    <tr>

        <td>  <a  href="{{route('emailtemplate.create')}}" class="btn btn-custom ">CREATE NEW TEMPLATE</a></td>


    </tr>

    </thead>


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




    </table>
{{--<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js ')}}"></script>--}}
{{--<script>--}}
    {{--CKEDITOR.replace( 'body' );--}}
{{--</script>--}}
<p>&nbsp</p>
{{--Tables--}}


    <table class="table">

        <thead>
        <tr>
            <th>Name</th>
            <th>Subject</th>
            <th>Action</th>
            <th>Action</th>
            <th>Action</th>

        </tr>

        </thead>

        @foreach($templates as $template)



            <tr>
                <td>{{$template->name}}</td>
                <td>{{ $template->subject}}</td>
                {{--<td></td>--}}
                {{--<td>{{ $template->from_email_address}}</td>--}}
                <td>{{link_to_route('emailtemplate.show','View',[$template->id],['class'=>'btn btn-primary'])}}</td>
                <td>{{link_to_route('emailtemplate.edit','Edit',[$template->id],['class'=>'btn btn-success'])}}</td>

                <td>{{Form::open(['method'=>'DELETE','route'=>['emailtemplate.destroy', $template->id],])}}
                <button class="btn btn-danger" type="submit">Delete</button></td>

                    {{ Form::close() }}
            </tr>





        @endforeach



        {{--@if(session()->has('del_message'))--}}
            {{--<div class="alert alert-success">{{session()->get('del_message')}}</div>--}}
        {{--@endif--}}
    </table>
    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<br><br>--}}
            {{--<button type="submit" class="btn btn-primary">--}}
                {{--<i class="fa fa-save"></i>--}}
                {{--@lang('Save changes')--}}
            {{--</button>--}}
        {{--</div>--}}
    {{--</div>--}}

@stop

@section('styles')
    {!! HTML::style('assets/css/jaofiletree.css') !!}
@stop
