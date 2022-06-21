@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thông tin vận chuyển
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Tên người nhận</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($orderInformations as $orderInformation)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$orderInformation->shipping_name}}</td>
                                <td>{{$orderInformation->shipping_email}}</td>
                               
                                <td>{{$orderInformation->shipping_phone}}</td>
                                <td>{{$orderInformation->shipping_adress}}</td>
                                <td>
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <footer class="panel-footer">
                    <div class="row">
                       
                    </div>
                </footer>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thông tin khách hàng
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Điện thoại</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach($orderInformations as $orderInformation)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$orderInformation->customer_name}}</td>
                                <td>{{$orderInformation->customer_email}}</td>
                               
                                <td>{{$orderInformation->customer_phone}}</td>
                                
                                <td>
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <footer class="panel-footer">
                    <div class="row">
                       
                    </div>
                </footer>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Thông tin sản phẩm
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                        
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="button">Tìm</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderInformationsProducts as $orderInformationsProduct)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$orderInformationsProduct->product_name}}</td>
                                <td><img src="{{URL::to('upload/' . $orderInformationsProduct->product_image)}}" height="80px" with="120px" alt=""></td>
                                <td>{{number_format($orderInformationsProduct->product_price)}} vnđ</td>
                                <td>{{$orderInformationsProduct->product_order_quantity}}</td>
                                <td>{{number_format($orderInformationsProduct->product_order_quantity*$orderInformationsProduct->product_price)}} vnđ</td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            @foreach($orderInformations as $orderInformation)
                            <div>
                                <p><b>Tổng tiền(tất cả chi phí):</b> {{number_format($orderInformation->order_total)}} vnđ</p>                     
                            </div>
                            @endforeach
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                           {{$orderInformationsProducts->links()}}
                        </div>
                    </div>
                </footer>
            </div>
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