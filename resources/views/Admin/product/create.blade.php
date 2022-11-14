@extends('Admin.layouts.master')

@section('title', 'createProduct')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">

            @if (session('productCreateSuccess'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-mood"></i> <small>{{(session('productCreateSuccess'))}}</small>
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
                            <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                        <div class="card-title col-11">
                            <h3 class="text-center title-2 py-4">Create Your Product</h3>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('product#createdata')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="name" value="{{old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="pizza name...">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Category</label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror">
                                <option value="">Choose Your Category...</option>
                                @foreach ($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Description</label>
                            <textarea name="description" value="{{old('description')}}" cols="30" class="form-control @error('description') is-invalid @enderror" rows="10" placeholder="Enter Your Product Decription.."></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                            <input type="text" name="waitingTime" class="form-control @error('waitingTime') is-invalid @enderror">
                            @error('waitingTime')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">price</label>
                            <input id="cc-pament" name="price" value="{{old('price')}}" type="text" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="price...">
                            @error('price')
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
