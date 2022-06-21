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
                            Sửa Slider
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
                              
                                <form id="sliderEdit" role="form" action="/slider/{{$slider->slider_id}}" method="POST"  enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên Slider</label>
                                        <input type="text" class="form-control" value="{{$slider->slider_name}}" name="sliderName" id="nameCatagory"
                                            placeholder="Ten slider">
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh sản phẩm</label>
                                        <input type="file" name="sliderImage" >
                                        <img src="{{URL::to('upload/' . $slider->slider_image)}}" height="80px" with="120px" alt="">                                        
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung sản phẩm</label>
                                        <textarea  name="sliderContent" class="form-control" rows="9">{{$slider->slider_content}}
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <?php
                                            if ($slider->slider_staus==0){
                                                echo '<select name="sliderStatus" class="form-control input-lg m-bot15">';
                                                echo "<option value=\"$slider->slider_staus\">Ẩn</option>";
                                                echo "<option value=\"1\">Hiển thị</option>";
                                                echo  "</select>";
                                            } else {
                                                echo '<select name="sliderStatus"  class="form-control input-lg m-bot15">
                                                        <option value="1" >Hiển thị</option>
                                                        <option value="0" >Ẩn</option>
                                                    </select>';
                                            }
                                        ?>
                                    </div>
                                    <button type="submit" class="btn btn-info">Sửa Slider</button>
                                </form>
                              
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