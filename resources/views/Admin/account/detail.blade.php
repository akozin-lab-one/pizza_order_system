@extends('Admin.layouts.master')

@section('title', 'accountDetail')

@section('myContent')
<div class="col-8 offset-1">
    @if (session('updateSuccess'))
    <div class="col-8 offset-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="zmdi zmdi-mood"></i> <small>{{(session('updateSuccess'))}}</small>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
    @endif
</div>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Account Information</h3>
                    </div>
                    <hr>
                    <form action="" method="post" novalidate="novalidate">
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
                                    <img class="img-thumbnail w-75" src="{{asset('storage/'. Auth::user()->image)}}" alt="">
                                @endif
                            </div>
                            <div class="col-6 mt-3">
                                <h4><i class="zmdi zmdi-account"></i> : {{Auth::user()->name}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-email"></i> : {{Auth::user()->email}}</h4>
                                <br>
                                <h4><i class="fa-solid fa-mars-and-venus"></i> : {{Auth::user()->gender}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-phone"></i> : {{Auth::user()->phone}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-pin"></i> : {{Auth::user()->address}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-time"></i> : {{Auth::user()->created_at->format('j-F-Y')}}</h4>
                                <br>
                            </div>
                        </div>

                        {{-- <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                <i class="zmdi zmdi-edit"></i>
                                <span id="payment-button-amount">Edit Account</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                            </button>
                        </div> --}}
                    </form>
                    <a class="btn btn-lg btn-dark btn-block" href="{{route('auth#edit')}}">
                        <i class="zmdi zmdi-edit"></i>
                        <span id="payment-button-amount">Edit Account</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
