<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons =Coupon::paginate(5);
        return view('admin.coupon.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData= $request->only([
            'couponName',
            'couponCode',
            'couponQuantity',
            'couponCodition',
            'couponNumber',
        ]);
        
        try {
            //code...
            $Coupons = Coupon::create([
                'coupon_name'=>  $inputData['couponName'] ,
                'coupon_code'=>  $inputData['couponCode'] ,
                'coupon_time'=>  $inputData['couponQuantity'] ,
                'coupon_number'=>  $inputData['couponNumber'],
                'coupon_codition'=> $inputData['couponCodition'],
            ]);
            return redirect('/coupon/create')->with('status','Thêm mã giảm giá thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Thêm mã giảm giá không thành công');
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
        $coupons = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupons'));
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
        $inputData= $request->only([
            'couponName',
            'couponCode',
            'couponQuantity',
            'couponCodition',
            'couponNumber',
        ]);

        $coupons = Coupon::find($id);
        try {
            $coupons->update([
                'coupon_name'=>  $inputData['couponName'] ,
                'coupon_code'=>  $inputData['couponCode'],
                'coupon_time'=> $inputData['couponQuantity'],
                'coupon_number'=> $inputData['couponNumber'],
                'coupon_codition'=> $inputData['couponCodition'],
                
            ]);
            return redirect('/coupon/'. $id. '/edit')->with('status','Cập nhật mã giảm giá thành công');
        } catch (\Throwable $th) {
             return back()->with('statuser', 'Sửa mã giảm giá thất bại');
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $coupons =Coupon::find($id);
            $coupon->delete();
            return redirect('/coupon')->with('status','Xóa mã giảm giá thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa mã giảm giá thất bại');
        }
    }

    public function searchCoupon(Request $request){
        $coupons =Coupon::where('coupon_name','like', '%'.$request->search.'%')
                    ->orwhere('coupon_id', $request->search)->paginate(5);
        return view('admin.coupon.index',compact('coupons'));
    }
}
