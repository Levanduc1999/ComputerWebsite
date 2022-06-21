<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Slider;
use App\Topic;
use App\Post;
use App\Order;
use App\OrderProduct;
use App\Customer;
use App\Rating;
use App\CategoryProduct;
use App\CategoryChildren;
use Session;
use Mail;

class HomeController extends Controller
{
    public function homeDetail($id){
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands= Brand::where("brand_status", 1)->get();  
        $productDetails=Product::join('brands', 'brands.brand_id','=','products.brand_id')
                            ->join('category_childrens', 'category_childrens.category_childrens_id','=','products.category_childrens_id')
                            ->where('products.product_id', $id)
                            ->get();  
        // Đánh giá sản phẩm một khách hàng
        $ratingsCustomer = null;
        $customerId = Session::get("customerId"); 
        if($customerId){
            $ratingsCustomer = Rating::where('product_id', $id)
                        ->where('customer_id', $customerId)->first();      
        }   
        // Đánh giá sao về sản phẩm 
        $fiveStar = Rating::where('product_id', $id)->where('rating_number', 5)
                        ->count();
        $fourStar = Rating::where('product_id', $id)->where('rating_number', 4)
                        ->count();  
        $downThreeStar = Rating::where('product_id', $id)->where('rating_number','<', 4)
                        ->count();    
        $avgStar = round(Rating::avg('rating_number'),1);
        
        foreach ( $productDetails as $productDetail){
            $categoryId = $productDetail->category_childrens_id;
        }
        $productRelates=Product::join('category_childrens', 'category_childrens.category_childrens_id','=','products.category_childrens_id')
                            ->join('brands', 'brands.brand_id','=','products.brand_id')
                            ->where('products.category_childrens_id', $categoryId)->whereNotIn('products.product_id',[$id])
                            ->get();     
                  
        return view('product.detail', compact('categorys','brands','productDetails','productRelates',
                                            'categoryChildrens','topics','ratingsCustomer',
                                            'downThreeStar','fiveStar','fourStar','avgStar' ));
    }

    public function homeBrand($id) {
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands= Brand::where("brand_status", 1)->get();  
        $homeBrands =Product::join('brands', 'brands.brand_id','=','products.brand_id')
                            ->where('products.brand_id', $id)
                            ->get();  
        return view('product.brand' ,compact('homeBrands','categorys','brands','categoryChildrens','topics'));
    }
    public function homeCategory($id) {
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands= Brand::where("brand_status", 1)->get();  
        $homeProductsCategorys =Product::join('category_childrens', 'category_childrens.category_childrens_id','=','products.category_childrens_id')
                            ->where('products.category_childrens_id', $id)
                            ->get();  
        return view('product.category' ,compact('homeProductsCategorys','categorys','brands','categoryChildrens','topics'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $categorys= CategoryProduct::where("category_status", 1)->get();      
        $brands= Brand::where("brand_status", 1)->get();  
        $products =Product::where('product_status', 1)->orderby('updated_at', 'desc')->paginate(6);
        $sliders = Slider::where('slider_staus', 1)->take(3)->get();
        Session::put('sliders',  $sliders);
        return view('homepage', compact('categorys','brands','products','categoryChildrens','topics'));
    }

    public function search(Request $request){
        $dataSearch = $request->dataSearch;
        \Log::info($dataSearch);
        $product = Product::where('product_name',  $dataSearch)->orWhere('product_id', $dataSearch)->get();
        return $product;
    }

    public function topic($id) {
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $posts = Post::where('topic_id', $id)->orderby('post_id','desc')->paginate(5);
        $categorys= CategoryProduct::where("category_status", 1)->get();      
        $brands= Brand::where("brand_status", 1)->get();
        return view('topic.list_post', compact('posts','topics','categorys','brands','categoryChildrens'));
    }

    public function showPost($id){
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $posts = Post::find($id);
        $categorys= CategoryProduct::where("category_status", 1)->get();      
        $brands= Brand::where("brand_status", 1)->get();
        return view('topic.show_post', compact('posts','topics','categorys','brands','categoryChildrens'));
    }

    public function account(){       
        $customerId =Session::get('customerId');
        $orderInformations  = Order::join('customers', 'customers.customer_id','=','orders.customer_id')
                            ->join('shippings','shippings.shipping_id','=','orders.shipping_id')  
                            ->join('payments','payments.payment_id','=','orders.payment_id')            
                            ->where('orders.customer_id', $customerId)->where('order_status','=',2)->get();
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $customers = Customer::where('customer_id', $customerId)->first();
        return view('account.index', compact('topics','orderInformations','customers'));
    }

    public function accountOrder($id){       
        $customerId =Session::get('customerId');        
        $orders = Order::find($id);    
        if($customerId==$orders->customer_id){
           
            try {
                $orders->update([
                    'order_status' => 4,
                ]);
                return redirect('/account')->with('status','Hủy đơn hàng thành công');
            } catch (\Throwable $th) {
                return back()->with('statuser', 'Hủy thất bại');
            }
        }
        
    }

    public function rating(Request $request) {
       
        $customerId = Session::get("customerId");        
        $dataRating = $request->all();
        $ratings = Rating::where('product_id',$dataRating['dataProductId'])
                            ->where('customer_id', $customerId)->first();
                             \Log::info($customerId);
        \Log::info($ratings);
        if($ratings==null){          
            $ratings = Rating::create([
                'product_id' => $dataRating['dataProductId'],
                'customer_id'=> $customerId,
                'rating_number' => $dataRating['starRating'],
            ]);
            return $data="Đánh giá sao hoàn thành";
        }else {          
            $ratings->update([
                'rating_number' => $dataRating['starRating']
            ]);
            return $data="Đánh giá sao hoàn thành";
        }    
    }
    
    public function updateAccount(Request $request){
        $inputData = $request->only([
            'customer_name',
            'customer_email',
            'customer_password',
            'customer_phone'
        ]);
        $customerId = Session::get("customerId"); 
        $customers = Customer::where('customer_id', $customerId)->first();
        try {
            if($inputData['customer_password']== null) {
                $customers->update([
                    "customer_name"=> $inputData['customer_name'],
                    "customer_email"=> $inputData['customer_email'],
                    "customer_phone"=> $inputData['customer_phone'],        
                ]);
                return redirect()->back()->with('sucsess', 'Đổi thông tin thành công');
            }else {
                $customers->update([
                    "customer_name"=> $inputData['customer_name'],
                    "customer_email"=> $inputData['customer_email'],
                    "customer_phone"=> $inputData['customer_phone'],
                    "customer_password"=> md5($inputData['customer_password']),
                ]);
                return redirect()->back()->with('sucsess', 'Đổi thông tin thành công');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('sucsesser', 'Đổi thông tin thất bại');
        }
    }
    
    public function homeProductNew(){
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands= Brand::where("brand_status", 1)->get();  
        $products = Product::orderby('product_id','desc')->paginate(6);
        return view('product.productnew' ,compact('categorys','brands','categoryChildrens',
                                            'topics', 'products'));
    }

    public function homeProductHot(){
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::where("category_childrens_status", 1)->get();
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands= Brand::where("brand_status", 1)->get();  
        $products= OrderProduct::join('products','products.product_id','=','order_products.product_id')->groupBy('product_id')->orderby('sum','desc')
                ->selectRaw('sum(product_order_quantity) as sum, order_products.product_id, products.product_image,products.product_price')
                ->get();
        return view('product.producthot' ,compact('categorys','brands','categoryChildrens',
                                            'topics', 'products'));
    }

    public function mailFeedback(Request $request) {
        $customerId = Session::get('customerId');
        $customersEmail = Customer::where("customer_id", $customerId)->pluck('customer_email')->first();
        \Log::info($mail);
        \Log::info($customersEmail);
        \Log::info($request->dataFeeback);
        if($customersEmail != null){
        
            $data =[
                'email' => $customersEmail,
                'feedback' =>$request->dataFeeback,
            ];
            Mail::send('product.feedbackmail',['data'=>$data], function($message) use ($data){
                $message->from($data['email']);
                $message->to('levanduc1999bn@gmail.com')->subject('Mail phản hồi sản phẩm');
            });
            $status = 'đã gửi mailFeedback';
            echo $status;
        }else {
            $status = 'không gửi được feedback ';
            echo $status;
        }     
    }
}
