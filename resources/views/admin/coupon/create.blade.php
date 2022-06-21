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
                            Thêm mã giảm giá
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
                                <form id ="couponCreate"role="form" action="/coupon" method="post"  enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên mã giảm giá</label>
                                        <input type="text" class="form-control" name="couponName" id="couponName">
                                    </div>
                                    <div class="form-group">
                                        <label>Mã giảm giá</label>
                                        <input type="text" class="form-control" name="couponCode" id="couponCode">
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng mã</label>
                                        <input type="number" min="1" class="form-control" name="couponQuantity" id="couponQuantity">                                  
                                    </div>
                                    <div class="form-group">
                                        <label>Điều kiện mã</label>
                                        <select name="couponCodition" class="form-control input-lg m-bot15">
                                            <option value="0" >Giảm phần trăm</option>
                                            <option value="1" >Giảm tiền</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nhập số tiền giảm hoặc % giảm</label>
                                        <input type="text" class="form-control" name="couponNumber" id="couponNumber">                                    
                                    </div>
                                   
                                    <button type="submit" class="btn btn-info">Thêm mã giảm giá</button>
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