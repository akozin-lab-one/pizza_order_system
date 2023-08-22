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
                    <form action="{{route('edit#shop')}}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group row">
                            <h3 class="text-center mb-3">Edit Your Shop Detail</h3>
                            <div class="col-7 mx-auto">
                                <label for="">Name</label>
                                <input type="text" name="name" class="bg-secondary text-white ps-3 form-control @error('name') is-invalid @enderror" value="{{old('name', $editShop->name)}}" style="margin-left: 20px">
                                <input type="hidden" name="shopId" value="{{$editShop->id}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <br>
                                <label for="">Address</label>
                                <input type="text" name="address" class="bg-secondary text-white ps-3 form-control @error('address') is-invalid @enderror" value="{{old('address', $editShop->address)}}" style="margin-left: 20px">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <br>
                                <label for="">Employee</label>
                                <input type="text" name="employee" class="bg-secondary text-white ps-3 form-control @error('employee') is-invalid @enderror" value="{{old('employee', $editShop->employee)}}" style="margin-left: 20px">
                                @error('employee')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <br>
                                <div class="mx-auto mt-2 col-4">
                                    <button id="payment-button" type="submit" class="btn btn-sm btn-dark col-9">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="zmdi zmdi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
