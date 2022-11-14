@extends('Admin.layouts.master')

@section('title', 'editProduct')

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
        <div class="col-lg-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex">
                        <div class="col-1">
                            <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                        <div class="col-11">
                            <h3 class="text-center title-2 py-4">Edit Your Product</h3>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('product#update')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group ms-5">
                                    <img src="{{asset('storage/'.$product->image)}}" class="w-75 mb-1">
                                    <input type="file" name="image" class="col-9 form-control @error('image') is-invalid @enderror" value="{{old('image', $product->image)}}">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="ms-5">
                                    <button id="payment-button" type="submit" class="btn btn-sm btn-dark col-9">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="zmdi zmdi-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input type="hidden" name="productId" value="{{$product->id}}">
                                    <input id="cc-pament" name="name" value="{{old('name', $product->name )}}" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="pizza name...">
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
                                            <option value="{{$c->id}}" @if ($c->id == $product->category_id) selected @endif>{{$c->name}}</option>
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
                                    <textarea name="description" value="" cols="30" class="form-control @error('description') is-invalid @enderror" rows="10" placeholder="Enter Your Product Decription..">{{old('description', $product->description)}}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input type="text" name="waitingTime" class="form-control @error('waitingTime') is-invalid @enderror" value="{{old('waitingTime', $product->waiting_time)}}">
                                    @error('waitingTime')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">price</label>
                                    <input id="cc-pament" name="price" value="{{old('price', $product->price)}}" type="text" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="price...">
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">View Count</label>
                                    <input type="text" class="form-control" value="{{$product->view_count}}" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input type="text" class="form-control" value="{{$product->created_at->format('j-F-Y')}}" disabled>
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
