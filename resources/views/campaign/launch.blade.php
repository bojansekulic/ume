@extends('layouts.app')

@section('page-title', trans('Launch Campaign'))



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

    @if (session()->has('duplicate'))

        <table>
            <div class="alert alert-danger text-center animated fadeIn">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>
                    {!! session()->get('duplicate') !!}
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
    {{--,'onsubmit' => 'return confirm("Are you sure you want to launch this campaign?")'--}}

    {!! Form::open(['method'=>'POST', 'route'=>'campaign_send']) !!}



    <p><b>Campaign:</b></p>


    <div>{!! Form::select('campaign',$campaign, null, ['class' => 'form-control']) !!}  </div>

    </br>


    </br>

    <div class="form-group">
        {!! Form::submit('Launch', ['class'=>'btn btn-primary']) !!}
    </div>


    {!! Form::close() !!}

    {{--<script src="sweetalert2.all.min.js"></script>--}}
    {{--<script type="text/javascript">--}}
        {{--$('button.btn btn-primary').on('click', function(e){--}}
            {{--e.preventDefault();--}}
            {{--var self = $(this);--}}

    {{--swal({--}}
    {{--title: 'Error!',--}}
    {{--text: 'Do you want to continue',--}}
    {{--type: 'error',--}}
    {{--confirmButtonText: 'Cool'--}}
    {{--})--}}
{{--</script>--}}
@endsection
@section('styles')
    {!! HTML::style('assets/css/jaofiletree.css') !!}
@stop
