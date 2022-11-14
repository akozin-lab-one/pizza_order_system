@extends('Admin.layouts.master')

@section('title', 'edit')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">

        @if (session('updatesuccess'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-mood"></i> <small>{{(session('createsuccess'))}}</small>
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
                            <a href="{{route('Category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                        <div class="card-title col-11 py-4">
                            <h3 class="text-center title-2">Edit Your Category</h3>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('Category#update', $category->id)}}" method="post" novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="categoryId" value="{{$category->id}}">
                            <label for="cc-payment" class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="categoryName" value="{{old('categoryName',$category->name)}}" type="text" class="form-control @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood...">

                            @error('categoryName')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                <span id="payment-button-amount">Update</span>
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
