@extends('admin.myadmin')

@section('tittle' , 'shop')

@section('content')
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách người dùng
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <form action="/search-user" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="search" class="input-sm form-control" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn btn-sm btn-default" type="submid">Tìm</button>
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
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Admin</th>
                                <th>Distributor</th>
                                <th>User</th>
                                
                            </tr>
                        </thead>
                        @if (session('status'))
                                    <div class="status">
                                        {{ session('status') }}
                                    </div>
                        @endif
                        @foreach($admins as $admin)
                        <tbody>
                            <form action="/user" method="post">
                                {{csrf_field()}}
                            <tr>
                                <td><label class="i-checks m-b-none"><input type="checkbox"
                                            name="post[]"><i></i></label></td>
                                <td>{{$admin->admin_name}}</td>
                                <td class="admin_email">{{$admin->admin_email}}</td>
                                <input type="text" name="admin_email" style="display:none" value="{{$admin->admin_email}}">
                                <td>{{$admin->admin_phone}}</td>
                                <td><input type="checkbox" name="roleAdmin" {{$admin->hasrole('admin') ? 'checked' : ''}}></td>
                                <td><input type="checkbox" name="roleDistributor" {{$admin->hasrole('distributor')  ? 'checked' : ''}}></td> 
                                <td><input type="checkbox" name="roleUser" {{$admin->hasrole('user')  ? 'checked' : ''}}></td> 
                                <td>
                                    <button type="submid" class="role"  style="display: block">Thay quyền</button>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa user này?')" href="/user/{{$admin->admin_id}}" class="btn btn-danger"  style="display: block;width:90px;padding:3px 11px" >Xóa quyền</a>
                                </td>        
                            </tr>  
                            </form>      
                        </tbody>
                        @endforeach
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-5 text-center">
                            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            <ul class="pagination pagination-sm m-t-none m-b-none">
                                 {{ $admins->links() }}
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
