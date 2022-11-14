@extends('User.layouts.master')

@section('myContent')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 offset-2 table-responsive mb-5" style="height: 500px">
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable" >
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order Id</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($orderhistory as $o )
                            <tr>
                                <td class="align-middle">{{$o->created_at->format('F-j-Y')}}</td>
                                <td class="align-middle">{{$o->order_code}}</td>
                                <td class="align-middle">{{$o->total_price}}</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <span class="text-warning btn btn-light btn-outline-dark">
                                            <i class="fa-regular fa-clock me-2"></i>Pending...</span>
                                    @elseif ($o->status == 1)
                                        <span class="text-success btn btn-light btn-outline-dark">
                                            <i class="fa-regular fa-thumbs-up me-2"></i>Success...</span>
                                    @elseif ($o->status == 2)
                                    <span class="text-danger btn btn-light btn-outline-dark">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Reject...</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{$orderhistory->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection
