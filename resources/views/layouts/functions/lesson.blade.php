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
    <div class="pcoded-inner-content ">
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
                                <a href="{{ route('lessons', $data['course']->id) }}">
                                    {{ $data['course']->name }}
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a>
                                    {{ $data['lesson']->name }}</h5>
                                </a>
                                <a id="lesson_id">
                                    {{ $data['lesson']->id }}</h5>
                                </a>
                                <a id="user_id">
                                    {{ Auth::user()->id }}</h5>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div id="tools-voice" class="bg-info">
                        <p>@lang('voice')</p>
                        <select id="voices" class="form-select bg-secondary text-light"></select>
                        <!-- Range Slliders for Volume, Rate & Pitch -->
                        <div class="ml-3">
                            <p class="pl-0">@lang('volume')</p>
                            <input type="range" min="0" max="1" value="1" step="0.1" id="volume" />
                            <span id="volume-label" class="ms-2">1</span>
                        </div>
                        <div class="ml-3">
                            <p class="pl-0">@lang('rate')</p>
                            <input type="range" min="0.1" max="1.5" value="1" id="rate" step="0.1" />
                            <span id="rate-label" class="ms-2">1</span>
                        </div>
                    </div>
                    <div id="container-vocabulary">
                        @php
                        $stt = 0;
                        @endphp
                        @foreach($data['words'] as $word)
                        <div class="word card">
                            <div class="card-block caption-breadcrumb">
                                <p>
                                    @php
                                    $stt += 1;
                                    echo $stt;
                                    @endphp
                                </p>
                                <div class="breadcrumb-header">
                                    <div class="card-block table-border-style">
                                        <div class="table-responsive">
                                            <table class="table ">
                                                <tbody>
                                                    <tr>
                                                        <th class="align-middle"><span class="m-0 text-right"> @lang('vocabulary') : </span></th>
                                                        <td class="align-middle font-weight-bold text-capitalize txt-vocabulary" id="{{ $word->vocabulary }}">{{ $word->vocabulary }}</td>
                                                        <td class="align-middle">@foreach($data['categories'] as $cate)
                                                            @if($cate->id == $word->category_id)
                                                            <span>{{ '('. $cate->name .')' }}</span>
                                                            @break
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td class="align-middle">
                                                            <label onclick='speak("#{{ $word->vocabulary }}")' class="label label-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="currentColor" class="bi bi-volume-up" viewBox="0 0 16 16">
                                                                    <path d="M11.536 14.01A8.473 8.473 0 0 0 14.026 8a8.473 8.473 0 0 0-2.49-6.01l-.708.707A7.476 7.476 0 0 1 13.025 8c0 2.071-.84 3.946-2.197 5.303l.708.707z" />
                                                                    <path d="M10.121 12.596A6.48 6.48 0 0 0 12.025 8a6.48 6.48 0 0 0-1.904-4.596l-.707.707A5.483 5.483 0 0 1 11.025 8a5.483 5.483 0 0 1-1.61 3.89l.706.706z" />
                                                                    <path d="M10.025 8a4.486 4.486 0 0 1-1.318 3.182L8 10.475A3.489 3.489 0 0 0 9.025 8c0-.966-.392-1.841-1.025-2.475l.707-.707A4.486 4.486 0 0 1 10.025 8zM7 4a.5.5 0 0 0-.812-.39L3.825 5.5H1.5A.5.5 0 0 0 1 6v4a.5.5 0 0 0 .5.5h2.325l2.363 1.89A.5.5 0 0 0 7 12V4zM4.312 6.39 6 5.04v5.92L4.312 9.61A.5.5 0 0 0 4 9.5H2v-3h2a.5.5 0 0 0 .312-.11z" />
                                                                </svg>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle"><span class="m-0 text-right"> @lang('spelling') : </span></th>
                                                        <td>{{ '/'. $word->spelling .'/'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="align-middle"><span class="m-0 text-right txt-translate"> @lang('translate') : </span></th>
                                                        <td>{{ $word->translate }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div id="container-questions">
                        @php
                        $stt = 0;
                        @endphp
                        @foreach($data['questions'] as $question)
                        <div class="card question">
                            <div class="card-block caption-breadcrumb">
                                <div class="breadcrumb-header">
                                    <h5 class="mb-3">{{ $question->question }}</h5>
                                    <form id="questions{{ $question->id }}">

                                        @php
                                        $options = [$question->option_1, $question->option_2, $question->option_3];
                                        shuffle($options);
                                        @endphp
                                        <label class="d-block option{{ $question->id }}" for="option_1{{ $question->id }}">
                                            <input type="radio" id="option_1{{ $question->id }}" name="options{{ $question->id }}" value="{{ $options[0] }}"> {{ $options[0] }}</label>
                                        <label class="d-block option{{ $question->id }}" for="option_2{{ $question->id }}">
                                            <input type="radio" id="option_2{{ $question->id }}" name="options{{ $question->id }}" value="{{ $options[1] }}"> {{ $options[1] }}</label>
                                        <label class="d-block option{{ $question->id }}" for="option_3{{ $question->id }}">
                                            <input type="radio" id="option_3{{ $question->id }}" name="options{{ $question->id }}" value="{{ $options[2] }}"> {{ $options[2] }}</label>
                                    </form>
                                    <button id="checkAnswer{{ $question->id }}" onclick='checkAnswer("{{ $question->id }}")' class="checks btn btn-out-dotted waves-effect waves-light btn-info btn-square">@lang('show_result')</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button id="done-questions" onclick="saveResult()" class="btn btn-out-dotted waves-effect waves-light btn-info btn-square">@lang('submit')</button>
                <button id="next-vocabulary" class="btn btn-out-dotted waves-effect waves-light btn-info btn-square">@lang('next')</button>
            </div>
        </div>
    </div>
</div>
@endsection
