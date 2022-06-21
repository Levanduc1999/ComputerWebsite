@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')
<section id="cart_items">
		<form action="/paymentatm" method="POST" >  
                    {{csrf_field()}}                       
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Trang trủ</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->


			<div class="register-req">
				<p>Điền đầy đủ thông tin trước khi thanh toán</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Thông tin vận chuyển</p>
							<div class="form-one" style="width:100%">					
									<input type="text" name="shipping_name" placeholder="Họ tên">
									<input type="email" name="shipping_email" placeholder="Email*">
									<input type="text" name="shipping_adr" placeholder="Địa chỉ- số nhà">
									<input type="number" name="shipping_phone" placeholder="Số điện thoại">
									<textarea name="shipping_note"placeholder="Ghi chu" rows="10"></textarea>							
							</div>
						</div>
					</div>
					<div class="col-sm-4">
                        <div class="bill-to login-form">
                            <div class="form-one" style="width:100%;padding: 12px 0px">
                                    
                                        <div class="form-group" style="">
                                            <label>Tỉnh-Thành phố</label>
                                            <select id="city" name="city" class="form-control input-lg m-bot15 chose">
                                                <option value="" >--- Chọn Tỉnh-Thành phố ---</option>
                                                @foreach($citys as $city)
                                                <option value="{{$city->id_city}}" >{{$city->name_city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Quận-huyện</label>
                                            <select id="province" name="province" class="form-control input-lg m-bot15 chose">
                                                <option value="" >--- Chọn Quận-huyện ---</option>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Xã-Phường</label>
                                            <select id="ward" name="ward" class="form-control input-lg m-bot15 ">
                                                <option value="" >--- Chọn Xã-Phường ---</option>                                     
                                            </select>
                                        </div>
                                        <button type="button" class="btn btn-info charge-fee">Tính phí vận chuyển</button>
                                    
                            </div>
						</div>  
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Xem lại & Thanh toán</h2>
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
                                    <td class="cart_description">
                                        <h4><a href="">{{$productOrder->product_name}}</a></h4>
                                        <p>ID :{{$productOrder->product_id}}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{$productOrder->product_price}} <span>VNĐ</span></p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <!-- <a class="qtybtn  cart_quantity_up" href=""> + </a> -->
                                            <input class="cart_quantity_input" type="text" value="{{ $productOrder->product_order_quantity }}" name="quantity"  size="2">
                                            <!-- <a class="qtybtn  cart_quantity_down" href=""> - </a> -->
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">{{$productOrder->product_price * $productOrder->product_order_quantity}} <span>VNĐ</span></p>
                                    </td>
                                    <!-- <td class="cart_delete">
                                        <a class="cart_quantity_delete" data-product_order_id="{{ $productOrder->id }}" href=""><i class="fa fa-times"></i></a>
                                    </td> -->
                                </tr>
						@endforeach
					   
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Tổng tiền giỏ hàng</td>
										<td class="total-price">$59</td>
									</tr>
									<tr>
                                        <td>Mã giảm giá</td>
                                        @if(Session::get('coupons')!=null)
                                            <td>{{Session::get('coupons')->coupon_number}}</td>
                                        @endif
                                        <td>0 VNĐ</td>
                                    </tr>
									<tr>
										<td>Phí vận chuyển</td>
										<td class="shipping-cost">0 VNĐ</td>										
									</tr>
                                    
                                    @if(Session::get('coupons')!=null)
                                        @if(Session::get('coupons')->coupon_codition==0)   
                                        <?php
                                            $ordertotal =round(($order->order_total)/100*(Session::get('coupons')->coupon_number)); 
                                                                
                                        ?>           
                                        <tr>
                                            <td>Total</td>
                                             <td>
                                                <span class="ordertotalload">
                                                    <span class="ordertotal" >{{($order->order_total)-$ordertotal+Session::get('feeShip')}}</span><span>vnđ</span>
                                                    <input type="text" name="ordertotal" value="{{($order->order_total)-$ordertotal+Session::get('feeShip')}}" style="display:none">
                                                </span>
                                            </td>
                                        </tr>
                                        <?php
                                           
                                            Session::forget('feeShip');
                                        ?>
                                        @elseif(Session::get('coupons')->coupon_codition==1)
                                        <?php
                                            $ordertotal =round(($order->order_total)-(Session::get('coupons')->coupon_number));
                                        ?>           
                                        <tr>
                                            <td>Total</td>
                                            <td>
                                                <span class="ordertotalload">
                                                    <span class="ordertotal" >{{($order->order_total)-$ordertotal+Session::get('feeShip')}}</span><span>vnđ</span>
                                                    <input type="text" name="ordertotal" value="{{($order->order_total)-$ordertotal+Session::get('feeShip')}}" style="display:none">
                                                </span>
                                            </td>
                                        </tr>
                                         <?php
                                           
                                            Session::forget('feeShip');
                                        ?>
                                        @endif
                                    @else
                                        <tr >
                                            <td>Total</td>
                                            <td>
                                                <span class="ordertotalload">
                                                    <span class="ordertotal">{{$order->order_total+Session::get('feeShip')}}</span><span>vnđ</span>
                                                    <input type="text" name="ordertotal" value="{{$order->order_total+Session::get('feeShip')}}" style="display:none">
                                                </span>
                                            </td>
                                        </tr>  
                                         <?php
                                            Session::forget('feeShip');
                                        ?>                                      
                                    @endif 
                                                             
								</table>
							</td>
						</tr>
                    @endif
					</tbody>
				</table>
			</div>
			<div class="payment-options">				     
                    <button style="background:#FE980F; border:none; color:white; padding:5px 12px" class="btn btn-default" type="submid" name="redirect">Thanh toán ATM</button>
					<a class="btn btn-default check_out" style="margin: 0px; border-radius: 4px" href="">Thanh toán trực tiếp</a>                
			</div>
		</form>
	</section> <!--/#cart_items-->
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
            
            
            $('.charge-fee').click(function(event) {
                var idCity = $('#city').val();
                var _token = $('input[name="_token"]').val();
                var idProvince = $('#province').val();
                var idWard = $('#ward').val();
                var shippingCost = $('.shipping-cost');
                // var orderTotal = $('');
                $.ajax({
                    url: '/chargefee',
                    method: 'POST',
                    data:{
                        idCity: idCity,
                        _token:_token,
                        idProvince: idProvince,
                        idWard : idWard
                    }, 
                    success:function(feeShip){
                        $('.ordertotalload').load(' .ordertotalload');
                        shippingCost.text(feeShip + ' ' + 'vnđ' );    
                        alert('Đã tính phí vận chuyển');                   
                    }           
                });
            });
            // $('.cart_quantity_delete').click(function(event) {
            //     event.preventDefault();

            //     var productElement = $(this).parent().parent().parent();

            //     var productOrderId = $(this).data('product_order_id');
            //     alert(location);
            //     var url = '/order/' + productOrderId;
                
            //     $.ajax(url, {
            //         type: 'DELETE',
            //         success: function (result) {
            //             var resultObj = JSON.parse(result);

            //             if (resultObj.status) {
            //                 alert(resultObj.msg);
            //                 productElement.remove();
            //             } else {
            //                 alert(resultObj.msg);
            //                 location.reload();
            //             }
            //         },
            //         error: function () {
            //             alert('Something went wrong!');
            //         }
            //     });
            // });

            // $('.qtybtn').addClass('update-quantity');

            // $('.update-quantity').click(function(event) {
            //     event.preventDefault();
                
            //     var quantity = parseInt($(this).parent().find('input').val());
                
            //     if ($(this).hasClass('cart_quantity_up')) {
            //         quantity++;
                   
            //     } else {
            //         if (quantity <= 1) {
                        
            //             alert('The quantity has been great than 0');
            //             return false;
            //         }

            //         quantity--;

            //         if (quantity <= 1) {
                       
            //         }
            //     }
            //     var totalProductPrice = $(this).closest('tr').find('.cart_total_price');
                  
            //     var productOrderId = $(this).closest('tr').find('.cart_quantity_delete').data('product_order_id');
               
            //     var quantityNew = $(this).parent().find('input');
               
            //     $.ajax({
            //         url: '/order/' + productOrderId,
            //         method: 'PUT',
            //         data:{
            //             quantity: quantity
            //         },
            //         success:function(result){
            //             var resultObj = JSON.parse(result);

            //             if (!resultObj.status) {
            //                 alert(resultObj.msg);
            //                 location.reload();
            //             }
                      
            //             totalProductPrice.text('$' + resultObj.price);
                        
                       
            //             parseInt(quantityNew.val(quantity));
            //             calculatePrice();
            //         }
            //     });
                
            // });
        calculatePrice();
        function calculatePrice()
        {
            var totalPrice = 0;

            $('.cart_total_price').each(function() {
                var price = parseInt($(this).text().replace('$', ''));
                totalPrice += price;
            });

            $('.total-price').text(totalPrice +" vnd");
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
        });
        $('.chose').on('change', function() {
                var nameSelect = $(this).attr('id');
                var _token = $('input[name="_token"]').val();
                var idOption = $(this).val();
                var resuft ='';
                if (nameSelect == 'city'){
                    resuft ='province';
                }else {
                    resuft= 'ward';
                }                
                $.ajax({
                    url: '/ajaxfee-cart',
                    method: 'POST',
                    data:{
                        nameSelect: nameSelect,
                        _token:_token,
                        idOption: idOption
                    },
                    success:function(setOpiton){
                        $('#' + resuft).html(setOpiton);
                    }
                });
        });        
		$('.check_out').click(function(event) {
			
			var payment= $("input:checked").val();
			var shippingName= $("input[name=shipping_name]").val();
			var shippingEmail =$("input[name=shipping_email]").val();
			var shippingAdress= $("input[name=shipping_adr]").val();
			var shippingPhone =$("input[name=shipping_phone]").val();
			var shippingNote= $("textarea[name=shipping_note]").val();
            var ordertotal = $('.ordertotal').text();
			$.ajax({
                    url: '/payment',
                    method: 'GET',
                    data:{
                        payment: payment,
						shippingName: shippingName,
						shippingEmail:shippingEmail,
						shippingAdress: shippingAdress,
						shippingPhone: shippingPhone,
						shippingNote : shippingNote,
                        ordertotal : ordertotal
                    },
					success:function(){
                        alert('Đã đặ hàng thành công vui lòng kiểm tra thêm trong phần tài khoản');
                    }
            });          
		});
    </script>
@endsection