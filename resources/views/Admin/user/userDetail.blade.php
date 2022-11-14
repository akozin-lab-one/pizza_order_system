@extends('Admin.layouts.master')

@section('title', 'userAccountDetail')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex">
                        <i class="zmdi zmdi-arrow-left text-dark fs-3" onclick="history.back()"></i>
                        <div class="col-4 offset-3">
                            <h3 class="title-2">User Information</h3>
                        </div>
                    </div>
                    <hr>
                        <div class="form-group row">
                            <div class="col-6">
                                @if ($user->image == null)
                                    @if ($user->gender == 'male')
                                        <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown.jpg')}}" alt="">
                                    @else
                                        <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown_female.jpg')}}" alt="">
                                    @endif
                                @else
                                    <img class="img-thumbnail w-75" src="{{asset('storage/'. $user->image)}}" alt="">
                                @endif
                            </div>
                            <div class="col-6 mt-3">
                                <h4><i class="zmdi zmdi-account"></i> : {{$user->name}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-email"></i> : {{$user->email}}</h4>
                                <br>
                                <h4><i class="fa-solid fa-mars-and-venus"></i> : {{$user->gender}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-phone"></i> : {{$user->phone}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-pin"></i> : {{$user->address}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-time"></i> : {{$user->created_at->format('j-F-Y')}}</h4>
                                <br>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
