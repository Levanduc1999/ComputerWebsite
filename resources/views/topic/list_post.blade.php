@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Danh sách bài viết</h2>
						@foreach ($posts as $post)						
						<div class="col-sm-4">
							<div class="post-image-wrapper">
								<div class="single-post">
										<div class="postinfo text-center">
											<img width="160px" height="160px"src="{{URL::to('upload/' . $post->post_image)}}" alt="" />											
										</div>
								</div>
							</div>	
						</div>
						<a href="{{URL::to('/home/showpost/' . $post->post_id)}}" style="color: unset;">	
						<div class="col-sm-8">
							<p style="padding-top:20px">{!!$post->post_name!!}</p>
							<p>{!!substr($post->post_des,0,200) . '...'!!}</p>
						</div>
						</a>			
						@endforeach	
						<div>
							{{ $posts->links() }}
						</div>									
</div><!--features_items-->
@endsection
