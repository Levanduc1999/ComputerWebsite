<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderProduct;
use App\Product;
use PDF;

class AdminOrderController extends Controller
{
    public function pdf($order_id){
        // return view('pdf.pdf');
        // dd($order_id);
        $orderInformations  = Order::join('customers', 'customers.customer_id','=','orders.customer_id')
                            ->join('shippings','shippings.shipping_id','=','orders.shipping_id')            
                            ->where('orders.id', $order_id)->get();
       
        $orderInformationsProducts  = OrderProduct::join('orders', 'orders.id','=','order_products.order_id')
                                    ->join('products','products.product_id','=','order_products.product_id')
                                    ->where('order_products.order_id', $order_id)->get();
    	$pdf = PDF::loadView('pdf.pdf', compact('orderInformationsProducts','orderInformations'),);
    	return $pdf->stream();
    }

    public function index() {
        $orderProducts = Order::join('customers', 'customers.customer_id','=','orders.customer_id')->paginate(10);
      
        return view('admin.order.index', compact('orderProducts'));
    }

    public function show ($orderShowId) {
        
        
        $orderInformations  = Order::join('customers', 'customers.customer_id','=','orders.customer_id')
                            ->join('shippings','shippings.shipping_id','=','orders.shipping_id')            
                            ->where('orders.id', $orderShowId)->get();
       
        $orderInformationsProducts  = OrderProduct::join('orders', 'orders.id','=','order_products.order_id')
                                    ->join('products','products.product_id','=','order_products.product_id')
                                    ->where('order_products.order_id', $orderShowId)->paginate(5);
        // dd($orderInformationsProducts);
        // $orderInformationsProducts = Product::join('order_products', 'order_products.product_id','=','products.product_id')
        //                     ->where('product_id' , $orderInformations->product_id)->get(); 
                            
        return view('admin.order.show', compact('orderInformations','orderInformationsProducts'));
    }

    public function searchOrder(Request $request){
        $orderProducts = Order::join('customers', 'customers.customer_id','=','orders.customer_id')
                    ->where('customer_name','like', '%'. $request->search. '%')->orwhere('id', $request->search)->paginate(10);
        return view('admin.order.index', compact('orderProducts'));
    }

    public function destroy($id){
   
        try {
            $orders = Order::find($id);
            $orders->delete();
            return redirect('/admin-order')->with('status','Xóa đơn hàng thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa đơn hàng thất bại');
        }
    }
}
