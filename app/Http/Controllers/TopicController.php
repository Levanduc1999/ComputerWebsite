<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::paginate(5);
        return view('admin.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topic.create');
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
            'topicName',
            'topicDescripsion',
            'topicStatus'
        ]);
    
        try {        
            //code...
            $topics = Topic::create([
                'topic_name'=>  $inputData['topicName'] ,
                'topic_des'=>  $inputData['topicDescripsion'],
                'topic_status'=> $inputData['topicStatus'],
            ]);
            return redirect('/topic/create')->with('status','Thêm chủ đề thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Thêm chủ đề thất bại');
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
        $topics = Topic::where("topic_id", $id)->get();        
        return view('admin.topic.edit', compact('topics'));
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
            'topicName',
            'topicDescripsion',
            'topicStatus'
        ]);

        $topics = Topic::where("topic_id", $id);

        try {
            //code...
            $topics ->update([
                'topic_name'=>  $inputData['topicName'] ,
                'topic_des'=>  $inputData['topicDescripsion'],
                'topic_status'=> $inputData['topicStatus'],
            ]);
            return redirect('/topic/'. $id . '/edit')->with('status','Chỉnh sửa chủ đề thành công');
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
        $topic = Topic::where("topic_id",$id);

        try {
            //code...
            $topic->delete();
            return redirect('/topic')->with('status','Xóa chủ đề thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa thất bại');
        }
    }

    public function searchTopic(Request $request){
        dd('oki');
        $topics = Topic::Where('topic_name', 'like', '%' . $request->search . '%')->orWhere('topic_id',$request->search)->paginate(5);
        return view('admin.topic.index', compact('topics'));
    }
}
