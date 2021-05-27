@extends('layouts.theme')
@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10 title-main">@lang('OtherCourses')</h5>
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
                    <h5 class="text-dark">@lang('CoursesOfTopicUlike')</h5>
                    <hr>
                    <div class="row">
                        @php
                        $arrayCourseExist = [] ;
                        @endphp
                        @foreach($user_course as $it)
                        @php
                        array_push($arrayCourseExist,$it->course_id);
                        @endphp
                        @endforeach

                        @foreach($listCourseByTopic as $items)
                        @foreach($items as $value)

                        @if(in_array($value->id,$arrayCourseExist))
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-1">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-purple">{{$value->name}}</h4>
                                            <h6 class="text-muted m-b-0">{{$value->described}}</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <button type="submit" class="btn bg-success waves-effect waves-dark btn-success btn-outline-success btn-icon"><i class="icofont icofont-check-circled"></i>
                                            <a hidden href="{{route('home')}}"></a>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-purple ">
                                    <div class="col-12 text-center">
                                        <p class="text-white m-b-0">
                                            @foreach($topics as $item)
                                            @if($item->id == $value->topic_id)
                                            {{ $item->name }}
                                            @break
                                            @endif
                                            @endforeach

                                        </p>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        @else
                        <div class="col-xl-3 col-md-6">
                            <div class="card mb-1">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-8">
                                            <h4 class="text-c-purple">{{$value->name}}</h4>
                                            <h6 class="text-muted m-b-0">{{$value->described}}</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <form class="text-center" action="{{route('user_course.insert',$value->id)}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn bg-white waves-effect waves-dark btn-success btn-outline-success btn-icon"><i class="icofont icofont-check-circled text-success"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-c-purple ">
                                    <div class="col-12 text-center">
                                        <p class="text-white m-b-0">
                                            @foreach($topics as $item)
                                            @if($item->id == $value->topic_id)
                                            {{ $item->name }}
                                            @break
                                            @endif
                                            @endforeach

                                        </p>
                                    </div>
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
    </div>
</div>
@endsection
