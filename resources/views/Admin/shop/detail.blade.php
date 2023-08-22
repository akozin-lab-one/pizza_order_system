@extends('Admin.layouts.master')

@section('title', 'shopDetail')

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
                            <h3 class="text-center mb-3">Shop Detail</h3>
                            <div class="col-7 mx-auto">
                                <label for="">Name</label>
                                <input type="text" class="bg-secondary text-white ps-3" style="margin-left: 50px" value="{{$shop->name}}" disabled>
                                <br>
                                <label for="">Address</label>
                                <input type="text" class="bg-secondary text-white ps-3" style="margin-left: 33px" value="{{$shop->address}}" disabled>
                                <br>
                                <label for="">Employee</label>
                                <input type="text" class="bg-secondary text-white ps-3" style="margin-left: 20px" value="{{$shop->employee}}" disabled>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
