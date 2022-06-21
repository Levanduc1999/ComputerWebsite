@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách chủ đề
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                       
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <form action="/search-topic" method="POST">
                             {{csrf_field()}}
                            <div class="input-group">                             
                                <input type="text" name="search" class="input-sm form-control" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-default" type="submit">Tìm</button>
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
                                <th>Tên chủ đề</th>
                                <th>Trạng thái</th>
                                <th>Ngày Thêm</th>
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
                            @foreach($topics as $topic)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$topic->topic_name}}</td>
                                <td><span class="text-ellipsis"><?php
                                if ($topic->topic_status==0){
                                    echo  '<span value="" >Ẩn</option>';                                      
                                } else {
                                    echo  '<span value="1" >Hiển thị</span>';     
                                }
                                ?></span></td>
                                <td><span class="text-ellipsis">{{$topic->updated_at}}</span></td>
                                <td>
                                    <a href="{{route('topic.edit',['topic'=>$topic->topic_id])}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn chắc chắn muốn xóa chủ đề này?')" href="{{route('topic.destroy',['topic'=>$topic->topic_id])}}" class="active" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                {{ $topics->links() }}
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