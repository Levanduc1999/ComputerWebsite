<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <link rel="stylesheet" href="Admins/css/bootstrap.min.css">
    
    <style>
        body {
            font-family: 'DejaVu Sans',
            
        }
    </style>
</head>
<body>
      <p style="text-align: center;">Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam<br>Động lập - Tự do - Hạnh phúc</p><br>
    @foreach($orderInformations as $orderInformation)
      <p>Tên tài khoản khách hàng:{{$orderInformation->customer_name}}</p>
      <p>Tên người nhận hàng: {{$orderInformation->shipping_name}}</p>
      <p> Email:{{$orderInformation->shipping_email}}</p>
      <p> Số điện thoại:{{$orderInformation->shipping_phone}}</p>
    @endforeach
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
        @foreach($orderInformationsProducts as $orderInformationsProduct)
          <tr>        
            <td>{{$orderInformationsProduct->product_name}}</td>
            <td>{{$orderInformationsProduct->product_order_quantity}}</td>
            <td>{{$orderInformationsProduct->product_price}}</td>
            <td>{{$orderInformationsProduct->product_price*$orderInformationsProduct->product_order_quantity}}</td>    
          </tr>    
          @endforeach   
        </tbody>
      </table>
    </div>
    @foreach($orderInformations as $orderInformation)
    <p>Tổng tiền(tất cả chi phí): {{number_format($orderInformation->order_total)}} vnđ</p>
     @endforeach
</body>
</html>