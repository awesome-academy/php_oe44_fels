@extends('layouts.app')

@section('content')
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <form class="md-float-material form-material" method="POST" action="{{ route('user.login') }}">
                    @csrf
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">@lang('Login')</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <span class="form-bar"></span>
                                <label class="float-label">@lang('Email')</label>
                                @if(session("statusEmail"))
                                <p class="text-danger"> {{ session("statusEmail") }}</p>
                                @endif
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="form-group form-primary">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <span class="form-bar"></span>
                                <label class="float-label">@lang('Password')</label>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if(session("statusPassword"))
                                <p class="text-danger"> {{ session("statusPassword") }}</p>
                                @endif

                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary d-">
                                        <label>
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <label class="form-check-label" for="remember">
                                                @lang('Remember Me')
                                            </label>
                                        </label>
                                    </div>
                                    <div class="forgot-phone text-right f-right">
                                        @if (Route::has('password.request'))
                                        <a class="text-right f-w-600" href="{{ route('password.request') }}">
                                            @lang('ForgotPassword?')
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                                        @lang('Login')
                                    </button>
                                </div>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <a href="{{route('login.facebook')}}" class="btn waves-effect waves-light btn-facebook"><i class="icofont icofont-social-facebook"></i>Facebook</a>
                                    <a href="#" class="btn waves-effect waves-light btn-twitter"><i class="icofont icofont-social-twitter"></i>Twitter</a>
                                    <a href="{{route('login.google')}}" class="btn waves-effect waves-light btn-google-plus"><i class="icofont icofont-social-google-plus"></i>Google</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
@endsection
