@extends('layouts.theme')
@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10 title-main">@lang('ListWord')</h5>
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
                    <h5 class="text-dark">@lang('VocabularyForU')</h5>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label text-center">
                            <h6>@lang('Filter') <i class="ti-filter"></i></h6>
                        </label>
                        <div class="col-sm-11">
                            <select id="filter" name="select" class="form-control">
                                <option value="0">@lang('NoFilter')</option>
                                <option value="1">@lang('FilterAlphabet')</option>
                                <option value="2">@lang('FilterType')</option>
                                <option value="3">@lang('FilterLearned')</option>
                                <option value="4">@lang('FilterUnlearned')</option>
                            </select>
                        </div>
                    </div>
                    <div id="wordElements" class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
