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
                            Chỉnh sửa thương hiệu
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
                                @foreach($brands as $brand)
                                <form id="brandEdit" role="form" action="{{'/brand/' . $brand->brand_id}}" method="post" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên thương hiệu</label>
                                        <input type="text" class="form-control" value="{{$brand->brand_name}}" name="brandName" id="nameCatagory"
                                            placeholder="Ten danh muc">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả thương hiệu</label>
                                        <textarea id="brandDescripsion"  value="" name="brandDescripsion" class="form-control" rows="9">{{$brand->brand_des}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <?php
                                            if ($brand->brand_status==0){
                                                echo '<select name="brandStatus" class="form-control input-lg m-bot15">';
                                                echo "<option value=\"$brand->brand_status\">Ẩn</option>";
                                                echo "<option value=\"1\">Hiển thị</option>";
                                                echo  "</select>";
                                            } else {
                                                echo '<select name="brandStatus"  class="form-control input-lg m-bot15">
                                                        <option value="1" >Hiển thị</option>
                                                        <option value="0" >Ẩn</option>
                                                    </select>';
                                            }
                                        ?>
                                    </div>
                                    <button type="submit" class="btn btn-info">Sửa thương hiệu</button>
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