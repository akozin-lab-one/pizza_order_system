@extends('Admin.layouts.master')

@section('title', 'userContactDetail')

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
                                @if ($user->name == $message->name)
                                    @if ($user->image == null)
                                        @if ($user->gender == 'male')
                                            <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown.jpg')}}" alt="">
                                        @else
                                            <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown_female.jpg')}}" alt="">
                                        @endif
                                    @else
                                        <img class="img-thumbnail w-75" src="{{asset('storage/'. Auth::user()->image)}}" alt="">
                                    @endif
                                @else
                                    <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/anonymous.png')}}">
                                @endif
                            </div>
                            <div class="col-6 mt-3">
                                <h4><i class="zmdi zmdi-account"></i> : {{$message->name}}</h4>
                                <br>
                                <h4><i class="zmdi zmdi-email"></i> : {{$message->email}}</h4>
                                <br>
                                <div class="d-flex">
                                    <p class="" ><i class="zmdi zmdi-comment-text-alt text-dark me-2"></i>: {{$message->message}}</p>
                                </div>

                                <br>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
