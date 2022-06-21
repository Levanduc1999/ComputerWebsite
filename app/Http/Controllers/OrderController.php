<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Order;
use App\OrderProduct;
use App\Payment;
use App\Shipping;
use App\CategoryProduct;
use App\CategoryChildren;
use App\Coupon;
use App\City;
use App\Province;
use App\Ward;
use App\Topic;
use App\FeeShip;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::all();
        $customerId= Session::get('customerId');
        $order = Order::where('customer_id', $customerId)
                        ->where('order_status', 1)
                        ->first();       
        $productOrders = null ;
        if ($order) {
            
            $productOrders = OrderProduct::where('order_id', $order->id)
            ->join('products', 'products.product_id','=','order_products.product_id')->get();
        }
        
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands =  Brand::orderby('brand_id','desc')->get();
        return view('order.cart', compact('brands' ,'categorys','productOrders','categoryChildrens','topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData = $request->only([
            'productId' ,
            'productOrderQuantity'
        ]);
        $productId = $inputData['productId'];
        
        $product = Product::where('product_id', $productId)->first();
        \Log::info($product);
        
        $customerId= Session::get('customerId');
        
        $order = Order::where('customer_id', $customerId)->where('order_status', 1)->first();
        \Log::info($order);
        if(!$order) {
            \Log::info('oki'); 
            try {           
                $order = Order::create([
                    'customer_id' => $customerId,
                    'order_status' => 1,
                ]);
                $productOrder =OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' =>$product->product_name ,
                    'product_price' => $product->product_price,
                    'product_order_quantity' => 0,
                ]);
               
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
        \Log::info($productId);
        \Log::info($order->id);
        $productOrders = OrderProduct::where('product_id', $productId)
                        ->where('order_id',$order->id )
                        ->first();
        \Log::info($productOrders);
        if(!$productOrders) {
                
                $productOrders =OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' =>$product->product_name ,
                    'product_price' => $product->product_price,
                    'product_order_quantity' => $inputData['productOrderQuantity'],
                ]);
        }else {         
                $quantity = $productOrders->product_order_quantity +  $inputData['productOrderQuantity'];              
                $productOrders->update([
                    'product_order_quantity' => $quantity,
                ]);
        }
                    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $quantity = $request->quantity;
        $productOrder = OrderProduct::find($id);
        try {
            $productOrder->product_order_quantity = $quantity;
            $productOrder->save();

            
            $result =[
                'status' => true,
                'msg' => 'Update Success!',
                'price' => $productOrder->product_price * $quantity,

            ];
        } catch (\Throwable $th) {
          
            $result = [
                'status' => false,
                'msg' => 'Something wrent wrong!',
            ];
        }

        return json_encode($result);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productOrderId)
    {
        $productOrder = OrderProduct::find($productOrderId);
        
        try {
            $productOrder->delete();

            $result =[
                'status' => true,
                'msg' => 'Delete Success!',
            ];
        } catch (\Throwable $th) {
           

            $result = [
                'status' => false,
                'msg' => 'Delete Failed!',
            ];
        }

        return json_encode($result);
    }

    public function orderTotal(Request $request) {
        $customerId= Session::get('customerId');
      
        $order = Order::where('customer_id', $customerId)
                        ->where('order_status', 1)
                        ->first();
        $totalPrice = $request->totalPrice;
        
        $order->order_total = $totalPrice;
        $order->save();
    }
    public function orderCoupon(Request $request) {
        $coupon = $request->coupon;
        
        $coupons = null;
        if($coupon) {
            $coupons = Coupon::where('coupon_code', $coupon)->first();            
        }
        \Log::info('oki');
        \Log::info($coupons);
        Session::put('coupons', $coupons);
        \Log::info(Session::get('coupons', $coupons));
    }
    public function orderCheckout() {
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
         $categoryChildrens = CategoryChildren::all();
        $customerId= Session::get('customerId');
        $order = null;
        $order = Order::where('customer_id', $customerId)
                        ->where('order_status', 1)
                        ->first();
        $citys = City::all();
        $productOrders = null;
        if ($order) {
            $productOrders = OrderProduct::where('order_id', $order->id)
            ->join('products', 'products.product_id','=','order_products.product_id')->get();
        }
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands =  Brand::orderby('brand_id','desc')->get();
        return view('order.checkout', compact('categorys','brands', 'productOrders','order','citys','categoryChildrens','topics'));
    }
    public function paymentAtm(Request $request){
        $data =$request->only([
            'shipping_name',
            'shipping_email',
            'shipping_adr',
            'shipping_phone',
            'shipping_note',
            'ordertotal'
        ]);
        \Log::info($data);
            $shippings = Shipping::create([
                    'shipping_name' => $data['shipping_name'],
                    'shipping_adress' => $data['shipping_email'],
                    'shipping_email' =>$data['shipping_adr'] ,
                    'shipping_phone' =>$data['shipping_phone'],
                    'shipping_note' => $data['shipping_note'],
            ]);
          
            $payments = Payment::create([
                    'payment_method' => 2,
                    'payment_status' => 0,
            ]);
           
            $customerId= Session::get('customerId');
            
            $order = Order::where('customer_id', $customerId)
                            ->where('order_status', 1)
                            ->first();
            $order->shipping_id =  $shippings->id;
            $order->payment_id = $payments->id;
            $order->order_status= 2;
            $order->order_total =$data['ordertotal'];
            $order->save();
      
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/ordercheckout";
        $vnp_TmnCode = "2NHRSR20";//Mã website tại VNPAY 
        $vnp_HashSecret = "LWAVSTIIPARTUGSYETOGCBDHMQNPDRIJ"; //Chuỗi bí mật

        $vnp_TxnRef =1103; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toán';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 20000 * 100 ;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
      
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
	// vui lòng tham khảo thêm tại code demo
    }
    public function payment(Request $request) {
        
        $inputData =$request->only([
            'shippingName',
            'shippingEmail',
            'shippingAdress',
            'shippingPhone',
            'shippingNote',
            'ordertotal'
        ]);
        \Log::info($inputData);
        
            $shippings = Shipping::create([
                    'shipping_name' => $inputData['shippingName'],
                    'shipping_adress' => $inputData['shippingAdress'],
                    'shipping_email' =>$inputData['shippingEmail'] ,
                    'shipping_phone' =>$inputData['shippingPhone'],
                    'shipping_note' => $inputData['shippingNote'],
            ]);
          
            $payments = Payment::create([
                    'payment_method' => 1,
                    'payment_status' => 0,
            ]);
           
            $customerId= Session::get('customerId');
            
            $order = Order::where('customer_id', $customerId)
                            ->where('order_status', 1)
                            ->first();
            $order->shipping_id =  $shippings->id;
            $order->payment_id = $payments->id;
            $order->order_status= 2;
            $order->order_total =$inputData['ordertotal'];
            $order->save();
      
       
    }

    public function ajaxFee(Request $request) {
        $selectData = $request->all();   
        if($selectData['nameSelect']){
            $setOpiton='';
            if($selectData['nameSelect']=='city'){
                $selectDataProvinces = Province::where('id_city', $selectData['idOption'])->orderby('id_province','ASC')->get();
               
                $setOpiton ='<option value="" >--- Chọn Quận-Huyện ---</option>';
                foreach($selectDataProvinces as $selectDataProvince){
                    $setOpiton .= '<option value="' .$selectDataProvince->id_province .'">'.$selectDataProvince->name_province.'</option>';
                }
              
            }else {
                $selectDataWards = Ward::where('id_province', $selectData['idOption'])->orderby('id_ward','ASC')->get();
                $setOpiton ='<option value="" >--- Chọn Xã-Phường ---</option>';
                foreach($selectDataWards as $selectDataWard){
                    $setOpiton .= '<option value="' .$selectDataWard->id_ward .'">'.$selectDataWard->name_ward.'</option>';
                }
            }
        };
        echo $setOpiton;
    }
    
    public function chargeFee(Request $request) {
        $feeData = $request->all();
        \Log::info($feeData);
        $fee = FeeShip::where('fee_cityid',$feeData['idCity'])->where('fee_provinceid',$feeData['idProvince'])
                        ->where('fee_wardid', $feeData['idWard'])->first();
        
        if($fee)
        {
            $feeShip= $fee->fee_ship;
            Session::put('feeShip', $feeShip);
        }else {
            $feeShip= 20000;
            Session::put('feeShip', $feeShip);
        }
        return $feeShip;
    }
}
