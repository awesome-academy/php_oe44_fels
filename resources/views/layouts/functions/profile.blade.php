@extends('layouts.theme')
@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10 title-main">@lang('Profile')</h5>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Thong tin ca nhan</h5>
                                    <label class="text-right float-right" for="edit">
                                        <input type="checkbox" id="edit" class="mb-3">
                                        Edit My Profile
                                    </label>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    @if(session('EmailAlreadyExist'))
                                    <p>{{ session('EmailAlreadyExist') }}</p>
                                    @else
                                    <p>that</p>
                                    @endif
                                    <div class="mb-2 text-center">
                                        <label>
                                            @if(Auth::user()->provider_id && strpos(Auth::user()->avatar,'http'))
                                            <img class="rounded avatar" src="{{$inforUser->avatar}}" alt="{{$inforUser->name}}">
                                            @else
                                            <img class="rounded avatar" src='{{ asset("$inforUser->avatar") }}' alt="{{$inforUser->name}}">
                                            @endif
                                        </label>
                                    </div>

                                    <div class="row">
                                        <label class="col-4 text-right">Name</label>
                                        <label class="col-1 ">:</label>
                                        <label class="col-7">{{$inforUser->name}}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-4 text-right">Email</label>
                                        <label class="col-1 ">:</label>
                                        <label class="col-7">{{$inforUser->email}}</label>
                                    </div>
                                    <div class="row">
                                        <label class="col-4 text-right">Registration Date</label>
                                        <label class="col-1 ">:</label>
                                        <label class="col-7">{{$inforUser->created_at}}</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="form-edit-user" class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit</h5>
                                    <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
                                </div>
                                <div class="card-block">
                                    <form action="{{route('user.profile')}}" class="form-material" enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-5 text-center">
                                            <label for="avatar">
                                                @if(Auth::user()->provider_id && strpos(Auth::user()->avatar,'http'))
                                                <img class="img-radius avatar" src="{{$inforUser->avatar}}" alt="{{$inforUser->name}}">
                                                <input hidden type="file" name="avatar" id="avatar" value="{{$inforUser->avatar}}" class="position-absolute">
                                                @else
                                                <img class="img-radius avatar" src='{{ asset("$inforUser->avatar") }}' alt="{{$inforUser->name}}">
                                                <input hidden type="file" name="avatar" id="avatar" value='{{ asset("$inforUser->avatar") }}' class="position-absolute">
                                                @endif

                                            </label>
                                        </div>

                                        <div class="form-group form-default form-static-label">
                                            <input type="text" name="name" class="form-control" value="@if(old('name')) {{ old('name') }} @else {{$inforUser->name}} @endif" required="">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Your Name</label>

                                        </div>
                                        @if(Auth::user()->provider_id == null)
                                        <div class="form-group form-default form-static-label">
                                            <input type="text" name="email" class="form-control" value="@if(old('name')) {{ old('email') }} @else {{$inforUser->email}} @endif" required="">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Your Email</label>

                                        </div>
                                        <label for="changePass">
                                            <input type="checkbox" name="isChangePassword" id="changePass" class="mb-3">
                                            Change Your Password

                                        </label>
                                        <div class="p-3" id="container_password">
                                            <div class="form-group form-default form-static-label">
                                                <input type="password" name="password_current" class="form-control">
                                                <span class="form-bar"></span>
                                                <label class="float-label">Current Password</label>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 form-group form-default form-static-label">
                                                    <input type="password" name="password" class="pass form-control">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label pl-3">New Password</label>
                                                </div>
                                                <div class="col-6 form-group form-default form-static-label">
                                                    <input type="password" name="password_confirm" class="pass form-control">
                                                    <span class="form-bar"></span>
                                                    <label class="float-label pl-3">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <input type="submit" class="float-right btn btn-primary waves-effect waves-light" value="Update">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
