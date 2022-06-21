@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách đơn hàng
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                       
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <form action="/search-order" method="post">
                            @csrf
                        <div class="input-group">
                            <input type="text" name="search" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="submit">Tìm</button>
                            </span>
                        </div>
                        </form>
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
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>                          
                            </tr>
                        </thead>
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
                        <tbody>
                            @foreach($orderProducts as $orderProduct)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$orderProduct->customer_name}}</td>
                                <td>{{number_format($orderProduct->order_total)}} <span>vnđ</span></td>
                                @if($orderProduct->order_status==1)
                                    <td>                   
                                       <a style="border: 1px solid; color: white; background: #5cb85c; padding: 6px; border-radius: 8px;display:block;width:120px;text-align: center;">Đơn hàng mới</a>
                                    </td>
                                @elseif($orderProduct->order_status==2)
                                    <td>
                                        <a style="border: 1px solid; color: white; background: #5cb85c; padding: 6px; border-radius: 8px;display:block;width:120px;text-align: center;">Đã đặt hàng</a>
                                    </td>
                                @elseif($orderProduct->order_status==3)
                                    <td>
                                        <a style="border: 1px solid; color: white; background: #5cb85c; padding: 6px; border-radius: 8px;display:block;width:120px;text-align: center;">Hoàn thành</a>
                                    </td>
                                @elseif($orderProduct->order_status==4)
                                    <td>
                                     <a style="border: 1px solid; color: white; background: red; padding: 6px; border-radius: 8px; display:block;width:120px; text-align: center;">Đơn đã hủy</a>        
                                    </td>
                                @endif
                                <td>    
                                    <div style="display: flex">
                                        <a href="/pdf/{{$orderProduct->id}}" style="border: 1px solid; color: white; background: #5cb85c; padding: 6px; border-radius: 8px;">In hóa đơn</a>
                                        <a href="{{route('ordershow.show',['orderShowId'=>$orderProduct->id])}}" style="border: 1px solid; color: white; background: #5cb85c; padding: 6px; border-radius: 8px;" class="active">Xem</a>
                                        <a href="{{route('order.destroy',['order'=>$orderProduct->id])}}" onclick="return confirm('Bạn chắc chắn muốn xóa đơn hàng này?')" style="border: 1px solid; color: white; background: red; padding: 6px; border-radius: 8px; ">Xóa</a>
                                    </div>
                                </td>             

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                               {{ $orderProducts->links() }}
                            </ul>
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