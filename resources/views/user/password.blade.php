@extends('layouts.layout')
@section('title') Change Password @stop
@section('content')

    <section class="account-section ptb-80 bg-overlay-white bg_img" data-background="/client/images/frontend/breadcrumbs/60d7134ad0d271624707914.jpg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="account-form-area">
                        @if(setting('site.logo'))
                            <div class="account-logo-area text-center">
                                <div class="account-logo">
                                    <a href="/"><img src="{{setting('site.logo')}}" alt="logo"></a>
                                </div>
                            </div>
                        @endif
                        <div class="account-header text-center">
                            <h3 class="title">Change Password</h3>
                        </div>
                        <form class="account-form ajax-form" data-reset="true" method="POST" action="{{ route('user.password.update') }}">
                            @csrf
                            <div class="row ml-b-20">
                                <div class="col-lg-12 form-group">
                                    <label for="username">Old password*</label>
                                    <input type="password" class="form-control form--control" id="old_password" name="old_password" value="" placeholder="Enter old password" required>
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label for="password">New Password*</label>
                                    <input type="password" class="form-control form--control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password" required>
                                </div>

                                <div class="col-lg-12 form-group">
                                    <label for="password">Confirm Password*</label>
                                    <input type="password" class="form-control form--control" name="password_confirmation" placeholder="Enter confirm password">
                                </div>

                                <div class="col-lg-12 form-group text-center">
                                    <button type="submit" class="submit-btn w-100">Change Password</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
