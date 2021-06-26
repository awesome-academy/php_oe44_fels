@extends('layouts.theme')
@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10 title-main">@lang('list_word')</h5>
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
                    <h5 class="text-dark">@lang('vocabulary_foru')</h5>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label text-center">
                            <h6>@lang('filter') <i class="ti-filter"></i></h6>
                        </label>
                        <div class="col-sm-6">
                            <select id="filter" name="select" class="form-control">
                                <option value="0">@lang('no_filter')</option>
                                <option value="1">@lang('filter_alphabet')</option>
                                <option value="2">@lang('filter_type')</option>
                                <option value="3">@lang('filter_learned')</option>
                                <option value="4">@lang('filter_unlearned')</option>
                            </select>
                        </div>
                        <div class="col-5 p-b-0">
                            <div class="form-material">
                                <div class="form-group form-primary">
                                    <input id="txtserach" type="text" name="footer-email" class="form-control" required="">
                                    <span class="form-bar"></span>
                                    <label class="float-label"><i class="fa fa-search m-r-10"></i>@lang('search')</label>
                                </div>
                            </div>
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
