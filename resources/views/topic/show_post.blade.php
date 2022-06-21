@extends('layouts.myapp')

@section('tittle' , 'shop')

@section('content')
<div class="features_items"><!--features_items-->
	<h2 class="title text-center">{!!$posts->post_name!!}</h2>
    <div>
        {!!$posts->post_content!!}
    </div>
</div><!--features_items-->
@endsection
