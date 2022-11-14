@extends('Admin.layouts.master')

@section('title', 'listPage')

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
                    <a href="{{route('Category#createPage')}}">
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>add Category
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
                    <form action="{{route('Category#list')}}" method="get">
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
                    <i class="zmdi zmdi-storage"></i> : {{$categories->total()}}
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                @if (count($categories) != 0 )
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th></th>
                            <th>Category Name</th>
                            <th></th>
                            <th>Created Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category )
                        <tr class="tr-shadow">
                            <td>{{$category->id}}</td>
                            <td></td>
                            <td>
                                {{$category->name}}
                            </td>
                            <td></td>
                            <td>{{$category->created_at->format('j-Y-m')}}</td>
                            <td>
                                <div class="table-data-feature justify-content-evenly">
                                    <a href="{{route('Category#editPage', $category->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('Category#delete', $category->id)}}">
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
                    {{$categories->appends(request()->query())->links()}}
                </div>
                @else
                    <h3 class="text-secondary mt-5 text-center">There is no Category for Pizza!</h3>
                @endif
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
