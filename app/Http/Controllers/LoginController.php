<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\CategoryProduct;
use App\Customer;
use App\Topic;
use App\CategoryChildren;
use Mail;
use Session;
use Carbon\Carbon;
use Str;

class LoginController extends Controller
{
    public function loginCheckout (){
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        $categoryChildrens = CategoryChildren::all();
        $categorys= CategoryProduct::where("category_status", 1)->get();
        $brands =  Brand::orderby('brand_id','desc')->get();
        $categoryProducts = CategoryProduct::orderby('category_id','desc')->get();
        return view('login', compact('brands', 'categoryProducts' ,'categorys','categoryChildrens','topics'));
    }

    public function registerCheckout (Request $request){
        $inputData = $request->only([
            'register_name',
            'register_email',      
            'register_phone',
        ]);
        $inputData['register_password']= md5($request->register_password);

        $register = Customer::create([
                'customer_name'=>  $inputData['register_name'] ,
                'customer_email'=>  $inputData['register_email'],
                'customer_password'=> $inputData['register_password'],
                'customer_phone'=> $inputData['register_phone'],
        ]);
        return view('login');
    }

    public function login(Request $request) {
        $inputData= [];
        $inputData['login_password']= md5($request->login_password);
        $inputData['login_email']= $request->login_email;
 
        $loginCunstomer = Customer::where('customer_password', $inputData['login_password'])
                            ->where('customer_email', $inputData['login_email'])->first();
                                              
        Session::put('customerId', $loginCunstomer->customer_id);
        return redirect('/');
    }
    public function forgetpass(){
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        return view('forgetpass.checkaccount',  compact('topics'));
    }
    public function checkAccountForget(Request $request){
        $customers = Customer::where("customer_email", $request->forgetEmail)->first();
       
        $dateTimeNow= Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-y');
        if($customers != null){
            $token = Str::random(30);
            $customers->update([
                'token'=> $token
            ]);
            \Log::info($token);
            
            
            $url = url('/update-new-pass-customer/?email=' . $request->forgetEmail .'&token=' . $token);
            $data =[
                'title_email'=> "Lấy Lại mật khẩu",
                'url' => $url,
                'email' => $request->forgetEmail ,
            ];
            Mail::send('forgetpass.sendmail',['data'=>$data], function($message) use ($data){
                $message->to($data['email'])->subject($data['title_email']);
            });
            return redirect()->back()->with('sucsess', 'Gửi gmail thành công');
        }else {
            return redirect()->back()->with('sucsesser', 'Tên Gmail không chính xác');
        }     
    }
   
    public function updatePass(){
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();
        return view('forgetpass.updatepass',compact('topics'));
    }

    public function newPass(Request $request) {
        $inputData = $request->only([
            'password',
            'email',
            'retypePass',
            'token'
        ]);
        $topics= Topic::orderby('topic_id', 'desc')->take(4)->get();

        $customers = Customer::where('customer_email', $inputData['email'])
                    ->where('token', $inputData['token'])->first();
        if($customers != null) {
            \Log::info($customers);
            \Log::info($inputData );
            // $token = Str::random(30);
            if($inputData['password']==$inputData['retypePass']){
                 \Log::info('oki');
                $customers->update([
                    // 'token' => $token,
                    'customer_password' => md5($inputData['password']),
                ]);
                \Log::info($customers);
                return redirect()->back()->with('sucsess', 'Đổi mật khẩu thành công', compact('topics'));
            }
            else{
                return redirect()->back()->with('sucsesser', 'Mật khẩu không trùng khớp');
            }
        }
       
        
    }
}
