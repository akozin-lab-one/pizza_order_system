@extends('User.layouts.master')

@section('title', 'pizzadetail')

@section('myContent')
        <!-- Shop Detail Start -->
        <div class="container-fluid pb-5">
            <div class="row px-xl-5">
                <div>
                    <a class="text-dark" href="{{route('user#home')}}"><i class="fa-solid fa-arrow-left me-2"></i>Back</a>
                </div>
                <div class="col-lg-5 mb-3 text-center">
                    <img class="w-75 h-100" src="{{asset('storage/'. $pizza->image)}}" alt="Image">
                </div>

                <div class="col-lg-7 h-auto mb-30">
                    <div class="h-100 bg-light p-30">
                        <input type="hidden" name="userId" value="{{Auth::user()->id}}" id="userId">
                        <input type="hidden" name="pizzaId" value="{{$pizza->id}}" id="pizzaId">
                        <h3>{{$pizza->name}}</h3>
                        <div class="d-flex mb-3">
                            <span class="fs-3">{{$pizza->view_count+1}}</span><i class="fa-solid fa-eye fs-3 ms-2 pt-2"></i>
                        </div>
                        <h3 class="font-weight-semi-bold mb-4">{{$pizza->price}} Kyats</h3>
                        <p class="mb-4">{{$pizza->description}}</p>
                        <div class="d-flex align-items-center mb-4 pt-2">
                            <div class="input-group quantity mr-3" style="width: 130px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control bg-secondary border-0 text-center" value="1" id="pizzaCount">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary px-3" id="addToCart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                Cart</button>
                        </div>
                        <div class="d-flex pt-2">
                            <strong class="text-dark mr-2">Share on:</strong>
                            <div class="d-inline-flex">
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a class="text-dark px-2" href="">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p )
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('storage/'.$p->image)}}" alt="" style="height: 270px;">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#productdetail', $p->id)}}"><i class="fa fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$p->price}} Kyats</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <span class="fs-3">{{$pizza->view_count}}</span><i class="fa-solid fa-eye fs-3 ms-2 pt-2"></i>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('MyAjaxList')
<script>
    $(document).ready(function(){

        $.ajax({
                    type : 'get',
                    url : '/user/ajax/view/count',
                    data : {'pizzaId' : $('#pizzaId').val()},
                    dataType : 'json',
                })

        $('#addToCart').click(function(){
            $source = {
                'userId' : $('#userId').val(),
                'pizzaId' : $('#pizzaId').val(),
                'count' : $('#pizzaCount').val()
            };

            $.ajax({
                    type : 'get',
                    url : '/user/ajax/addTocart',
                    data : $source,
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                            window.location.href = "http://127.0.0.1:8000/user/home";
                        }
                    }
                })
        })
    })
</script>
@endsection
