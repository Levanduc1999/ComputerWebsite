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
                           Chỉnh sửa danh mục
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
                                @foreach($categoryProducts as $categoryProduct)
                                <form id="categoryEdit" role="form" action="{{'/categoryproducts/' . $categoryProduct->category_id}}" method="post" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên danh mục</label>
                                        <input type="text" class="form-control" value="{{$categoryProduct->category_name}}" name="categoryName" id="nameCatagory"
                                            placeholder="Ten danh muc">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả danh mục</label>
                                        <textarea  id="categoryDescripsion" value="" name="categoryDescripsion" class="form-control" rows="9">{{$categoryProduct->category_des}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <?php
                                            if ($categoryProduct->category_status==0){
                                                echo '<select name="categoryStatus" class="form-control input-lg m-bot15">';
                                                echo "<option value=\"$categoryProduct->category_status\">Ẩn</option>";
                                                echo "<option value=\"1\">Hiển thị</option>";
                                                echo  "</select>";
                                            } else {
                                                echo '<select name="categoryStatus"  class="form-control input-lg m-bot15">
                                                        <option value="1" >Hiển thị</option>
                                                        <option value="0" >Ẩn</option>
                                                    </select>';
                                            }
                                        ?>
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