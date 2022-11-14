@extends('user.layouts.master')

@section('title', 'MainPage')

@section('myContent')
        <!-- Shop Start -->
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Sidebar Start -->
                <div class="col-lg-3 col-md-4">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by Categories</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <form>
                            <div class="d-flex align-items-center justify-content-between mb-3 bg-dark py-2 px-3">
                                <label class="h5 text-white my-2" for="price-all">Categories</label>
                                <span class="font-weight-normal text-white">{{count($category)}}</span>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{route('user#home')}}" class="text-dark"><label class="h5" for="price-1">All</label></a>
                            </div>
                            @foreach ($category as $c )
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="{{route('user#filter', $c->id)}}" class="text-dark"><label class="h5" for="price-1">{{$c->name}}</label></a>
                            </div>
                            @endforeach
                        </form>
                    </div>
                    <!-- Price End -->
                </div>
                <!-- Shop Sidebar End -->


                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <a href="{{route('user#CartList')}}" class="">
                                        <button type="button" class="btn btn-dark text-white position-relative">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{count($cartData)}}
                                            </span>
                                          </button>
                                    </a>
                                    <a href="{{route('user#OrderHistory')}}" class="ms-3">
                                        <button type="button" class="btn btn-dark text-white position-relative">
                                            <i class="fa-solid fa-clock-rotate-left"></i> History
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{count($orderhistory)}}
                                            </span>
                                          </button>
                                    </a>
                                </div>
                                <div class="ml-2 mt-1">
                                    <div class="btn-group">
                                        <select name="sorting" id="sortingOption" class="form-control btn-dark text-white">
                                            <option value="">Choose a option...</option>
                                            <option value="asc">Aescing</option>
                                            <option value="desc">Descing</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="row" id="pizzaList">
                            @if (count($pizzas) != 0 )
                            @foreach ($pizzas as $p )
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <input type="hidden" id="userId" value="{{Auth::user()->id}}">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 280px;" src="{{asset('storage/'. $p->image)}}" alt="">
                                            <input type="hidden" id="count" value="0">
                                            <div class="product-action">
                                                <a type="button" class="btn btn-outline-dark btn-square" id="cartBtn"><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#productdetail', $p->id)}}"><i class="fa fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <input type="hidden" id="pizzaId" value="{{$p->id}}">
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{$p->price}}</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                                <p class="text-center fs-2 shadow col-6 offset-3">There is no Products here! <i class="fa-solid fa-pizza-slice ms-3"></i></p>
                            @endif
                        </span>
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
@endsection

@section('MyAjaxList')
    <script>
        $('#sortingOption').change(function(){
            $eventOption = $('#sortingOption').val();
            console.log($eventOption);

            if($eventOption == 'asc'){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizzaList',
                    data : {'status': 'asc'},
                    dataType : 'json',
                    success : function(response){
                        $list = ``;
                        for (let $i = 0; $i < response.length; $i++) {
                            $list +=
                                    `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" style="height: 270px; width:250px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price}</h5>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                            $('#pizzaList').html($list);
                        }
                    }
                })
            }else if($eventOption == 'desc'){
                $.ajax({
                    type : 'get',
                    url : '/user/ajax/pizzaList',
                    data : {'status': 'desc'},
                    dataType : 'json',
                    success : function(response){
                        $list = ``;
                        for (let $i = 0; $i < response.length; $i++) {
                            $list +=
                                    `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                                <div class="product-item bg-light mb-4">
                                                    <div class="product-img position-relative overflow-hidden">
                                                        <img class="img-fluid w-100" style="height: 270px; width:250px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                                        <div class="product-action">
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="text-center py-4">
                                                        <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                                            <h5>${response[$i].price}</h5>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                                            <small class="fa fa-star text-primary mr-1"></small>
                                                            <small class="fa fa-star text-primary mr-1"></small>
                                                            <small class="fa fa-star text-primary mr-1"></small>
                                                            <small class="fa fa-star text-primary mr-1"></small>
                                                            <small class="fa fa-star text-primary mr-1"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>`;
                            $('#pizzaList').html($list);
                        }
                    }
                })
            }
        })

        // $('#cartBtn').click(function(){
        //     $count = $('#count').val()*1;
        //     console.log($count);
        //     while ($count != 0) {
        //         $count++;
        //     }

        //     $source = {
        //         'userId' : $('#userId').val(),
        //         'pizzaId' : $('#pizzaId').val(),
        //         'count' : $count,
        //     };

        //     console.log($source);
        // })

    </script>
@endsection
