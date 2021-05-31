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
        <div class="col-md-4">
          <ul class="breadcrumb-title">
            <li class="breadcrumb-item">
              <a href="index.html"> <i class="fa fa-home"></i> </a>
            </li>
            <li class="breadcrumb-item"><a href="#!">@lang('Dashboard')</a>
            </li>
          </ul>
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
        @if(session('status'))
            <p class="text-danger">{{ session('status') }}</p>
        @endif

        @if(count($user_topics) == 0)
        <div class="page-body">
          <div class="row">
            <!-- task, page, download counter  start -->
            <form action="{{route('user_topic.insert')}}" method="post">
              @csrf
              <h2>@lang('WhatTopicLike')</h2>
              <div class="row m-t-25 text-left">

                @foreach($topics as $topic)
                <div class="col-md-12">
                  <div class=" fade-in-primary">
                    <label>
                      <input type="checkbox" value="{{$topic->id}}" name="topic_{{$topic->id}}">
                      <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                      <span class="text-inverse">{{$topic->name}}</span>
                    </label>
                  </div>
                </div>
                @endforeach

              </div>
              <button type="submit" class="btn btn-primary waves-effect waves-light">@lang('Next')</button>
            </form>
          </div>
        </div>

        @else
        <div class="page-body">
          <h5 class="text-dark">@lang('RegisteredCourses')</h5>
          <hr>

          @if(count($listMyCourse) == 0)
          <p class="text-center w-100"> @lang('noCourseExist') <a class="text-danger" href="{{route('other.courses')}}">[@lang('viewCourses')]</a></p>
          @else

          @foreach($listMyCourse as $items)
          @foreach($items as $value)
          <div class="card">
            <div class="card-block caption-breadcrumb">
              <div class="breadcrumb-header">
                <h5>{{$value->name}}</h5>
                <span>{{$value->described}}</span>
              </div>
              <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                  <li class="breadcrumb-item">
                    <a href="#!">
                      <i class="icofont icofont-home"></i>
                    </a>
                  </li>
                  <li class="breadcrumb-item"><a href="#!">

                      @foreach($topics as $item)
                      @if($item->id == $value->topic_id)
                      {{ $item->name }}
                      @break
                      @endif
                      @endforeach

                    </a>
                  </li>
                  <li class="float-right"><a href="{{ route('lessons', $value->id) }}">@lang('LearnNow')</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          @endforeach
          @endforeach
          @endif
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
