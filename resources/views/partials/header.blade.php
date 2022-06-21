<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 0964246501</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> levanduc1999bn@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/home')}}"><img src="{{URL::to('Eshopper/images/home/logo.png')}}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{URL::to('/account')}}"><i class="fa fa-user"></i>Tài khoản</a></li>
								<!-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> -->
								<li><a href="/ordercheckout"><i class="fa fa-crosshairs"></i>Thủ tục thanh toán</a></li>
								<li><a href="/order"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
								@if (Session::get('customerId'))
									<li><a href="/login_checkout"><i class="fa fa-lock"></i>Đăng xuất</a></li>
								@elseif(!Session::get('customerId'))
									<li><a href="/login_checkout"><i class="fa fa-lock"></i>Đăng nhập</a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/home')}}" class="active">Trang trủ</a></li>
								<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="/productnew">Sản phẩm mới</a></li>
										<li><a href="/producthot">Sản phẩm nổi bật</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($topics as $topic)
										<li><a href="{{URL::to('/home/topic',['id'=>$topic->topic_id])}}">{{$topic->topic_name}}</a></li>
										@endforeach
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="#">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" class="seach" name="search" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
</header><!--/header-->
