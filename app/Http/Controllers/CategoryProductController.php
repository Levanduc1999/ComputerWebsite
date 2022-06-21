<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryProduct;
use App\CategoryChildren;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categoryProducts = CategoryProduct::paginate(5);
        return view('admin.category.index', compact('categoryProducts'));
    }

    public function indexChildren()
    {     
        $categoryProducts = CategoryProduct::get();
        $categoryChildrens = CategoryChildren::paginate(5);
        return view('admin.category.children.index', compact('categoryChildrens','categoryProducts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    public function createChildren(){
        $categoryProducts = CategoryProduct::all();
        return view('admin.category.children.create', compact('categoryProducts'));
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
            'categoryName',
            'categoryDescripsion',
            'categoryStatus'
        ]);
        
        try {
            //code...
            $categoryProduct = CategoryProduct::create([
                'category_name'=>  $inputData['categoryName'] ,
                'category_des'=>  $inputData['categoryDescripsion'],
                'category_status'=> $inputData['categoryStatus'],
            ]);
            return redirect('/categorychildren/create')->with('status','Thêm danh mục thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Thêm không thành công');
        }   
    }
    public function storeChildren(Request $request){
     
        $inputData= $request->only([
            'categoryChildrenName',
            'categoryChildrenDescripsion',
            'categoryChildrenStatus',
            'categotyParent'
        ]);
        
        try {
            //code...
            $categoryChildrens = CategoryChildren::create([
                'category_childrens_name'=>  $inputData['categoryChildrenName'] ,
                'category_childrens_des'=>  $inputData['categoryChildrenDescripsion'],
                'category_childrens_status'=> $inputData['categoryChildrenStatus'],
                'category_id' =>  $inputData['categotyParent']
            ]);
              \Log::info($categoryChildrens);
            return redirect('/categoryproducts/create')->with('status','Thêm danh mục con thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Thêm thất bại');
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
        $categoryProducts = CategoryProduct::where("category_id", $id)->get();       
        return view('admin.category.edit', compact('categoryProducts'));
    }

    public function editChildren($id){
        $categoryProducts = CategoryProduct::all();
        $categoryChildrens = CategoryChildren::where("category_childrens_id", $id)->get();       
        return view('admin.category.children.edit', compact('categoryChildrens','categoryProducts'));
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
            'categoryName',
            'categoryDescripsion',
            'categoryStatus'
        ]);

        $categoryProducts = CategoryProduct::where("category_id",$id);

        try {
            //code...
            $categoryProducts->update([
                'category_name'=>  $inputData['categoryName'] ,
                'category_des'=>  $inputData['categoryDescripsion'],
                'category_status'=> $inputData['categoryStatus'],
            ]);
            return redirect('/categoryproducts/'. $id . '/edit')->with('status','Chỉnh sửa danh mục thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Chỉnh sửa thất bại');
        }  
    }

    public function updateChildren(Request $request, $id){
        $inputData= $request->only([
            'categoryChildrenName',
            'categoryChildrenDescripsion',
            'categoryChildrenStatus',
            'categotyParent'
        ]);

        $categoryChildrens = CategoryChildren::where("category_childrens_id",$id);

        try {
            //code...
            $categoryChildrens ->update([
                'category_childrens_name'=>  $inputData['categoryChildrenName'] ,
                'category_childrens_des'=>  $inputData['categoryChildrenDescripsion'],
                'category_childrens_status'=> $inputData['categoryChildrenStatus'],
                'category_id'=> $inputData['categotyParent']
            ]);
            return redirect('/categorychildren/'. $id . '/edit')->with('status','Chỉnh sửa danh mục con thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Chỉnh sửa thất bại');
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
        $categoryProducts = CategoryProduct::where("category_id",$id);

        try {
            //code...
            $categoryProducts ->delete();
            return redirect('/categoryproducts')->with('status','Xóa danh mục thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa không thành công');
        }
        
    }
    public function destroyChildren($id)
    {     
        $categoryChildrens = CategoryChildren::where("category_childrens_id", $id);
        try {
            //code...
            $categoryChildrens->delete();
            return redirect('/categorychildren')->with('status','Xóa danh mục con thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa không thành công');
        }
        
    }

    public function searchCategory(Request $request){
        $categoryProducts = CategoryProduct::where('category_name','like', '%' .$request->search .'%')
                            ->orwhere('category_id',$request->search )->paginate(5);
        return view('admin.category.index', compact('categoryProducts'));
    }

    public function searchCategoryChil(Request $request) {
        $categoryProducts = CategoryProduct::get();
        $categoryChildrens = CategoryChildren::where('category_childrens_name','like', '%' .$request->search .'%')
                            ->orwhere('category_childrens_id',$request->search )->paginate(5);
        return view('admin.category.children.index', compact('categoryChildrens','categoryProducts'));
    }
}