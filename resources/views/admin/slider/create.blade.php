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
                            Thêm slider
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
                                <form id="sliderCreate"role="form" action="/slider" method="post"  enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên Slider</label>
                                        <input type="text" class="form-control"  name="sliderName" id="nameCatagory"
                                            placeholder="Ten san pham">
                                    </div>                                  
                                    <div class="form-group">
                                        <label>Hình ảnh Slider</label>
                                        <input type="file" name="sliderImage" >                                      
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung Slider</label>
                                        <textarea  id="sliderContent" name="sliderContent" class="form-control" rows="9">
                                        </textarea>
                                    </div>
                                   
                                    <div class="form-group">
                                        <select name="sliderStatus" class="form-control input-lg m-bot15">                                                                           
                                                <option  value="0">Ẩn</option>
                                                <option  selected value="1">Hiển thị</option>                     
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Thêm Slider</button>
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