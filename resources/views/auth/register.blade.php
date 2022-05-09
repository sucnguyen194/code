@extends('layouts.layout')
@section('title') Sign Up @stop
@section('content')
    <section class="account-section ptb-80 bg-overlay-white bg_img" data-background="/client/images/frontend/breadcrumbs/60d7134ad0d271624707914.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12">
                    <div class="account-form-area">
                        @if(setting('site.logo'))
                            <div class="account-logo-area text-center">
                                <div class="account-logo">
                                    <a href="/"><img src="{{setting('site.logo')}}" alt="logo"></a>
                                </div>
                            </div>
                        @endif
                        <div class="account-header text-center">
                            <h3 class="title">Create your account</h3>
                        </div>
                        <form class="account-form" action="{{route('register')}}" method="POST" >
                            @csrf
                            <div class="row ml-b-20">
                                <div class="col-lg-6 form-group">
                                    <label for="fullname">Full Name*</label>
                                    <input type="text" class="form-control form--control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required="" placeholder="Full name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label id="email">Email address*</label>
                                    <input type="email" class="form-control form--control checkUser @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" required="" placeholder="Email address">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-lg-6 form-group">
                                    <label id="country">Address</label>
                                    <input type="text" class="form-control form--control @error('address') is-invalid @enderror" name="address" value="{{old('address')}}" placeholder="Address">
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="mobile">Mobile</label>
                                    <div class="input-group country-code">

                                        <input type="text" name="phone" id="mobile" value="{{old('phone')}}" class="form-control form--control  @error('phone') is-invalid @enderror" placeholder="Your Phone Number">
                                    </div>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-lg-6 form-group hover-input-popup">
                                    <label for="password">Password*</label>
                                    <input type="password" class="form-control form--control @error('password') is-invalid @enderror" id="password" name="password" required="" placeholder="Enter password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label>Confirm Password*</label>
                                    <input type="password" class="form-control form--control" name="password_confirmation" required="" placeholder="Enter confirm password">
                                </div>


                                <div class="col-lg-12 form-group">
                                </div>



                                <div class="col-lg-12 form-group text-center">
                                    <button type="submit" class="submit-btn w-100">Register Now</button>
                                </div>

                                <div class="col-lg-12 text-center">
                                    <div class="account-item mt-10">
                                        <label>Already Have An Account? <a href="{{route('login')}}" class="text--base">Sign In</a></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
