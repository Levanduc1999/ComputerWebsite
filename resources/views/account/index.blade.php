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
                    <div class="col-sm-12">                       
                        <div class="category-tab"><!--category-tab-->           
                            <div class="col-sm-6" style="padding:0px">
                                <ul class="nav nav-tabs">
                                    <li class=""><a href="#tshirt" data-toggle="tab">Đơn hàng</a></li>
                                    <li class="active"><a href="#blazers" data-toggle="tab">Thông tin tài khoản</a></li>
                                </ul>
                            </div>
                            <div class="tab-content" style="padding: 100px 0px">
                                @if (session('status'))
                                <div class="status" style="color: forestgreen" >
                                    <i class="fa fa-check text-success text-active"></i>
                                    {{ session('status') }}
                                </div>
                                @elseif(session('statuser'))
                                    <div class="statuser" style="color: red">
                                        <i class="fa fa-times text-danger text"></i>
                                        {{ session('statuser') }}
                                    </div>
                                @endif
                                <div class="tab-pane fade " id="tshirt">  
                                    <div class="table-responsive">
                                        <table class="table table-striped b-t b-light">
                                            <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Phương thức thanh toán</th>
                                                <th>Tổng tiền đơn hàng</th>
                                                <th>Hành động</th>
                                                
                                            </tr>
                                            </thead>
                                            @foreach($orderInformations as $orderInformation)
                                            <tbody>
                                                <tr>
                                                    <td><span>{{$orderInformation->id}}</span></td>
                                                    <td>
                                                        @if($orderInformation->id==1)
                                                            <span>Thanh toán trực tiếp</span>
                                                        @else
                                                            <span>Thanh toán bằng ATM</span>
                                                        @endif
                                                    </td>
                                                    <td><span>{{number_format($orderInformation->order_total, 0, ',', '.')}} vnđ</span></td>
                                                    <td><a href="{{URL::to('/account/order/'. $orderInformation->id)}}" onclick="return confirm('Bạn có thực sự muốn hủy đơn hàng này')" style="border: 1px solid; color: white; background: red; padding: 6px; border-radius: 8px;">Hủy đơn hàng</a></td>
                                                </tr>     
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>         
                                </div>             
                                <div class="tab-pane fade active in" id="blazers" >   
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
                                    <div class="login-form" style="width:50%"><!--login form-->
                                        <form action="/account" method="post" >
                                            {{csrf_field()}}
                                            <div>
                                                <p>
                                                    <i class="fa fa-user icon-left" style="color:#FE980F;font-size:23px"aria-hidden="true"></i> 
                                                        &nbsp;<b>Tên tài khoản:</b>&nbsp;&nbsp;&nbsp;{{$customers->customer_name}} 
                                                    <i class="fa fa-pencil-square-o icon-right"  style="color:#40403E;float:right;font-size:23px"></i>
                                                </p>
                                                <input type="hidden" name="customer_name" value="{{$customers->customer_name}}" placeholder="Nhập Tên"/>
                                            </div>                   
                                            <div>
                                                <p >
                                                    <i class="fa fa-envelope icon-left" style="color:#FE980F;font-size:23px" aria-hidden="true"></i> 
                                                        <b>Email:</b>&nbsp;&nbsp;&nbsp;{{$customers->customer_email}} 
                                                    <i class="fa fa-pencil-square-o icon-right"  style="color:#40403E; float:right;font-size:23px"></i>
                                                </p>
                                                <input type="hidden" name="customer_email" value="{{$customers->customer_email}}" placeholder="Nhập Email"/>
                                            </div>
                                             <div>
                                                <p >
                                                    <i class="fa fa-unlock-alt icon-left" style="color:#FE980F;font-size:23px" aria-hidden="true"></i> 
                                                        &nbsp;&nbsp;<b>Mật khẩu:</b> ********
                                                    <i class="fa fa-pencil-square-o icon-right"  style="color:#40403E;float:right;font-size:23px"></i>
                                                </p>
                                                <input type="hidden" name="customer_password" value="" placeholder="Nhập mật khẩu"/>                        
                                            </div>
                                             <div>
                                                <p >
                                                    <i class="fa fa-phone icon-left" style="color:#FE980F;font-size:23px" aria-hidden="true"></i> 
                                                        <b>&nbsp;Điện thoại:</b>&nbsp;&nbsp;&nbsp;{{$customers->customer_phone}} 
                                                    <i class="fa fa-pencil-square-o icon-right" style="color:#40403E;float:right;font-size:23px "></i>
                                                </p>
                                              <input type="hidden" name="customer_phone" value="{{$customers->customer_phone}}" placeholder="Nhập số điện thoại"/>                                            
                                            </div>	
                                            						
                                            <button type="submit" class="btn btn-default">Lưu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    @include('partials.footer')
    @include('partials.script')
    <script type="text/javascript">
        $('.icon-right').click(function() {
            var getInput = $(this).parent().parent().find('input');
            getInput.attr('type', 'text');   
        });
    </script>
</body>


