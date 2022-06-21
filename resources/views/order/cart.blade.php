@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')

<section id="cart_items">
                   
                    <div class="breadcrumbs">
                        <ol class="breadcrumb">
                        <li><a href="#">Trang trủ</a></li>
                        <li class="active">Giỏ hàng</li>
                        </ol>
                    </div>
                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    <td class="image">Sản phẩm</td>
                                    <td class="description"></td>
                                    <td class="price">Giá</td>
                                    <td class="quantity">Số lượng</td>
                                    <td class="total">Thành tiền</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                            @if($productOrders != null)
                                @foreach($productOrders as $productOrder )
                                <tr>    
                                    <td class="cart_product">
                                        <a href=""><img  style="width: 60px; height:80px" src="{{URL::to('upload/' . $productOrder->product_image)}}" alt="" /></a>
                                    </td>         
                                    <td class="cart_description" >
                                        <h4><a href="">{{$productOrder->product_name}}</a></h4>
                                        <p>ID :{{$productOrder->product_id}}</p>                                     
                                    </td>
                                    <td class="cart_price">
                                        <p>{{$productOrder->product_price}} VNĐ</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="qtybtn  cart_quantity_up" href=""> + </a>
                                            <input class="cart_quantity_input" type="text" value="{{ $productOrder->product_order_quantity }}" name="quantity"  size="2">
                                            <a class="qtybtn  cart_quantity_down" href=""> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{$productOrder->product_price * $productOrder->product_order_quantity}} VNĐ</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete" data-product_order_id="{{ $productOrder->id }}" href=""><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                                 @endforeach
                            </tbody>
                            
                            @endif
                        </table>
                    </div>
               
</section>
<!--/#cart_items-->
	<section id="do_action">
		
			<div class="heading">
				<h3>Bước tiếp theo?</h3>
				<p>Nhập mã giảm giá nếu có để giảm chi phí</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li >Tổng đơn hàng <span class="total-price" >$59</span></li>
							
                            <label style="background: #E6E4DF;color: #696763;margin-top: 10px" for="">Mã giảm giá</label>
                            <input  class="form-control" type="text" name="coupon">
						</ul>
						<a class="btn btn-default check_out" href="/ordercheckout">Kiểm tra</a>
					</div>
				</div>
			</div>
		
</section><!--/#do_action-->

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#slider-carousel').hide();
            $('.col-sm-3').hide();
            $(".col-sm-9").attr('class', 'col-sm-12 padding-right load_search');
            
            $('.cart_quantity_delete').click(function(event) {
                event.preventDefault();

                var productElement = $(this).parent().parent().parent();

                var productOrderId = $(this).data('product_order_id');
                alert(location);
                var url = '/order/' + productOrderId;

                $.ajax(url, {
                    type: 'DELETE',
                    success: function (result) {
                        var resultObj = JSON.parse(result);

                        if (resultObj.status) {
                            alert(resultObj.msg);
                            productElement.remove();
                        } else {
                            alert(resultObj.msg);
                            location.reload();
                        }
                    },
                    error: function () {
                        alert('Something went wrong!');
                    }
                });
            });

            $('.qtybtn').addClass('update-quantity');

            $('.update-quantity').click(function(event) {
                event.preventDefault();
                
                var quantity = parseInt($(this).parent().find('input').val());
                
                if ($(this).hasClass('cart_quantity_up')) {
                    quantity++;
                   
                } else {
                    if (quantity <= 1) {
                        
                        alert('The quantity has been great than 0');
                        return false;
                    }

                    quantity--;

                    if (quantity <= 1) {
                       
                    }
                }
                var totalProductPrice = $(this).closest('tr').find('.cart_total_price');
                  
                var productOrderId = $(this).closest('tr').find('.cart_quantity_delete').data('product_order_id');
               
                var quantityNew = $(this).parent().find('input');
                alert(quantity);
                $.ajax({
                    url: '/order/' + productOrderId,
                    method: 'PUT',
                    data:{
                        quantity: quantity
                    },
                    success:function(result){
                        var resultObj = JSON.parse(result);

                        if (!resultObj.status) {
                            alert(resultObj.msg);
                            location.reload();
                        }
                      
                        totalProductPrice.text('$' + resultObj.price);
                        
                       
                        parseInt(quantityNew.val(quantity));
                        calculatePrice();
                    }
                });
                
            });
            calculatePrice();
            function calculatePrice()
            {
                var totalPrice = 0;

                $('.cart_total_price').each(function() {
                    var price = parseInt($(this).text().replace('$', ''));
                    totalPrice += price;
                });

                $('.total-price').text(totalPrice  + ' VNĐ'  );
                var total= 0;
                $('.cart_quantity_input').each(function() {
                    var quantity = parseInt($(this).val());
                    total += quantity;
                });
                $.ajax({
                        url: '/ordertotal',
                        method: 'GET',
                        data:{
                            totalPrice: totalPrice
                        },
                    });
            }

                   
            $('.check_out').click(function(event) {
                location.reload();
                var coupon= $("input[name=coupon]").val();
                $.ajax({
                        url: '/orderhascoupon',
                        method: 'GET',
                        data:{
                            coupon: coupon
                        },
                });
            });
        });
    </script>
@endsection