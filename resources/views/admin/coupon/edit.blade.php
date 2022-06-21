@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="form-w3layouts">
            <!-- page start-->
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa mã giảm giá
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
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
                                <form id="couponEdit"role="form" action="/coupon/{{$coupons->coupon_id}}" method="Post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên mã giảm giá</label>
                                        <input type="text" class="form-control" value="{{$coupons->coupon_name}}" name="couponName" id="couponName">
                                    </div>
                                    <div class="form-group">
                                        <label>Mã giảm giá</label>
                                        <input type="text" class="form-control" value="{{$coupons->coupon_code}}" name="couponCode" id="couponCode">
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng mã</label>
                                        <input type="number" min="1" value="{{$coupons->coupon_time}}" class="form-control" name="couponQuantity" id="couponQuantity">                                  
                                    </div>
                                    <div class="form-group">
                                        <label>Điều kiện mã</label>
                                        <select name="couponCodition" class="form-control input-lg m-bot15">
                                            @if($coupons->coupon_codition==0)
                                                <option selected value="0">Giảm phần trăm</option>
                                                <option value="1">Giảm tiền</option>
                                            @else
                                                <option selected value="1">Giảm tiền</option>
                                                <option value="0">Giảm phần trăm</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nhập số tiền giảm hoặc % giảm</label>
                                        <input type="text" value="{{$coupons->coupon_number}}" class="form-control" name="couponNumber" id="couponNumber">                                    
                                    </div>
                                   
                                    <button type="submit" class="btn btn-info">Sửa mã giảm giá</button>
                                </form>
                                
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
        </div>
    </section>
    <!-- footer -->
    <div class="footer">
        <div class="wthree-copyright">
            <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
        </div>
    </div>
    <!-- / footer -->
</section>
@endsection