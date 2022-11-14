@extends('Admin.layouts.master')

@section('title', 'accountDetail')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Account Information</h3>
                    </div>
                    <hr>
                    <form action="{{route('auth#update', Auth::user()->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-6">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender == 'male')
                                        <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown.jpg')}}" alt="">
                                    @else
                                        <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown_female.jpg')}}" alt="">
                                    @endif
                                @else
                                    <img class="img-thumbnail w-75 mt-2" src="{{asset('storage/' . Auth::user()->image)}}" alt="">
                                @endif
                                <input type="file" class=" mt-2 form-control w-75 ms-3 @error('image') is-invalid @enderror" name="image">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-5 mt-3">
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-account"></i> : </h4>
                                    <input class="ms-2 form-control col-10 @error('name') is-invalid @enderror" type="text" name="name" value="{{Auth::user()->name}}">

                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-email"></i> : </h4>
                                    <input class="ms-2 form-control col-10 @error('email') is-invalid @enderror" type="text" name="email" value="{{Auth::user()->email}}">

                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="fa-solid fa-mars-and-venus"></i> : </h4>
                                    <select name="gender" class="ms-2 form-control col-10">
                                        <option value="">Choose Your gender....</option>
                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                    </select>
                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-phone"></i> : </h4>
                                    <input class="ms-2 form-control col-10 @error('phone') is-invalid @enderror" type="text" name="phone" value="{{Auth::user()->phone}}">

                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-pin"></i> : </h4>
                                    <input class="ms-2 form-control col-10 @error('address') is-invalid @enderror" type="text" name="address" value="{{Auth::user()->address}}">

                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="fa-regular fa-flag"></i> : </h4>
                                    <input class="ms-2 form-control col-10" type="text" name="role" value="{{Auth::user()->role}}" disabled>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="text-center">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark">
                                <i class="zmdi zmdi-edit"></i>
                                <span id="payment-button-amount">Update Account</span>
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
