@extends('Admin.layouts.master')

@section('title', 'orderList')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-responsive table-responsive-data2">
                <div class="col-2">
                    <a class="text-dark text-decoration-none" href="{{route('admin#orderlist')}}">
                        <i class="fa-solid fa-arrow-left-long"></i> Back
                    </a>
                </div>

                <div class="row ms-2">
                    <div class="card col-4">
                        <div class="card-body">
                            <h3><i class="fa-solid fa-clipboard me-3"></i> Order Info</h3>
                            <span class="text-warning">Include Delivery Charge</span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-user me-3"></i> Name</div>
                                <div class="col">{{strtoupper($orderlists[0]->user_name)}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-barcode me-3"></i> Order Code</div>
                                <div class="col">{{$orderlists[0]->order_code}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-clock me-3"></i> Order Date</div>
                                <div class="col">{{$orderlists[0]->created_at->format('F-j-Y')}}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col"><i class="fa-solid fa-money-bill-wave me-3"></i> Total</div>
                                <div class="col">{{$order->total_price}} Kyats</div>
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-2 text-center">User ID</th>
                            <th class="col-2 text-center">Product Image</th>
                            <th class="col-2 text-center">Product Name</th>
                            {{-- <th class="col-2 text-center">Order Date</th> --}}
                            <th class="col-2 text-center">Qty</th>
                            <th class="col-2 text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="pizzaList">
                        @foreach ($orderlists as $o )
                        <tr class="tr-shadow">
                            <td class="col-2 text-center">{{$o->id}}</td>
                            <td class="col-2 text-center">
                                <img class="img-thumbnail w-50" src="{{asset('storage/'.$o->product_image)}}" alt="productImage">
                            </td>
                            <td class="col-2 text-center">{{$o->product_name}}</td>
                            {{-- <td class="col-2 text-center">{{$o->created_at->format('F-j-Y')}}</td> --}}
                            <td class="col-2 text-center">{{$o->qty}}</td>
                            <td class="col-2 text-center">{{$o->total}}</td>
                        </tr>
                        <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection
