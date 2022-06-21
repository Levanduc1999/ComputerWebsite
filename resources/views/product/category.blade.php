@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')

<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Danh sách sản phẩm</h2>
						@foreach ($homeProductsCategorys as $product)
                        <a href="/home/product/detail/{{$product->product_id}}">
						<form>
							{{csrf_field()}}
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('upload/' . $product->product_image)}}" alt="" />
											<h2>{{$product->product_price}} VND</h2>
											<p>{{$product->product_name}}</p>
											<input type="number" class="product_order_quantity" value="1" style="display: none"/>
											<a href="#" class="btn btn-default add-to-cart" data-product_id="{{$product->product_id}}"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
								</div>
							</div>
						</div>
						</form>
                        </a>
						@endforeach										
</div><!--features_items-->


@endsection