@extends('Admin.layouts.master')

@section('title', 'orderList')

@section('myContent')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="table-data__tool">
                <div class="table-data__tool-left">
                    <div class="overview-wrap">
                        <h2 class="title-1">Order List</h2>

                    </div>
                </div>
            </div>


            <div class="d-flex">
                <div class="col-5">
                    <h4>Search Key : <small class="text-danger"> {{request('key')}} </small> </h4>
                </div>
                <div class="col-5 offset-4 d-flex">
                    <form action="{{route('admin#orderlist')}}" method="get">
                        <div class="btn-group">
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
                    <i class="zmdi zmdi-storage"></i> : {{count($orders)}}
                </div>
                <div class="col-4 offset-9 d-flex">
                    <form action="{{route('admin#status')}}" method="get">
                        <div class="btn-group">
                            <select name="orderStatus" id="orderOption" class="form-control">
                                <option value="">All</option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                            <button type="submit" class="btn btn-dark">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="table-responsive table-responsive-data2">
                @if (count($orders) != 0 )
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-2 text-center">User ID</th>
                            <th class="col-2 text-center">User Name</th>
                            <th class="col-2 text-center">Order Date</th>
                            <th class="col-2 text-center">Order Code</th>
                            <th class="col-2 text-center">Amount</th>
                            <th class="col-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody id="pizzaList">
                        @foreach ($orders as $o )
                        <tr class="tr-shadow">
                            <input type="hidden" value="{{$o->id}}" class="orderId">
                            <td class="col-2 text-center">{{$o->user_id}}</td>
                            <td class="col-2 text-center">{{$o->user_name}}</td>
                            <td class="col-2 text-center">{{$o->created_at->format('F-j-Y')}}</td>
                            <td class="col-2 text-center">
                                <a class="text-decoration-none" href="{{route('admin#orderdetail', $o->order_code)}}">{{$o->order_code}}</a>
                            </td>
                            <td class="col-2 text-center">{{$o->total_price}}</td>
                            <td class="col-2 text-center">
                                <select name="" class="form-control orderStatus">
                                    <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                    <option value="1" @if ($o->status == 1) selected @endif>Accept</option>
                                    <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                </select>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h3 class="text-secondary mt-5 text-center">There is no Order in this list!</h3>
                @endif
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>
@endsection

@section('adminjs')
    <script>
        // $(document).ready(function(){
        //     $('#orderOption').change(function(){
        //         $status = $('#orderOption').val();
        //         console.log($status);

        //         if ($status == 0) {
        //             $.ajax({
        //             type : 'get',
        //             url : 'http://127.0.0.1:8000/order/ajax/status/list',
        //             data : {'status': $status},
        //             dataType : 'json',
        //             success : function(response){
        //                 console.log(response);
        //                 $list = ``;
        //                 for (let $i = 0; $i < response.length; $i++) {
        //                     $Month = ['January', 'February', 'March', 'April', 'May', 'John', 'July', 'August', 'Sepetember', 'October', 'November', 'December'];
        //                     $dbDate = new Date(response[$i].created_at);
        //                     $finalDate = $Month[$dbDate.getMonth()] + "-" + $dbDate.getDate() +"-"+ $dbDate.getFullYear();

        //                     if (response[$i].status == 0) {
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control orderStatus">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 1){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control orderStatus">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 2){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control orderStatus">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                         `;
        //                     }

        //                     $list +=
        //                             `
        //                             <tr class="tr-shadow">
        //                                 <input type="hidden" value="${response[$i].id}" class="orderId">
        //                                 <td class="col-2 text-center">${response[$i].user_id}</td>
        //                                 <td class="col-2 text-center">${response[$i].user_name}</td>
        //                                 <td class="col-2 text-center">${$finalDate}</td>
        //                                 <td class="col-2 text-center">${response[$i].order_code}</td>
        //                                 <td class="col-2 text-center">${response[$i].total_price}</td>
        //                                 <td class="col-2 text-center">${$statusMessage}</td>
        //                             </tr>
        //                             <tr class="spacer"></tr>

        //                             `;
        //                     $('#pizzaList').html($list);
        //                 }
        //             }
        //         })
        //         }else if($status == 1){
        //             $.ajax({
        //             type : 'get',
        //             url : 'http://127.0.0.1:8000/order/ajax/status/list',
        //             data : {'status': $status},
        //             dataType : 'json',
        //             success : function(response){
        //                 $list = ``;
        //                 for (let $i = 0; $i < response.length; $i++) {
        //                     $Month = ['January', 'February', 'March', 'April', 'May', 'John', 'July', 'August', 'Sepetember', 'October', 'November', 'December'];
        //                     $dbDate = new Date(response[$i].created_at);
        //                     $finalDate = $Month[$dbDate.getMonth()] + "-" + $dbDate.getDate() +"-"+ $dbDate.getFullYear();

        //                     if (response[$i].status == 0) {
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 1){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 2){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                         `;
        //                     }

        //                     $list +=
        //                             `
        //                             <tr class="tr-shadow">
        //                                 <input type="hidden" value="${response[$i].id}" class="orderId">
        //                                 <td class="col-2 text-center">${response[$i].user_id}</td>
        //                                 <td class="col-2 text-center">${response[$i].user_name}</td>
        //                                 <td class="col-2 text-center">${$finalDate}</td>
        //                                 <td class="col-2 text-center">${response[$i].order_code}</td>
        //                                 <td class="col-2 text-center">${response[$i].total_price}</td>
        //                                 <td class="col-2 text-center">${$statusMessage}</td>
        //                             </tr>
        //                             <tr class="spacer"></tr>

        //                             `;
        //                     $('#pizzaList').html($list);
        //                 }
        //             }
        //         })
        //         }else if ($status == 2) {
        //             $.ajax({
        //             type : 'get',
        //             url : 'http://127.0.0.1:8000/order/ajax/status/list',
        //             data : {'status': $status},
        //             dataType : 'json',
        //             success : function(response){
        //                 $list = ``;
        //                 for (let $i = 0; $i < response.length; $i++) {
        //                     $Month = ['January', 'February', 'March', 'April', 'May', 'John', 'July', 'August', 'Sepetember', 'October', 'November', 'December'];
        //                     $dbDate = new Date(response[$i].created_at);
        //                     $finalDate = $Month[$dbDate.getMonth()] + "-" + $dbDate.getDate() +"-"+ $dbDate.getFullYear();

        //                     if (response[$i].status == 0) {
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 1){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 2){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                         `;
        //                     }

        //                     $list +=
        //                             `
        //                             <tr class="tr-shadow">
        //                                 <input type="hidden" value="${response[$i].id}" class="orderId">
        //                                 <td class="col-2 text-center">${response[$i].user_id}</td>
        //                                 <td class="col-2 text-center">${response[$i].user_name}</td>
        //                                 <td class="col-2 text-center">${$finalDate}</td>
        //                                 <td class="col-2 text-center">${response[$i].order_code}</td>
        //                                 <td class="col-2 text-center">${response[$i].total_price}</td>
        //                                 <td class="col-2 text-center">${$statusMessage}</td>
        //                             </tr>
        //                             <tr class="spacer"></tr>

        //                             `;
        //                     $('#pizzaList').html($list);
        //                 }
        //             }
        //             })
        //         }else if($status == 'null'){
        //             $.ajax({
        //             type : 'get',
        //             url : 'http://127.0.0.1:8000/order/ajax/status/list',
        //             data : {'status': $status},
        //             dataType : 'json',
        //             success : function(response){
        //                 $list = ``;
        //                 for (let $i = 0; $i < response.length; $i++) {
        //                     $Month = ['January', 'February', 'March', 'April', 'May', 'John', 'July', 'August', 'Sepetember', 'October', 'November', 'December'];
        //                     $dbDate = new Date(response[$i].created_at);
        //                     $finalDate = $Month[$dbDate.getMonth()] + "-" + $dbDate.getDate() +"-"+ $dbDate.getFullYear();

        //                     if (response[$i].status == 0) {
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 1){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                         `;
        //                     }else if(response[$i].status == 2){
        //                         $statusMessage =
        //                         `
        //                         <select name="" class="form-control">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                         `;
        //                     }

        //                     $list +=
        //                             `
        //                             <tr class="tr-shadow">
        //                                 <input type="hidden" value="${response[$i].id}" class="orderId">
        //                                 <td class="col-2 text-center">${response[$i].user_id}</td>
        //                                 <td class="col-2 text-center">${response[$i].user_name}</td>
        //                                 <td class="col-2 text-center">${$finalDate}</td>
        //                                 <td class="col-2 text-center">${response[$i].order_code}</td>
        //                                 <td class="col-2 text-center">${response[$i].total_price}</td>
        //                                 <td class="col-2 text-center">${$statusMessage}</td>
        //                             </tr>
        //                             <tr class="spacer"></tr>

        //                             `;
        //                     $('#pizzaList').html($list);
        //                 }
        //             }
        //             })
        //         }
        //     })

        // })

        //change status
        $('.orderStatus').change(function(){
            $parentNode = $(this).parents("tr");
            $orderId = $parentNode.find('.orderId').val();
            $currentStatus = $parentNode.find('.orderStatus').val();

            console.log($orderId);
            $data = {
                'status' : $currentStatus,
                'orderId' : $orderId,
            }

            console.log($data);

            $.ajax({
                    type : 'get',
                    url : '/order/ajax/status/change',
                    data : $data,
                    dataType : 'json',
            })

        })
    </script>
@endsection
