@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')
<section id="form" style="margin:20px 0px"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="/login" method="post">
                            {{csrf_field()}}
							<input type="email" name="login_email" placeholder="Email Address"/>
							<input type="password" name="login_password" placeholder="Password"/>
							<span>
								<input type="checkbox" class="checkbox"> 
								Nhớ tài khoản
							</span>
							<span >
								<a href="/forgetpass">Quên mật khẩu</a>			
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí!</h2>
						<form action="/register" method="post">
                            {{csrf_field()}}
							<input type="text" name="register_name" placeholder="Tên"/>
							<input type="email" name="register_email" placeholder="Email"/>
							<input type="password" name="register_password" placeholder="Mật khẩu"/>
                            <input type="number" name="register_phone" placeholder="Số điện thoại"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
</section><!--/form-->
@endsection
@section('script')
    <script type="text/javascript">
        $('#slider-carousel').hide();
		$('.col-sm-3').hide();
    </script>
@endsection