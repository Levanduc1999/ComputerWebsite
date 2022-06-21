@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách danh mục
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                        
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <form action="/search-categorychil" method="Post">
                            @csrf
                        <div class="input-group">
                            <input type="text" name="search"class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="submit">Tìm</button>
                            </span>
                        </div>
                        </form>
                        <a href="{{route('categorychildren.create')}}" style="display:block; float:right" class="btn btn-info">Thêm danh mục nhỏ</a>
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
                                <th>Tên danh mục</th>
                                <th>Trạng thái</th>
                                <th>Danh mục lớn</th>
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
                            @foreach($categoryChildrens as $categoryChildren)
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$categoryChildren->category_childrens_name}}</td>
                                <td><span class="text-ellipsis"><?php
                                if ($categoryChildren->category_childrens_status==0){
                                   echo  '<span value="" >Ẩn</option>';  
                                } else {
                                   echo  '<span value="1">Hiển thị</span>'; 
                                }
                                ?></span></td>
                                @foreach($categoryProducts as $categoryProduct)
                                    @if($categoryProduct->category_id == $categoryChildren->category_id)
                                    <td><span class="text-ellipsis">{{$categoryProduct->category_name}}</span></td>
                                    @endif
                                @endforeach
                                <td>
                                    <a href="{{route('categorychildren.edit',['id'=>$categoryChildren->category_childrens_id])}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" href="/categorychildrendestroy/{{$categoryChildren->category_childrens_id}}" class="active" ui-toggle-class=""><i class="fa fa-trash-o text-danger text"></i></a>
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
                                 {{ $categoryChildrens->links() }}
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