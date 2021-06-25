@extends('layouts.theme')
@section('content')
<div class="pcoded-content">
    <!-- Page-header end -->
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-0 col-md-1"></div>
                    <div class="card col-12 col-md-8">
                        <div class="card-header">
                            <h5 class="w-40 card-header-text">@lang('notifications')</h5>
                            <form class="w-40 float-right" action="{{ route('notifications.mark_all_as_read')}}" method="POST">
                                @csrf
                                <label>@lang('mark_all_as_read')</label><button type="submit" class="ml-1 btn waves-effect waves-light"><i class="icofont icofont-check-circled"></i></button>
                            </form>
                        </div>
                        <div class="card-block accordion-block">
                            <div id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach ($notifications as $notify)
                                <div id="notification-show" class="accordion-panel">
                                    <div class="accordion-heading row" role="tab" id="heading{{$notify->id}}">
                                        <h3 class="card-title accordion-title col-8">
                                            @if($notify->is_read == 0)
                                            <a id="title{{$notify->id}}" onclick='showContentNotify("{{$notify->id}}")' class="accordion-msg waves-effect waves-dark" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$notify->id}}" aria-expanded="true" aria-controls="collapseOne{{$notify->id}}">
                                                {{ \Illuminate\Support\Str::limit($notify->content, 40, $end='...') }}
                                            </a>
                                            @else
                                            <a id="title{{$notify->id}}" class="waves-effect waves-dark nomal" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$notify->id}}" aria-expanded="true" aria-controls="collapseOne{{$notify->id}}">
                                                {{ \Illuminate\Support\Str::limit($notify->content, 40, $end='...') }}
                                            </a>
                                            @endif
                                        </h3>
                                        <span class="float-right txt-time col-4">{{ $notify->time }}</span>
                                    </div>
                                    <div id="collapseOne{{$notify->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$notify->id}}">
                                        <div class="accordion-content accordion-desc">
                                            <p>
                                                {{$notify->content}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-0 col-md-3"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
