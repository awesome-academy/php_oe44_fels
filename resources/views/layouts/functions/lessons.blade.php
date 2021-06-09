@extends('layouts.theme')
@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10 title-main">@lang('dashboard')</h5>
                        <p class="m-b-0">@lang('welcome')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="page-header-breadcrumb path">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">
                                    <i class="icofont icofont-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="">
                                    {{ $data['course']->name }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    @foreach($data['lessons'] as $key=>$lesson)
                    <div class="card">
                        <div class="card-block caption-breeyssawdrtr bvcbfadcrumb">
                            <div class="breadcrumb-header">
                                <h5>{{ $lesson->name }}</h5>
                                <span>{{ $lesson->described }}</span>
                            </div>
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        @if($data['userLessons'][$key] != null)
                                            @php
                                                $userLesson = $data['userLessons'][$key];
                                            @endphp
                                            @if($lesson->id == $userLesson->lesson_id)
                                                @if($userLesson->status == 0)
                                                <div class="label-main">
                                                    <label class="label label-danger">@lang('unfinished')</label>
                                                </div>
                                                @else
                                                    <div class="label-main">
                                                        <label class="label label-success">@lang('result'): {{ $userLesson->result_string }}</label>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    </li>
                                    <li class="float-right">
                                        <label class="label label-info"><a href="{{ route('lesson.start', $lesson->id) }}">@lang('start')</a></label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
