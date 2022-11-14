@extends('Admin.layouts.master')

@section('title', 'productList')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Product List</h2>

                    </div>
                </div>
                <div class="table-data__tool-right">
                    <a href="{{route('product#create')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>add Product
                        </button>
                    </a>
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        CSV download
                    </button>
                </div>
            </div>

            @if (session('deletesuccess'))
            <div class="col-4 offset-7">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-delete"></i> <small>{{(session('deletesuccess'))}}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif

            <div class="d-flex">
                <div class="col-3">
                    <h4>Search Key : <small class="text-danger"> {{request('key')}} </small> </h4>
                </div>
                <div class="col-3 offset-5">
                    <form action="{{route('product#list')}}" method="get">
                        <div class="d-flex">
                            <input type="text" class="form-control" name="key" value="{{request('key')}}" placeholder="Search..">
                            <button type="submit" class="btn btn-dark">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-1 text-center ms-3 fw-bold bg-light">
                    <i class="zmdi zmdi-storage"></i> : {{$products->total()}}
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                @if (count($products) != 0 )
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-2 text-center">Image</th>
                            <th class="col-2 text-center">Name</th>
                            <th class="col-2 text-center">Price</th>
                            <th class="col-2 text-center">Category</th>
                            <th class="col-2 text-center">View Count</th>
                            <th class="col-2 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p )
                        <tr class="tr-shadow">
                            <td class="col-2 text-center"><img src="{{asset('storage/'. $p->image)}}"></td>
                            <td class="col-2 text-center">{{$p->name}}</td>
                            <td class="col-2 text-center">{{$p->price}} Ks</td>
                            <td class="col-2 text-center">{{$p->category_name}}</td>
                            <td class="col-2 text-center">{{$p->view_count}}</td>
                            <td>
                                <div class="table-data-feature justify-content-evenly">
                                    <a href="{{route('product#view', $p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                            <i class="zmdi zmdi zmdi-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('product#editpage', $p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('product#delete', $p->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{$products->appends(request()->query())->links()}}
                </div>
                @else
                    <h3 class="text-secondary mt-5 text-center">There is no Pizza in this list!</h3>
                @endif
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
