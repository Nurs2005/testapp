@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <post-list-component :user_id="{{Auth()->user()->id}}"></post-list-component>
{{--            @foreach($posts as $post)--}}
{{--                <a href="{{route('post_detail', ['id' => $post->id])}}" style="text-decoration: none">--}}
{{--                    <div class="card mb-3">--}}
{{--                        <div class="card-header d-flex justify-content-between">--}}
{{--                            <h4>{{$post->header}}</h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">{{$post->description}}</div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            @endforeach--}}
        </div>
    </div>
</div>

@endsection
