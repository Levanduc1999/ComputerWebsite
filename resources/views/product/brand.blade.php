@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Danh sách sản phẩm</h2>
						@foreach ($homeBrands as $product)
                        <a href="/home/product/detail/{{$product->product_id}}">
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{URL::to('upload/' . $product->product_image)}}" alt="" />
                                                <h2>{{$product->product_price}} VND</h2>
                                                <p>{{$product->product_name}}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </a>
						@endforeach											
</div><!--features_items-->
@endsection