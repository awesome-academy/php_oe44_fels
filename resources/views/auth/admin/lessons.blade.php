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
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="index.html"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">@lang('dashboard')</a>
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
                <div class="col-sm">
                    @if(session("status"))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    @endif
                    <div class="row">
                        <form class="col-7" action="{{route('lessons.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="mb-2 " for="">@lang('name_lesson')</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder='@lang("enter") @lang("name_lesson")' required="">
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2 " for="">@lang('described')</label>
                                <input type="text" class="form-control" id="described" name="described" placeholder='@lang("enter") @lang("described")' required="">
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2 " for="">@lang('course_of_lesson')</label>
                                <select name="course_id" class="form-control">
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name .' (Topic: '. $course->topic_name .')' }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-block accordion-block">
                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="accordion-panel">
                                        <div class="accordion-heading" role="tab" id="headingOne">
                                            <a class="accordion-msg pt-3 pl-0 waves-effect waves-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                @lang('add_word')
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="row accordion-content accordion-desc">
                                                @php
                                                $tmp = false;
                                                @endphp
                                                @foreach($words as $word)
                                                @if($word->lesson_id == '')
                                                @php
                                                $tmp = true;
                                                @endphp
                                                <div class="col-4 label-main">
                                                    <label class="label text-left label-inverse-info-border" for="option{{$word->id}}">
                                                        <input type="checkbox" name="option{{$word->id}}" id="option{{$word->id}}" value="{{ $word->id }}">
                                                        {{ $word->vocabulary }} <span class="txt-cate text-primary"> {{ '('. $word->category_name .')' }} </span></label>
                                                </div>
                                                @endif
                                                @endforeach
                                                @if($tmp == false)
                                                <p>@lang('not_have_word_free')</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark text-secondary bg-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>@lang('add')</button>
                        </form>
                        <div class="col-5">
                        </div>
                    </div>
                    <table class="mt-5 col-6 table table-striped table-responsive">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">@lang('id')</th>
                                <th scope="col">@lang('name_lesson')</th>
                                <th scope="col">@lang('course_of_lesson')</th>
                                <th scope="col">@lang('described')</th>
                                <th scope="col">@lang('list_word')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lessons as $item)
                            <tr>
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->name}}</td>
                                <td>
                                    @foreach($courses as $course)
                                    @if($course->id == $item->course_id)
                                    {{$course->name .' (Topic: '. $course->topic_name .')'}}
                                    @endif
                                    @endforeach
                                </td>
                                <td>{{$item->described}}</td>
                                <td>
                                    <div class="card-block accordion-block">
                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="accordion-panel">
                                                <div class="accordion-heading" role="tab" id="headingOne">
                                                    <a class="accordion-msg border-0 pt-0 pl-0 waves-effect waves-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$item->id}}" aria-expanded="true" aria-controls="collapseOne{{$item->id}}">
                                                        @lang('words')...
                                                    </a>
                                                </div>
                                                <div id="collapseOne{{$item->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                    <form action="{{ route('lessons.removeWord', $item->id) }}" method="POST">
                                                        <div class="row text-left m-0">
                                                            @csrf
                                                            @php 
                                                                $len = false;
                                                            @endphp 
                                                            @foreach($words as $word)
                                                            @if($word->lesson_id == $item->id)
                                                            @php 
                                                               $len = true;
                                                            @endphp
                                                            <div class="col-9 pl-0 label-main">
                                                                <label class="label text-left m-0 label-inverse-info-border">
                                                                    <input type="checkbox" name="option{{$word->id}}" value="{{ $word->id }}">
                                                                    {{ $word->vocabulary }} <span class="txt-cate text-primary"> {{ '('. $word->category_name .')' }} </span></label>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                            @if($len == false)
                                                            <p>@lang('havent_word')</p>
                                                            @else
                                                            <button type="submit" class="mt-3 btn waves-effect waves-light btn-inverse btn-outline-inverse"><i class="icofont icofont-exchange"></i>@lang('remove')</button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$item->id}}">@lang('edit')</button>
                                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">@lang('edit_lesson')</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('lessons.update',$item->id)}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">@lang('name_lesson'):</label>
                                                            <input type="text" class="form-control" value="{{ $item->name }}" name="name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">@lang('course_of_lesson'):</label>
                                                            <select name="course_id" class="form-control">
                                                                @foreach($courses as $course)
                                                                @if($item->course_id == $course->id)
                                                                <option selected value="{{ $course->id }}">{{ $course->name .' ('.$course->topic_name.')' }}</option>
                                                                @else
                                                                <option value="{{ $course->id }}">{{ $course->name .' ('.$course->topic_name.')' }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">@lang('described'):</label>
                                                            <textarea class="form-control" name="described">{{ $item->described }}</textarea>
                                                        </div>

                                                    </div>
                                                    <div class="card-block accordion-block">
                                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                                            <div class="accordion-panel">
                                                                <div class="accordion-heading" role="tab" id="headingOne">
                                                                    <a class="accordion-msg pt-3 waves-effect waves-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{$item->id}}" aria-expanded="true" aria-controls="collapseOne_{{$item->id}}">
                                                                        @lang('add_word')
                                                                    </a>
                                                                </div>
                                                                <div id="collapseOne_{{$item->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                                    <div class="row text-left m-0">
                                                                        @php 
                                                                            $tpm = false;
                                                                        @endphp
                                                                        @foreach($words as $word)
                                                                        @if($word->lesson_id == '')
                                                                        @php 
                                                                            $tpm = true;
                                                                        @endphp
                                                                        <div class="col-6 text-left label-main ">
                                                                            <label class="label text-xenter  label-inverse-info-border">
                                                                                <input type="checkbox" name="option{{$word->id}}" value="{{ $word->id }}">
                                                                                {{ $word->vocabulary }} <span class="txt-cate text-primary"> {{ '('. $word->category_name .')' }} </span></label>
                                                                        </div>
                                                                        @endif
                                                                        @endforeach
                                                                        @if($tpm == false)
                                                                        <p>@lang('not_have_word_free')</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('cancle')</button>
                                                        <button type="submit" class="btn btn-primary">@lang('update')</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('lessons.destroy',$item->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                            @lang('delete')
                                        </button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $lessons->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection