@extends('Admin.layouts.master')

@section('title', 'productDetail')

@section('myContent')
<div class="col-8 offset-1">
    @if (session('updateSuccess'))
    <div class="col-4 offset-7">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="zmdi zmdi-mood"></i> <small>{{(session('updateSuccess'))}}</small>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
    </div>
    @endif
</div>
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-lg-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col ms-3">
                            {{-- <a href="{{route('product#list')}}"> --}}
                                <i class="zmdi zmdi-arrow-left text-dark fs-3" onclick="history.back()"></i>
                            {{-- </a> --}}
                        </div>
                    </div>
                    {{-- <hr> --}}
                    <form action="" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group row">
                            <div class="col-5">
                                <img class="img-thumbnail w-75 ms-3" src="{{asset('storage/'. $pizza->image)}}" alt="">
                            </div>
                            <div class="col-7">
                                <div class="btn col-md-5 btn-danger mb-3 d-block ">{{$pizza->name}}</div>
                                <span class="btn btn-dark text-white"><i class="fa-solid fa-clone"></i> : {{$pizza->category_name}}</span>
                                <span class="btn btn-dark text-white"><i class="fa-regular fa-money-bill"></i> : {{$pizza->price}} Kyats</span>
                                <span class="btn btn-dark text-white"><i class="fa-solid fa-clock"></i> : {{$pizza->waiting_time}}</span>
                                <span class="btn btn-dark text-white"><i class="fa-solid fa-eye"></i> : {{$pizza->view_count}}</span>
                                <span class="btn btn-dark text-white mt-2"><i class="fa-regular fa-calendar-plus"></i> : {{$pizza->created_at->format('j-F-Y')}}</span>
                                <div class="mt-2"><i class="fa-regular fa-file-lines"></i></div>
                                <div>{{$pizza->description}}</div>
                                {{-- <div class="d-flex justify-content-end me-3">
                                    <a class="text-decoration-none text-dark" href="{{route('product#editpage', $pizza->id)}}">
                                        <i class="zmdi zmdi-edit"></i>
                                        <span id="payment-button-amount">Edit Pizza Info</span>
                                    </a>
                                </div> --}}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
