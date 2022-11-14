@extends('Admin.layouts.master')

@section('title', 'accountRoleChange')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <a class="col-2 text-dark" href="{{route('auth#accountlist', Auth::user()->id)}}"><i class="fa-solid fa-arrow-left"></i></a>
                        <h3 class="offset-1 text-center title-2 d-inline">Change Account Role</h3>
                    </div>
                    <hr>
                    <form action="{{route('auth#change' , $account->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-6">
                                @if ($account->image == null)
                                    @if ($account->gender == 'male')
                                        <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown.jpg')}}" alt="">
                                    @else
                                        <img class="img-thumbnail w-75 ms-3 mt-2" src="{{asset('image/unknown_female.jpg')}}" alt="">
                                    @endif
                                @else
                                    <img class="img-thumbnail w-75 mt-2" src="{{asset('storage/' . $account->image)}}" alt="">
                                @endif
                            </div>
                            <div class="col-5 mt-3">
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-account"></i> : </h4>
                                    <input class="ms-2 form-control col-10" disabled type="text" name="name" value="{{$account->name}}">
                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="fa-regular fa-flag"></i> : </h4>
                                    <select name="role" class="form-control col-10 ms-1">
                                        <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                        <option value="user" @if ($account->role == 'user') selected @endif>User</option>
                                    </select>
                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-email"></i> : </h4>
                                    <input class="ms-2 form-control col-10" disabled type="text" name="email" value="{{$account->email}}">
                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-account"></i> : </h4>
                                    <select name="gender" class="ms-2 form-control col-10" disabled>
                                        <option value="">Choose Your gender....</option>
                                        <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                        <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                    </select>
                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-phone"></i> : </h4>
                                    <input class="ms-2 form-control col-10" disabled type="text" name="phone" value="{{$account->phone}}">
                                </div>
                                <br>
                                <div class="d-flex">
                                    <h4 class="mt-2"><i class="zmdi zmdi-pin"></i> : </h4>
                                    <input class="ms-2 form-control col-10" disabled type="text" name="address" value="{{$account->address}}">
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="text-center">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark">
                                <i class="zmdi zmdi-edit"></i>
                                <span id="payment-button-amount">Change Account Role</span>
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
