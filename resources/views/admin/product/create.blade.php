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
                            Thêm sản phẩm
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
                                <form id="productCreate"role="form" action="/product" method="post"  enctype="multipart/form-data" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" class="form-control"  name="productName" id="nameCatagory"
                                            placeholder="Ten san pham">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá sản phẩm</label>
                                        <input type="text" class="form-control"  name="productPrice" id="nameCatagory">
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh sản phẩm</label>
                                        <input type="file" name="productImage">                                      
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả sản phẩm</label>
                                        <textarea id="productDescripsion" name="productDescripsion" class="form-control" rows="9">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung sản phẩm</label>
                                        <textarea id="productContent" name="productContent" class="form-control" rows="9">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục lớn<noscript></noscript></label>
                                        <select name="category" id ="category" class="form-control input-lg m-bot15 chose">
                                            @foreach($categoryProducts as $categoryProduct)
                                                <option value="{{$categoryProduct->category_id}}">{{$categoryProduct->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục nhỏ</label>
                                        <select  name="categoryChil" id="categoryChil" class="form-control input-lg m-bot15">
                                                                          
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Thương hiệu sản phẩm</label>
                                        <select name="brand" class="form-control input-lg m-bot15">
                                            @foreach($brands as $brand)                                   
                                                    <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="productStatus" class="form-control input-lg m-bot15">                                                                           
                                                    <option selected value="0">Ẩn</option>
                                                    <option selected value="1">Hiển thị</option>                     
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
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