@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="form-w3layouts">
            <!-- page start-->
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa bài viết
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
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
                                @foreach($posts as $post)
                                <form id="postEdit"role="form" action="/post/{{$post->post_id}}" method="post"  enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên bài viết</label>
                                        <textarea id="postName" name="postName" value="" class="form-control" rows="3">{{$post->post_name}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh bài viết</label>
                                        <input type="file" name="postImage"> 
                                        <img src="{{URL::to('upload/' . $post->post_image)}}" height="80px" with="120px" alt="">                                         
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả bài viết</label>
                                        <textarea id="posttDescripsion" name="postDescripsion" value="" class="form-control" rows="9">{{$post->post_des}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung bài viết</label>
                                        <textarea id="postContent" name="postContent" value="" class="form-control" rows="9">{{$post->post_content}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chủ đề<noscript></noscript></label>
                                        <select name="topic" id ="topic" class="form-control input-lg m-bot15 chose">
                                            @foreach($topics as $topic)
                                                <option value="{{$topic->topic_id}}">{{$topic->topic_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="postStatus" class="form-control input-lg m-bot15">                                                                           
                                                <option selected value="0">Ẩn</option>
                                                <option selected value="1">Hiển thị</option>                     
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Sửa bài viết</button>
                                </form>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <!-- page end-->
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
@section('scriptadmin')
<script>
        $(document).ready(function() {   
            loadCategory();
            function loadCategory(){
                var _token = $('input[name="_token"]').val();
                var idOption = $('#category').val();
                $.ajax({
                    url: '/ajaxload',
                    method: 'POST',
                    data:{
                        _token:_token,
                        idOption: idOption
                    },
                    success:function(setOpiton){
                        
                        $('#categoryChil').html(setOpiton);
                    }
                });
            }
            
            $('.chose').on('change', function() {
                loadCategory();
            });              
        });
</script>
@endsection