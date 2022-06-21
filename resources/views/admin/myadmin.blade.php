<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('Admins/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('Admins/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('Admins/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('Admins/css/font.css')}}" type="text/css"/>
<link href="{{asset('Admins/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('Admins/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('Admins/css/monthly.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('Admins/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('Admins/js/raphael-min.js')}}"></script>
<script src="{{asset('Admins/js/morris.js')}}"></script>
<style>
    .error {
        color : red;
    }
</style>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        VISITORS
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-success">8</span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p class="">You have 8 pending tasks</p>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>25% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="45">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Product Delivery</h5>
                                <p>45% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="78">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Payment collection</h5>
                                <p>87% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="60">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Target Sell</h5>
                                <p>33% , Deadline  12 June’13</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="90">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>

                <li class="external">
                    <a href="#">See All Tasks</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-important">4</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <p class="red">You have 4 Mails</p>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                <span class="subject">
                                <span class="from">Jonathan Smith</span>
                                <span class="time">Just now</span>
                                </span>
                                <span class="message">
                                    Hello, this is an example msg.
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/1.png"></span>
                                <span class="subject">
                                <span class="from">Jane Doe</span>
                                <span class="time">2 min ago</span>
                                </span>
                                <span class="message">
                                    Nice admin template
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/3.png"></span>
                                <span class="subject">
                                <span class="from">Tasi sam</span>
                                <span class="time">2 days ago</span>
                                </span>
                                <span class="message">
                                    This is an example msg.
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="images/2.png"></span>
                                <span class="subject">
                                <span class="from">Mr. Perfect</span>
                                <span class="time">2 hour ago</span>
                                </span>
                                <span class="message">
                                    Hi there, its a test
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">See all messages</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 overloaded.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #3 overloaded.</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username">{{Auth::user()->admin_name}}</span>      
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="/adminlogout"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                        <span>Chủ đề</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('topic.create')}}">Thêm chủ đề</a></li>
						<li><a href="{{route('topic.index')}}">Quản lí chủ đề</a></li>                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bài viết</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('post.create')}}">Thêm bài viết</a></li>
						<li><a href="{{route('post.index')}}">Quản lí bài viết</a></li>                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-sliders" aria-hidden="true"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('slider.create')}}">Thêm slider</a></li>
						<li><a href="{{route('slider.index')}}">Quản lý slider</a></li>                        
                    </ul>
                </li>
                @hasanyrole(['admin','distributor'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-user" ></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('user.index')}}">Danh sách người dùng</a></li>                        
                    </ul>
                </li>
                @endhasanyrole
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('categoryproducts.create')}}">Thêm danh mục</a></li>
						<li class="sub-menu">
                            <a>Danh sách danh mục</a>
                            <ul class="sub">
                                <li><a  href="{{route('categoryproducts.index')}}" style="padding-left:80px">Danh mục lớn</a></li> 
                                <li><a style="padding-left:80px" href="/categorychildren">Danh mục nhỏ</a></li>                       
                            </ul>
                        </li>            
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('brand.create')}}">Thêm thương hiệu</a></li>
						<li><a href="{{route('brand.index')}}">Danh sách thương hiệu</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('product.create')}}">Thêm sản phẩm</a></li>
						<li><a href="{{route('product.index')}}">Danh sách sản phẩm</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tag "></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('coupon.create')}}">Thêm mã giảm giá</a></li>
						<li><a href="{{route('coupon.index')}}">Danh sách mã giảm giá</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-ship"></i>
                        <span>Phí vận chuyển</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('fee.index')}}">Quản lý</a></li>						                     
                    </ul>
                </li>
                 <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-first-order "></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">				
						<li><a href="{{route('adminorder.index')}}">Danh sách đơn hàng</a></li>
                        
                    </ul>
                </li>
                
             
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
    @yield('content')
<!--main content end-->
</section>
<script src="{{asset('Admins/js/bootstrap.js')}}"></script>
<script src="{{asset('Admins/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('Admins/js/scripts.js')}}"></script>
<script src="{{asset('Admins/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('Admins/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('jqueryvalidation/dist/jquery.validate.js')}}"></script>
@yield('scriptadmin')
<script>
    CKEDITOR.replace('topicDescripsion');
    CKEDITOR.replace('sliderContent');
    CKEDITOR.replace('categoryDescripsion');
    CKEDITOR.replace('categoryChildrenDescripsion');
    CKEDITOR.replace('brandDescripsion');
    CKEDITOR.replace('productDescripsion');
    CKEDITOR.replace('productContent');
    CKEDITOR.replace('posttDescripsion');
    CKEDITOR.replace('postContent');
    CKEDITOR.replace('postName');
    $("#topicCreate, #topicEdit").validate({
			rules: {
				topicName: {
                    required: true,
					minlength: 6
                }
			},
			messages: {
				topicName: {
                    required: "Hãy nhập tên chủ đề",
                    minlength: "Tên chủ đề cần tối thiểu 6 kí tự"
                }
			},    
	});
    $("#sliderCreate, #sliderEdit").validate({
			rules: {
				sliderName: {
                    required: true,
					minlength: 6
                }
			},
			messages: {
				sliderName: {
                    required: "Hãy nhập tên Slider",
                    minlength: "Tên slider cần tối thiểu 6 kí tự"
                }
			},    
	});
    $("#categoryCreate, #categoryEdit").validate({
			rules: {
				categoryName: {
                    required: true,
					minlength: 6
                }
			},
			messages: {
				categoryName: {
                    required: "Hãy nhập tên danh mục",
                    minlength: "Tên danh mục cần tối thiểu 6 kí tự"
                }
			},    
	});
    
     $("#categoryChidlrenCreate, #categoryChidlrenEdit").validate({
			rules: {
				categoryChildrenName: {
                    required: true,
					minlength: 6
                }
			},
			messages: {
				categoryChildrenName: {
                    required: "Hãy nhập tên danh mục",
                    minlength: "Tên danh mục cần tối thiểu 6 kí tự"
                }
			},    
	});
    
    
    $("#brandCreate, #brandEdit").validate({
			rules: {
				brandName: {
                    required: true,
					minlength: 3
                }
			},
			messages: {
				brandName: {
                    required: "Làm ơn nhập tên thương hiệu",
                    minlength: "Tên thương hiệu cần ít nhất 3 kí tự"
                }
			},
            submitHandler: function(form) {
                form.submit();
            },           
	});
    $("#productEdit").validate({
			rules: {
				productName: {
                    required: true,
					minlength: 6
                },
                productPrice: {
                    number: true
                },
			},
			messages: {
				productName: {
                    required: "Làm ơn nhập tên sản phẩm",
                    minlength: "Tên sản phẩm cần ít nhất 6 kí tự"
                },
                productPrice: {
                    number: "Giá sản phẩm phải là số"
                },
			},
            submitHandler: function(form) {
                form.submit();
            },           
	});
    $("#productCreate").validate({
			rules: {
				productName: {
                    required: true,
					minlength: 6
                },
                productPrice: {
                    number: true
                },
                productImage: {
                    required: true, 
                    extension: "png|jpeg|jpg",
                    filesize: 1048576,
                }
			},
			messages: {
				productName: {
                    required: "Làm ơn nhập tên sản phẩm",
                    minlength: "Tên sản phẩm cần ít nhất 6 kí tự"
                },
                productPrice: {
                    number: "Giá sản phẩm phải là số"
                },
                productImage : {
                    required: "Hãy chọn một ảnh",
                    extension : "file được chọn có đuôi .png, .jpeg, .jpg",
                    filesize : "kich thước không được vượt quá 1048576kb"
                }
			},
            submitHandler: function(form) {
                form.submit();
            },           
	});
     $("#postCreate").validate({
			rules: {
                postImage: {
                    required: true, 
                    extension: "png|jpeg|jpg",
                    filesize: 1048576,
                }
			},
			messages: {
                postImage : {
                    required: "Hãy chọn một ảnh",
                    extension : "file được chọn có đuôi .png, .jpeg, .jpg",
                    filesize : "kich thước không được vượt quá 1048576kb"
                }
			},
            submitHandler: function(form) {
                form.submit();
            },           
	});
    $("#couponCreate").validate({
			rules: {
				couponName: {
                    required: true,
					minlength: 6
                },
                couponCode: {
                    required: true,
					minlength: 4
                },
                couponQuantity: {
                    number: true
                },
                couponNumber: {
                    number: true
                },
			},
			messages: {
				couponName: {
                    required: "Hãy nhập tên mã giảm giá",
                    minlength: "Tên mã giảm giá cần ít nhất 6 kí tự"
                },
                couponCode: {
                    required: "Hãy nhập code của mã giảm giá",
                    minlength: "Tên mã giảm giá cần ít nhất 4 kí tự"
                },
                couponQuantity: {
                    number: "Hãy nhập số"
                },
                couponNumber: {
                    number: "Hãy nhập số"
                },
			},
            submitHandler: function(form) {
                form.submit();
            },           
	});
     $("#feeCreate").validate({
			rules: {
				fee: {
                    number: true
                }
			},
			messages: {
				fee: {
                    number: "Hãy nhập số",
                }
			},
            submitHandler: function(form) {
                form.submit();
            },           
	});

</script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('Admins/js/jquery.scrollTo.js')}}"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('Admins/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
