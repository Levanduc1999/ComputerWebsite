@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách bài viết
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <form action="/search-post" method="POST">
                        {{csrf_field()}}
                        <div class="input-group">
                            <input type="text" name="search" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="submid">Tìm</button>
                            </span>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>Tên bài viết</th>
                                <th>Mô tả bài viết</th>
                                <th>Hình sản bài viết</th>
                                <th>trạng thái</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        @if (session('status'))
                            <div class="status" style="color: forestgreen" >
                                <i class="fa fa-check text-success text-active"></i>
                                {{ session('status') }}
                            </div>
                        @elseif(session('statuser'))
                            <div class="statuser" style="color: red">
                                <i class="fa fa-times text-danger text"></i>
                                {{ session('statuser') }}
                            </div>
                        @endif
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{!!$post->post_name!!}</td>                              
                                <td>{!!$post->post_des!!}</td>
                                <td><img src="{{URL::to('upload/'. $post->post_image)}}" height="80px" with="120px" alt=""></td>
                                <td><span class="text-ellipsis"><?php
                                if ($post->post_status==0){
                                     echo  '<span value="" >Ẩn</option>';  
                                } else {
                                    echo  '<span value="1" >Hiển thị</span>';
                                }
                                ?></span></td>
                                <td>
                                    <a href="{{route('post.edit',['post'=>$post->post_id])}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn chắc chắn muốn xóa bài viết này?')" href="{{route('post.destroy',['post'=>$post->post_id])}}" class="active" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                {{ $posts->links() }}
                            </ul>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </section>
    <!-- footer -->
    <div class="footer">
        <div class="wthree-copyright">
            <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
        </div>
    </div>
    <!-- / footer -->
</section>

@endsection