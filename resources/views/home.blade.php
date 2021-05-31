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
          <div class="row">
            @if(count($listMyCourse) == 0)
            <p class="text-center w-100"> @lang('noCourseExist') <a class="text-danger" href="{{route('other.courses')}}">[@lang('viewCourses')]</a></p>
            @else
            @foreach($listMyCourse as $items)
            @foreach($items as $value)

            <div class="col-xl-4 col-md-6 row mt-4 ml-3">
              <div class="card mb-0">
                <div class="card-block">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-purple">{{$value->name}}</h4>
                      <h6 class="text-muted m-b-0">{{$value->described}}</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="fa fa-bar-chart f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-purple">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">
                        @foreach($topics as $item)
                        @if($item->id == $value->topic_id)
                        {{ $item->name }}
                        @break
                        @endif
                        @endforeach
                      </p>
                    </div>
                    <div class="col-3 text-right">
                      <i onclick="showHideInfor('#infor-course_{{$value->id}}')" class="fa fa-line-chart text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="float-start infor-lesson bg-info" id="infor-course_{{$value->id}}" style="display: none;">
                <div class="card-block accordion-block">
                  <div id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach($lessonOfMyCourse as $keys)
                    @foreach($keys as $it)
                    @if($it->course_id == $value->id)
                    <div class="accordion-panel">
                      <div class="accordion-heading" role="tab" id="headingOne">
                        <h3 class="card-title accordion-title">
                          <a class="accordion-msg waves-effect waves-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$value->id . $it->id}}" aria-expanded="true" aria-controls="collapseOne{{$value->id . $it->id}}">
                            {{$it->name}}
                          </a>
                        </h3>
                      </div>
                      <div id="collapseOne{{$value->id . $it->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="accordion-content accordion-desc">
                          <p>{{$it->described}}</p>
                          <br>
                          <button class="btn-action-lesson btn waves-effect waves-light btn-grd-success float-right">Ready</button>
                          <button class="btn-action-lesson btn waves-effect waves-light btn-grd-warning float-right">Result</button>

                        </div>

                      </div>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @endforeach
            @endif
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
