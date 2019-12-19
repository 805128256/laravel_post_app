@extends('layouts.app')

@section('title', 'Create a Post')


@section('content')

    <form method='POST' action="{{ route('posts.store')}}" enctype="multipart/form-data">
        @csrf

        <input type='hidden' name='poster'
            value="{{Auth::user()->name}}">
        <p>Your post: <input type='text' name='content'
            value="{{old('content')}}"></p>

        <a>Upload images for your post:</a>
        <input type="file" name="images[]" multiple="multiple">

        <p>Your feeling: <input type='text' name='feeling'
            value="{{old('feeling')}}"></p>
        @foreach ($tags as $tag)
            <p>
            <input type="hidden" name="{{$tag->id}}" value="0">
            <input type="checkbox" name="{{$tag->id}}" value="{{$tag->tag}}">
            <a>{{$tag->tag}}</a>
            </p>
        @endforeach
        

        <input type='submit' value='Submit'>
        <a href="{{ route('posts.index')}}">Cancel</a>

    </form>

@endsection