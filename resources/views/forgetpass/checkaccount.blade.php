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
    @include('partials.header')
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">   
                        @if (session('sucsess'))
                            <div class="status" style="color: forestgreen" >
                                <i class="fa fa-check text-success text-active"></i>
                                {{ session('sucsess') }}
                            </div>
                        @elseif(session('sucsesser'))
                            <div class="statuser" style="color: red">
                                <i class="fa fa-times text-danger text"></i>
                                {{ session('sucsesser') }}
                            </div>
                        @endif                   
                        <div class="login-form"><!--login form-->
						<h2>Nhập tên email</h2>
						<form action="/checkaccountforget" method="post">
                            {{csrf_field()}}
							<input type="email" name="forgetEmail" placeholder="Địa chỉ email"/>						
							<button type="submit" class="btn btn-default">Tìm lại mật khẩu</button>
						</form>
					    </div><!--/login form-->
                        
                    </div>
                </div>
            </div>
        </section>

    @include('partials.script')
</body>