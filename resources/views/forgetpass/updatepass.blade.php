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
                        <?php
                            $email =$_GET['email'];
                            $token = $_GET['token'];
                        ?>               
                        <div class="login-form"><!--login form-->
						<h2>Thay đổi mật khẩu</h2>
                          
						<form action="/new-pass" method="post">
                            {{csrf_field()}}
							<input type="pass" name="password" placeholder="Nhập mật khẩu"/>
                            <input type="pass" name="email" value={{$email}}  style="display:none"/>
                            <input type="password" name="retypePass" placeholder="Nhập lại mật khẩu"/>	
                            <input type="pass" name="token"  value={{$token}} style="display:none"/>						
							<button type="submit" class="btn btn-default">Đổi mật khẩu</button>
						</form>
					    </div><!--/login form-->
                        
                    </div>
                </div>
            </div>
        </section>

    @include('partials.script')
</body>