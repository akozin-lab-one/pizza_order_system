@extends('Admin.layouts.master')

@section('title', 'createShop')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">

            @if (session('shopCreateSuccess'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-mood"></i> <small>{{(session('shopCreateSuccess'))}}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif

        </div>
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <a href="{{route('Shop#List')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                        <div class="card-title col-11">
                            <h3 class="text-center title-2 py-4">Create Your Shop</h3>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('create#shop')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="shop name...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Address</label>
                            <textarea name="address" value="{{old('address')}}" cols="30" class="form-control @error('address') is-invalid @enderror" rows="10" placeholder="Enter Your shop address.."></textarea>
                            @error('address')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Employee</label>
                            <input id="cc-pament" name="employee" value="{{old('employee')}}" type="text" class="form-control @error('employee') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="number of employee...">
                            @error('employee')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                <span id="payment-button-amount">Create</span>
                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                <i class="zmdi zmdi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
