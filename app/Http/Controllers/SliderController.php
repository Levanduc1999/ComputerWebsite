<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders =Slider::paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $getImage= $request->file('sliderImage');
        if($getImage){
            $nameImage= $getImage->getClientOriginalName();
            $newNameImage= time() . $nameImage;
            $getImage->move('upload', $newNameImage);
        } else {
            $newNameImage='';
        }
        

        $inputData= $request->only([
            'sliderName',
            'sliderContent',
            'sliderStatus',
        ]);
       
        try {            
            //code...
         
            $sliders = Slider::create([
                'slider_name'=>  $inputData['sliderName'] ,
                'slider_content'=>  $inputData['sliderContent'],
                'slider_image'=> $newNameImage,
                'slider_staus'=> $inputData['sliderStatus'],
            ]);     
            
            return redirect('/slider/create')->with('status','Thêm Slider thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Thêm Slider thất bại');
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
        $slider =  Slider::where('slider_id', $id)->first();   
        // dd( $sliders->slider_id);
        return view('admin.slider.edit', compact('slider'));
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
        
        $sliders = Slider::where('slider_id', $id)->first();
        $newNameImage = $sliders->slider_image;
        $getImage= $request->file('sliderImage');
        if($getImage){
            $nameImage= $getImage->getClientOriginalName();
            $newNameImage= time() . $nameImage;
            $getImage->move('upload', $newNameImage);
        }
       
        $inputData= $request->only([
            'sliderName',
            'sliderContent',
            'sliderStatus',
        ]);
       
        try {    
            $sliders ->update([
                'slider_name'=> $inputData['sliderName'],
                'slider_content'=> $inputData['sliderContent'],
                'slider_image'=> $newNameImage,
                'slider_staus'=> $inputData['sliderStatus'],
            ]);
            return redirect('/slider/'. $id. '/edit')->with('status','Cập nhật Slider thành công');
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
        $sliders = Slider::where("slider_id",$id);

        try {
            //code...
            $sliders ->delete();
            return redirect('/slider')->with('status','Xóa Slider thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa thất bại');
        }
    }

    public function searchSlider(Request $request){

        $sliders = Slider::Where('slider_name', 'like', '%' . $request->search . '%')->orWhere('slider_id', $request->search)->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
}
