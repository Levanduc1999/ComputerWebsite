<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\CategoryChildren;
use App\CategoryProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =Product::join('brands', 'brands.brand_id','=','products.brand_id')
                            ->join('category_childrens', 'category_childrens.category_childrens_id','=','products.category_childrens_id')
                            ->paginate(5);
        return view('admin.product.index',compact('products'));
    }
        
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $brands =  Brand::orderby('brand_id','desc')->get();
        $categoryProducts = CategoryProduct::orderby('category_id','desc')->get();
        return view('admin.product.create', compact('brands','categoryProducts'));
    }

    public function ajaxLoadCategory(Request $request) {
        $productChildrens = CategoryChildren::where('category_id', $request->idOption)->get();
        \Log::info($productChildrens);
        if($productChildrens){
                $setOpiton='';
                foreach($productChildrens as $productChildren){
                    $setOpiton .= '<option value="' .$productChildren->category_childrens_id .'">'.$productChildren->category_childrens_name.'</option>';
                }                      
        }
        echo $setOpiton;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getImage= $request->file('productImage');
        if($getImage){
            $nameImage= $getImage->getClientOriginalName();
            $newNameImage= time() . $nameImage;
            $getImage->move('upload', $newNameImage);
        } else {
            $newNameImage='';
        }
 
        $inputData= $request->only([
            'productName',
            'productPrice',
            'productDescripsion',
            'productContent',
            'categoryChil',
            'brand',
            'productStatus',
        ]);
        
        try {
            //code...
            $products = Product::create([
                'product_name'=>  $inputData['productName'] ,
                'category_childrens_id'=>  $inputData['categoryChil'],
                'brand_id'=> $inputData['brand'],
                'product_des'=> $inputData['productDescripsion'],
                'product_content'=> $inputData['productContent'],
                'product_price'=> $inputData['productPrice'],
                'product_image'=> $newNameImage,
                'product_status'=> $inputData['productStatus'],
            ]);
            return redirect('/product/create')->with('status','Thêm sản phẩm thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Thêm sản phẩm thất bại');
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
        $brands =  Brand::orderby('brand_id','desc')->get();
        $categoryProducts = CategoryProduct::orderby('category_id','desc')->get();

        $products =Product::join('brands', 'brands.brand_id','=','products.brand_id')
                            ->join('category_childrens', 'category_childrens.category_childrens_id','=','products.category_childrens_id')
                            ->where('product_id', $id)
                            ->get();
        return view('admin.product.edit', compact('products','brands','categoryProducts'));
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
        $products = Product::where('product_id', $id)->first();
        $newNameImage = $products->product_image;
        $getImage= $request->file('productImage');
        if($getImage){
            $nameImage= $getImage->getClientOriginalName();
            $newNameImage= time() . $nameImage;
            $getImage->move('upload', $newNameImage);
        }

        $inputData= $request->only([
            'productName',
            'productPrice',
            'productDescripsion',
            'productContent',
            'categoryChil',
            'brand',
            'productStatus',
        ]);
        \Log::info($products);
        try {
            $products->update([
                'product_name'=>  $inputData['productName'] ,
                'category_childrens_id'=>  $inputData['categoryChil'],
                'brand_id'=> $inputData['brand'],
                'product_des'=> $inputData['productDescripsion'],
                'product_content'=> $inputData['productContent'],
                'product_price'=> $inputData['productPrice'],
                'product_image'=> $newNameImage,
                'product_status'=> $inputData['productStatus'],
            ]);
            return redirect('/product/'. $id. '/edit')->with('status','Cập nhật sản phẩm thành công');
        } catch (\Throwable $th) {
             return back()->with('statuser', 'Sửa sản phẩm thất bại');
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
        $products = Product::where("product_id",$id);

        try {
            //code...
            $products ->delete();
            return redirect('/product')->with('status','Xóa sản phẩm thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa sản phẩm thất bại');
        }
    }

    public function searchProduct(Request $request){
        $products =Product::join('brands', 'brands.brand_id','=','products.brand_id')
                            ->join('category_childrens', 'category_childrens.category_childrens_id','=','products.category_childrens_id')
                            ->where('product_name','like' , '%'.$request->search.'%')->orwhere('product_id', $request->search)->paginate(5);
        return view('admin.product.index',compact('products'));
    }
}
