@extends('layouts.theme')
@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10 title-main">@lang('Dashboard')</h5>
                        <p class="m-b-0">@lang('Welcome')</p>
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
                    <h5 class="text-dark">@lang('Lessons')</h5>
                    <hr>
                    @foreach($listLesson['lessons'] as $lesson)
                    <div class="card">
                        <div class="card-block caption-breadcrumb">
                            <div class="breadcrumb-header">
                                <h5>{{ $lesson->name }}</h5>
                                <span>{{ $lesson->described }}</span>
                            </div>
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home') }}">
                                            <i class="icofont icofont-home"></i>
                                            @lang('Courses')
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('lessons', $listLesson['course']->id) }}">{{ $listLesson['course']->name }}</a>
                                    </li>
                                    <li class="float-right"><a href="{{ route('lesson.start', $lesson->id) }}">@lang('Start')</a>
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
