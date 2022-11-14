@extends('User.layouts.master')

@section('myContent')
        <!-- Cart Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Image</th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($cartList as $c )
                            <tr>
                                <td><img class="img-thumbnail" src="{{asset('storage/'.$c->pizza_image)}}" alt="" style="width: 100px;"></td>
                                <td class="align-middle">
                                    {{$c->pizza_name}}
                                    <input type="hidden" class="orderId" value="{{$c->id}}">
                                    <input type="hidden" class="userId" value="{{$c->user_id}}">
                                    <input type="hidden" class="productId" value="{{$c->product_id}}">
                                </td>
                                <td class="align-middle" id="price">{{$c->pizza_price}} Kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->qty}}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" id="total">{{$c->pizza_price * $c->qty}} Kyats</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i class="fa fa-times"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6 id="subTotalPrice">{{$totalPrice}}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Delivery</h6>
                                <h6 class="font-weight-medium">3000 Kyats</h6>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5 id="finalPrice">{{$totalPrice + 3000}} Kyats</h5>
                            </div>
                            <button class="btn btn-block btn-primary  font-weight-bold my-3 py-3" id="addBtn">Proceed To Checkout</button>
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Remove Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart End -->
@endsection

@section('MyAjaxList')
 <script>
    $(document).ready(function(){
        $('.btn-plus').click(function(){
            $parentNode = $(this).parents("tr");
            $price = $parentNode.find('#price').html().replace("Kyats", "");
            $qty = $parentNode.find('#qty').val();
            $total = $price * $qty;
            $parentNode.find('#total').html($total + "Kyats");

            summeryCalculation();
        })

        $('.btn-minus').click(function(){
            $parentNode = $(this).parents("tr");
            $price = $parentNode.find('#price').html().replace("Kyats", "");
            $qty = Number($parentNode.find('#qty').val());
            $total = $price * $qty;
            $parentNode.find('#total').html($total + "Kyats");

            summeryCalculation();
        })

        $(".btnRemove").click(function(){
            $parentNode = $(this).parents("tr");
            $parentNode.remove();

            summeryCalculation();
        })

        function summeryCalculation(){
            $totalPrice = 0;
            $('#dataTable tr').each(function(index, row){
                $totalPrice += Number($(row).find('#total').text().replace("Kyats", ""));
            });

            $('#subTotalPrice').html(`${$totalPrice} Kyats`)
            $('#finalPrice').html(`${$totalPrice+3000} Kyats`)
        }
    })

    $('#addBtn').click(function(){
        $orderList = [];
        $random = Math.floor(Math.random() * 100000000001)

        $('#dataTable tbody tr').each(function(index, row){
                $orderList.push({
                    'user_id' : $(row).find('.userId').val(),
                    'product_id' : $(row).find('.productId').val(),
                    'qty' : $(row).find('#qty').val(),
                    'total' : Number($(row).find('#total').text().replace("Kyats", "")),
                    'order_code' : 'POS'+$random,
                });
            });

            $.ajax({
                    type : 'get',
                    url : '/user/ajax/orderList',
                    data : Object.assign({}, $orderList),
                    dataType : 'json',
                    success : function(response){
                        if (response.status == 'true') {
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                })

    })

    $('#clearBtn').click(function(){
        $('#dataTable tbody tr').remove();
        $('#subTotalPrice').html("0 Kyats");
        $('#finalPrice').html("3000 Kyats");

        $.ajax({
                type : 'get',
                url : '/user/ajax/clear/cart',
                dataType : 'json',
            })

    })

    $('.btnRemove').click(function(){
        $parentNode = $(this).parents("tr");
        $productId = $parentNode.find('.productId').val();
        $orderId = $parentNode.find('.orderId').val();

        $.ajax({
                    type : 'get',
                    url : '/user/ajax/clear/product/cart',
                    data : {'productId':$productId, 'orderId':$orderId},
                    dataType : 'json',
                })

    })
 </script>
@endsection
