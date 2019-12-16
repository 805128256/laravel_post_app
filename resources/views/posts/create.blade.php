@extends('layouts.app')

@section('title', 'Create a Post')


@section('content')

    <form method='POST' action="{{ route('posts.store')}}">
        @csrf

        <input type='hidden' name='poster'
            value="{{Auth::user()->name}}">
        <p>Content: <input type='text' name='content'
            value="{{old('content')}}"></p>

        <input type='submit' value='Submit'>
        <a href="{{ route('posts.index')}}">Cancel</a>

    </form>

@endsection