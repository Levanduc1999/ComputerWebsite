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
                            Phí vận chuyển
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
                                <form id="feeCreate" role="form" action=""  method="post" >
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tỉnh-Thành phố</label>
                                        <select id="city" name="city" class="form-control input-lg m-bot15 chose">
                                            <option value="" >--- Chọn Tỉnh-Thành phố ---</option>
                                            @foreach($citys as $city)
                                            <option value="{{$city->id_city}}" >{{$city->name_city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     <div class="form-group">
                                        <label>Quận-huyện</label>
                                        <select id="province" name="province" class="form-control input-lg m-bot15 chose">
                                            <option value="" >--- Chọn Quận-huyện ---</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Xã-Phường</label>
                                        <select id="ward" name="ward" class="form-control input-lg m-bot15 ">
                                            <option value="" >--- Chọn Xã-Phường ---</option>
                                           
                                        </select>
                                    </div>
                                     <div class="form-group">
                                        <label>Phí vận chuyển</label>
                                        <input type="text" class="form-control " name="fee" id="fee">
                                    </div>
                                    <button type="button" class="btn btn-info">Thêm phí vận chuyển</button>
                                </form>
                            </div>
                            <div id ="load_fee">

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
            loadFee();
            function loadFee() {      
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '/loadfee',
                    method: 'POST',
                    data:{ 
                          _token:_token,                     
                    },
                    success:function(loadData){
                        $('#load_fee').html(loadData);
                    }
                });
            }
            $(document).on('blur','.edit', function(){
                var idFee= $(this).data('fee_id');
                var feeShip= $(this).text();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '/updatefee',
                    method: 'POST',
                    data:{ 
                          _token:_token, 
                          idFee :idFee,
                          feeShip :feeShip
                    },
                    success:function(loadData){
                        loadFee();
                    }
                });
            });
            $('.btn-info').click(function(event) {
                
                var _token = $('input[name="_token"]').val();
                var idCity = $('#city').val();
                var idProvince = $('#province').val();
                var fee = $('#fee').val();
                var idWard = $('#ward').val();
                alert(idCity);
                $.ajax({
                    url: '/addfee',
                    method: 'POST',
                    data:{
                        idCity: idCity,
                        _token:_token,
                        idProvince: idProvince,
                        idWard :idWard,
                        fee : fee
                    }, 
                    success:function(data){
                        loadFee();
                    }       
                });
            });
            $('.chose').on('change', function() {
                var nameSelect = $(this).attr('id');
                var _token = $('input[name="_token"]').val();
                var idOption = $(this).val();
                var resuft ='';
                if (nameSelect == 'city'){
                    resuft ='province';
                }else {
                    resuft= 'ward';
                }
                alert(nameSelect);
                $.ajax({
                    url: '/ajaxfee',
                    method: 'POST',
                    data:{
                        nameSelect: nameSelect,
                        _token:_token,
                        idOption: idOption
                    },
                    success:function(setOpiton){
                        $('#' + resuft).html(setOpiton);
                    }
                });
            });              
        });
</script>
@endsection