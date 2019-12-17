@extends('layouts.app')

@section('title', 'Posts')


@section('content')
    @if (session('message'))
        <p><b>{{session('message')}}</b></p>
    @endif

    <a href="{{route('posts.create')}}"> Create a post</a>

    <p>You can see all posts here:</p>

    <ul>
        @foreach ($posts as $post)
            <a href="{{route('posts.show', ['id' =>$post->id])}}">{{$post->content}}</a>
            <p style="color:crimson">create time: {{$post->time}}</p>
            <a style="color:crimson">views: {{$post->view_times}}   |   </a>
            <a>posted by: {{$post->poster}}</a>

            @if (Auth::user() != null && Auth::user()->name == $post->poster)
                <form method="POST"
                action="{{route('posts.destroy', ['id' => $post->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">DELETE </button>
                 </form>
            @endif 

            <p>________________________________________________________</p>
        @endforeach
    </ul>

    

    {{$posts->links()}}

    
@endsection