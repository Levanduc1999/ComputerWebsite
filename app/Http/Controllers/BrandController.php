<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('admin.brand.create');
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
            'brandName',
            'brandDescripsion',
            'brandStatus'
        ]);
        
        try {
            //code...
            $brands = Brand::create([
                'brand_name'=>  $inputData['brandName'] ,
                'brand_des'=>  $inputData['brandDescripsion'],
                'brand_status'=> $inputData['brandStatus'],
            ]);
            return redirect('/brand/create')->with('status','Thêm thương hiệu thành công');
        } catch (\Throwable $th) {
            return back()->with('status', 'Thêm thương hiệu không thành công');
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
        $brands = Brand::where("brand_id", $id)->get();
        
        return view('admin.brand.edit', compact('brands'));
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
            'brandName',
            'brandDescripsion',
            'brandStatus'
        ]);

        $Brands = Brand::where("brand_id", $id);

        try {
            //code...
            $Brands ->update([
                'brand_name'=>  $inputData['brandName'] ,
                'brand_des'=>  $inputData['brandDescripsion'],
                'brand_status'=> $inputData['brandStatus'],
            ]);
            return redirect('/brand/'. $id . '/edit')->with('status','Chỉnh sửa thương hiệu thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa thương hiệu thất bại');
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
        $brand = Brand::where("brand_id",$id);

        try {
            //code...
            $brand ->delete();
            return redirect('/brand')->with('status','Xóa thương hiệu thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa thương hiệu thất bại');
        }
        
    }

    public function searchBrand(Request $request){
        $brands = Brand::where('brand_name', 'like' ,'%'.$request->search.'%')
                        ->orwhere('brand_id', $request->search)->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }
}
