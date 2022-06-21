<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts= Post::orderby('post_id','desc')->paginate(5);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        return view('admin.post.create',compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getImage= $request->file('postImage');
        if($getImage){
            $nameImage= $getImage->getClientOriginalName();
            $newNameImage= time() . $nameImage;
            $getImage->move('upload', $newNameImage);
        } else {
            $newNameImage='';
        }
        
        $inputData= $request->only([
            'postName',
            'postDescripsion',
            'postContent',
            'topic',
            'postStatus',
        ]);
       
        // try {
            //code...
            $posts = Post::create([
                'post_name'=>  $inputData['postName'] ,
                'post_des'=>  $inputData['postDescripsion'],
                'post_content'=> $inputData['postContent'],
                'post_image'=> $newNameImage,
                'post_status'=> $inputData['postStatus'],
                'topic_id'=> $inputData['topic'],
            ]);
            return redirect('/post/create')->with('status','Thêm bài viết thành công');
        // } catch (\Throwable $th) {
        //     return back()->with('statuser', 'Thêm bài viết thất bại');
        // }
         \Log::info($posts);
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
       
        $topics = Topic::all();
        
        $posts= Post::where('post_id',$id)->get();
    
        return view('admin.post.edit', compact('posts','topics'));
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
        $posts = Post::where('post_id', $id)->first();
        $newNameImage = $posts->post_image;
        $getImage= $request->file('postImage');
        if($getImage){
            $nameImage= $getImage->getClientOriginalName();
            $newNameImage= time() . $nameImage;
            $getImage->move('upload', $newNameImage);
        }

        $inputData= $request->only([
            'postName',
            'postDescripsion',
            'postContent',
            'topic',
            'postStatus',
        ]);
        \Log::info($inputData);
        try {
            $posts ->update([
                'post_name'=>  $inputData['postName'] ,
                'post_des'=>  $inputData['postDescripsion'],
                'post_content'=> $inputData['postContent'],
                'post_image'=> $newNameImage,
                'post_status'=> $inputData['postStatus'],
                'topic_id'=> $inputData['topic'],
            ]);
            return redirect('/post/'. $id. '/edit')->with('status','Cập nhật bài viết thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Sửa bài viết thất bại');
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
        
        $posts = Post::where("post_id",$id);
        try {
            //code...
            $posts ->delete();
            return redirect('/post')->with('status','Xóa bài viết thành công');
        } catch (\Throwable $th) {
            return back()->with('statuser', 'Xóa bài viết thất bại');
        }
    }
    public function searchPost(Request $request){
        $posts= Post::Where('post_name', 'like', '%' . $request->search . '%')->orWhere('post_id',$request->search)->paginate(5);
        return view('admin.post.index', compact('posts'));
    }
}
