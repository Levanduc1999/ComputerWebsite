<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home | E-Shopper</title>
    @include('partials.style')
</head><!--/head-->

<body>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0" nonce="pW8UbRmv"></script>
	@include('partials.header')
	
    @include('partials.slider')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">			
						<h2>Danh mục sản phẩm</h2>	
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->						
							<div class="panel panel-default">
								@foreach ($categorys as $category)
									<div class="panel-heading">
										<h4 class="panel-title">													
												<a data-toggle="collapse" data-parent="#accordian" href="#{{$category->category_id}}">
													<span class="badge pull-right"><i class="fa fa-plus"></i></span>
													{{$category->category_name}}
												</a>
										</h4>
									</div>
									<div id="{{$category->category_id}}" class="panel-collapse collapse">
										<div class="panel-body">
										@foreach($categoryChildrens as $categoryChildren)
											@if($categoryChildren->category_id==$category->category_id)
											<ul>
												<li><a href="/home/category/{{$categoryChildren->category_childrens_id}}">{{$categoryChildren->category_childrens_name}}</a></li>
											</ul>
											@endif
										@endforeach
										</div>
									</div>
								@endforeach
							</div>
						</div><!--/category-products-->
						
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								@foreach($brands as $brand)
								<ul class="nav nav-pills nav-stacked">
									<li><a href="/home/brand/{{$brand->brand_id}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
								</ul>
								@endforeach
							</div>
						</div><!--/brands_products-->
						
							
					</div>
				</div>
				
				<div class="col-sm-9 padding-right load_search">
					@yield('content')	
				</div>
			</div>
		</div>
	</section>
	
	@include('partials.footer')

    @include('partials.script')
	<script>
		
		$(".add-to-cart").click(function (event) {
			var productId= $(this).data('product_id');
			alert(productId);
			var _token = $('input[name="_token"]').val();
			var productOrderQuantity = $(".product_order_quantity").val();
			$.ajax({
        		url: '/order',
                method: 'POST',
                data:{
					productId:productId,
					_token:_token,
					productOrderQuantity: productOrderQuantity
				},
				success:function(result){
					alert("Thêm vào giỏ hàng thành công");
				}
			});			
		});
		$(".seach").on('keypress',function(e) {
			var dataSearch = $(this).val();
			if(e.which == 13) {
				alert(dataSearch);
				$.ajax({
					url: '/search',
					method: 'GET',
					data:{
						dataSearch:dataSearch,
					},
					success:function(product){
						console.log(product);
						var html ="";
						var	urlshow = window.location.origin;
						alert(urlshow);
						for(var pro of product){
							html += '<div class="col-sm-5">';
								html += '<div class="view-product">';
									html +=	'<img src="' + urlshow + '/upload/' + pro.product_image + '"/>';
									html += '<h3>ZOOM</h3>';
								html +='</div>';	
							html += '</div>';
							html +='<div class="col-sm-7">';
								html +='<div class="product-information"><!--/product-information-->';
									html +='<img src="images/product-details/new.jpg" class="newarrival" alt="" />';
									html +='<h2>' + pro.product_name + '</h2>';
									html +='<p>Web ID:' + pro.product_id + '</p>';
									html +='<img src="images/product-details/rating.png" alt="" />';
									html +='<span>';
										html +='<form>';
										html += '<input type="hidden" name="_token" value="hGob6FshdRleXJkiBL5Fwwlf2CT3CN5YPyS9s7qn">';
												html +='<span>' + pro.product_price + 'VND</span>';
												html +='<label>Quantity:</label>';
												html +='<input type="number" class="product_order_quantity" min="1" value="1" />';
												html +='<button type="button" data-product_id="' + pro.product_id + '" class="btn btn-fefault cart add-to-cart">';
												html +='<i class="fa fa-shopping-cart"></i>';
													html +='Add to cart';
												html +='</button>';
										html +='<form>';
									html +='</span>';
									html +='<p><b>Availability:</b>Con hang</p>';
									html +='<p><b>Condition:</b>Moi</p>';
									html +='<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>';
								html +='</div><!--/product-information-->';
							html +='</div>';
						}	
						$(".load_search").html(html);			
					}
				});	
				
			}
		});
		
   @yield('script')	
   
</body>
</html>