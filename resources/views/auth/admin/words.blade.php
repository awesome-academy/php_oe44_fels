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
                        <form class="col-7" action="{{route('words.store')}}" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label class="mb-2 " for="">@lang('vocabulary')</label>
                                <input type="text" class="form-control" name="vocabulary" placeholder='@lang("enter") @lang("vocabulary")'>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2 " for="">@lang('translate')</label>
                                <input type="text" class="form-control" name="translate" placeholder='@lang("enter") @lang("translate")'>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2 " for="">@lang('spelling')</label>
                                <input type="text" class="form-control" name="spelling" placeholder='@lang("enter") @lang("spelling")'>
                            </div>
                            <div class="form-group mb-2">
                                <label class="mb-2 " for="">@lang('category_name')</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark text-secondary bg-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>@lang('add')</button>
                        </form>
                        <div class="col-5"></div>
                    </div>
                    <table class="mt-5 col-6 table  table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">@lang('vocabulary')</th>
                                <th scope="col">@lang('translate')</th>
                                <th scope="col">@lang('spelling')</th>
                                <th scope="col">@lang('category_name')</th>
                                <th scope="col">@lang('lesson_of_word')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $index = 1;
                            @endphp
                            @foreach($words as $item)
                            <tr>
                                <th>{{ $index++ }}</th>
                                <th>{{$item->vocabulary}}</th>
                                <td>{{$item->translate}}</td>
                                <td>{{$item->spelling}}</td>
                                <td>{{$item->category_name}}</td>
                                <td>{{ $item->topic_name }} <b>/</b> {{ $item->course_name }} <b>/</b>  {{ $item->lesson_name }}</td>
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
                                                <form action="{{ route('words.update',$item->id)}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="col-form-label">@lang('vocabulary'):</label>
                                                            <input type="text" class="form-control" value="{{ $item->vocabulary }}" name="vocabulary" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label">@lang('translate'):</label>
                                                            <input type="text" class="form-control" value="{{ $item->translate }}" name="translate" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label">@lang('spelling'):</label>
                                                            <input type="text" class="form-control" value="{{ $item->spelling }}" name="spelling" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label">@lang('category_name'):</label>
                                                            <select name="category_id" class="form-control">
                                                                @foreach($categories as $cate)
                                                                @if($item->category_id == $cate->id)
                                                                <option selected value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                                @else
                                                                <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
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
                                    <form action="{{ route('words.destroy',$item->id)}}" method="POST">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection