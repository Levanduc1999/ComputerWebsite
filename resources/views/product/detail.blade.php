@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')
@foreach($productDetails as $productDetail)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('upload/' .$productDetail->product_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
						
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$productDetail->product_name}}</h2>
								<p>product ID: {{$productDetail->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<form>
										{{csrf_field()}}
										<span>{{number_format($productDetail->product_price)}} VNĐ</span>
										<label>Quantity:</label>
										<input type="number" class="product_order_quantity" min="1" value="1" />
										<button type="button" data-product_id="{{$productDetail->product_id}}" class="btn btn-fefault cart add-to-cart">
											<i class="fa fa-shopping-cart"></i>
											Thêm giỏ hàng
										</button>
									<form>
								</span>
								<p><b>Availability:</b>Còn hàng</p>
								<p><b>Condition:</b>Mới</p>
								<p><b>Brand:</b> {{$productDetail->brand_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->
	<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
								<li ><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Giới thiệu sản phẩm</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<div class="col-sm-12">
									<p>{!!$productDetail->product_content!!}</p>						
								</div>						
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-12">
									<p>{!!$productDetail->product_des!!}</p>	
								</div>
							</div>						
							<div class="tab-pane fade" id="tag" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<ul style="color: #ffcc00">
											<li>&#9733</li>
											<li>&#9733</li>
											<li>&#9733</li>
											<li>&#9733</li>
											<li>&#9733</li>
											<span><b>&nbsp;&nbsp;5 sao({{$fiveStar}} đánh giá)</b></span>
										</ul>
										<ul style="color: #ffcc00">
											<li>&#9733</li>
											<li>&#9733</li>
											<li>&#9733</li>
											<li>&#9733</li>
											<span><b>&nbsp;&nbsp;4 sao({{$fourStar}} đánh giá)  </b></span>
										</ul>
										<ul>
											<li>&#9733</li>
											<li>&#9733</li>
											<li>&#9733</li>
											<span><b>&nbsp;&nbsp;Dưới 3 sao({{$downThreeStar}} đánh giá)  </b></span>
										</ul>
										
									</ul>
									<div>
										@if($ratingsCustomer)
										<div>
											<p style><b>Đánh giá sản phẩm của bạn</b></p>
										</div>
										<div class="load">
											
											<ul>										
												@for($i=1; $i <= 5; $i++) 
													<?php
														if($ratingsCustomer->rating_number >= $i){
															$color = 'color: #ffcc00';
														}else {
															$color = 'color: #ccc';
														}
													?>
													<li 
													id="{{$productDetail->product_id}}-{{$i}}-{{Session::get('customerId')}}" 
													data-customer="{{Session::get('customerId')}}"
													data-ratingscustomer="{{$ratingsCustomer->rating_number}}"
													data-product_id="{{$productDetail->product_id}}"
													class="rating"
													style="font-size:23px;cursor: pointer; {{$color}}"
													data-rating="{{$i}}">
													&#9733</li>
												@endfor
											</ul>
										
										</div>
										@endif
									</div>
									<form action="#" method="post">
										<textarea class="feedback" name="feedback"></textarea>
										<b>All Rating:  ({{$avgStar}} <span style="color: #ffcc00">&#9733</span>)</b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Phản hồi
										</button>
									</form>
									<div class="fb-comments" data-href="{{URL::to('home/product/detail/' . $productDetail)}}" data-numposts="5"></div>
								</div>
							</div>
							
						</div>
	</div><!--/category-tab-->
@endforeach

<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>	
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach($productRelates as $productRelates)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">												
												<div class="productinfo text-center">
													<img src="{{URL::to('upload/' .$productRelates->product_image)}}" alt="" />
													<h2>{{number_format($productRelates->product_price)}} VND</h2>
													<p>{{$productRelates->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
												</div>
												
											</div>
										</div>
									</div>
									@endforeach
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
</div><!--/recommended_items-->

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });			
			
			
			$(".rating" ).hover(function() {		
				var starRating= $(this).data('rating');
				var dataProductId= $(this).data('product_id');
				var customerId= $(this).data('customer');
				for(let i=1; i<=starRating; i++){
					$('#' + dataProductId + '-' + i +'-'+customerId).css("color", "#ffcc00");
				}
				for(let i=starRating+1; i<=5; i++){
					$('#' + dataProductId + '-' + i +'-'+ customerId).css("color", "#ccc");
				}
			});
			$(".rating").click(function() {	
				var starRating= $(this).data('rating');
				var dataProductId= $(this).data('product_id');	
				$.ajax({
                        url: '/rating',
                        method: 'post',
                        data:{
                            starRating: starRating,
							dataProductId: dataProductId,	
                        },
						success:function(data){
							alert(data);
                    	}
                });
						
			});
			$(".pull-right").click(function() {	
				var dataFeedback= $('.feedback').text();	
				$.ajax({
                        url: '/mail-feedback-product',
                        method: 'post',
                        data:{
                            dataFeedback: dataFeedback,
                        },
						success:function(status){
							alert(status);
                    	}
                });
						
			});
			
        });
    </script>
@endsection