@extends('Admin.layouts.master')

@section('title', 'contactMessage')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">

            <div class="d-flex">
                <div class="col-1 text-center ms-3 mt-2 fw-bold bg-light">
                    <i class="zmdi zmdi-storage"></i> : {{ $messages->total()}}
                </div>
                <div class="col-3 offset-8">
                    <form action="{{route('admin#contact')}}" method="get">
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

            </div>

            <div class="table-responsive table-responsive-data2">
                @if (count($messages) != 0 )
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-1">Name</th>
                            <th class="col-2">Email</th>
                            <th class="col-2">Message</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $m)
                        <tr class="tr-shadow">
                            <td class="col-1">{{$m->id}}</td>
                            <td class="col-1">{{$m->name}}</td>
                            <td class="col-1">{{$m->email}}</td>
                            <td class="col-2">{{$m->message}}</td>
                            <td class="col-1">
                                <div class="table-data-feature justify-content-evenly">
                                    <a href="{{route('admin#contactdetail', $m->id)}}">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="view">
                                            <i class="zmdi zmdi zmdi-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('admin#deleteMessage', $m->id)}}">
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
                    {{$messages->appends(request()->query())->links()}}
                </div>
                @else
                <h3 class="text-secondary mt-5 text-center">There is no Contact Message for Your Shop!</h3>
                 @endif
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
