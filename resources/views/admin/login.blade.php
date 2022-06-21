<!DOCTYPE html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
  
    @include('admin.cs.style')
    <style>
        .status {
            color: red;
            padding: 0px;
            text-align: center;
	        font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng nhập</h2>
            <form action="{{URL::to('/adminlogin')}}" method="post">
                {{csrf_field()}}
                @if (session('statuslogin'))
                    <div class="status">
                        {{ session('statuslogin') }}
                    </div>
                @endif
                <input type="email" class="ggg" name="admin_email" placeholder="E-MAIL" required="">
                <input type="password" class="ggg" name="admin_password" placeholder="PASSWORD" required="">
                <span><input type="checkbox" />Nhớ mật khẩu</span>
                <h6><a href="#">Quên mật khẩu?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Đăng nhập" name="login">
            </form>
            <p>Bạn đã có tài khoản ?<a href="/register">Tạo tài khoản</a></p>
        </div>
    </div>
    @include('admin.js.script')
</body>


</html>