@extends('Admin.layouts.master')

@section('title', 'changePassword')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Change Your Password</h3>
                    </div>
                    @if (session('passwordchangesuccess'))
                    <div class="col-6 offset-2">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                             <small>{{(session('passwordchangesuccess'))}}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <hr>
                    <form action="{{route('auth#passwordchange')}}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Old Password</label>
                            <input id="cc-pament" name="oldPassword" value="" type="password" class="form-control @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="old password...">

                            @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror

                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                            <input id="cc-pament" name="newPassword" value="" type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="new password...">

                            @error('newPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror

                            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                            <input id="cc-pament" name="confirmPassword" value="" type="password" class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="confirm password...">


                            @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                <i class="zmdi zmdi-key"></i>
                                <span id="payment-button-amount">Change Password</span>
                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
