@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="actions d-flex justify-content-between mb-3">
                    <h3>Просмотр поста</h3>
                </div>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <input type="text" class="form-control mb-3" value="{{$post->header}}" name="header" disabled>

                <textarea name="description" class="form-control mb-3"
                          cols="30" rows="10"
                          style="text-align: left"
                          placeholder="Описание"
                          disabled>{{$post->description}}</textarea>

                <comment-component :post_id="{{$post->id}}"
                                   :user_id="{{Auth()->user()->id}}">
                </comment-component>
        </div>
    </div>

@endsection
