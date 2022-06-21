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
                            Thêm danh mục con
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
                                @foreach($categoryChildrens as $categoryChildren)
                                <form role="form" id="categoryChidlrenEdit" action="/categorychildren/{{$categoryChildren->category_childrens_id}}" method="post" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" class="form-control" name="categoryChildrenName" value="{{$categoryChildren->category_childrens_name}}" id="nameCatagory"
                                            placeholder="Ten danh muc">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả danh mục</label>
                                        <textarea id="categoryChildrenDescripsion" value="{{$categoryChildren->category_childrens_name}}" name="categoryChildrenDescripsion" class="form-control" rows="9">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select name="categoryChildrenStatus" class="form-control input-lg m-bot15">
                                            @if($categoryChildren->category_childrens_status==1)
                                            <option value="1" >Hiển thị</option>
                                            @endif
                                            <option value="0" >Ẩn</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục lớn</label>
                                        <select name="categotyParent" class="form-control input-lg m-bot15">
                                            @foreach($categoryProducts as $categoryProduct)
                                                    @if($categoryProduct->category_id== $categoryChildren->category_id)                                   
                                                        <option selected value="{{$categoryProduct->category_id}}">{{$categoryProduct->category_name}}</option>
                                                    @else 
                                                        <option  value="{{$categoryProduct->category_id}}">{{$categoryProduct->category_name}}</option>
                                                    @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Sửa danh mục</button>
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