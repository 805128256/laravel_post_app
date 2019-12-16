@extends('layouts.app')

@section('title', 'Post Details')


@section('content')

    <ul>
        <h3>{{$post->poster}} :</h3>
        <a>{{$post->content}}</a>
        <p style="color:crimson" >views: {{$post->view_times}}</p>
        <h3>Comments :</h3>

        @if (Auth::user()->name == $post->poster)

            @foreach ($post->comments as $comment)
            <h4>{{$comment->name}} :</h4>  
            <a>{{$comment->comment}}</a>
            <form method="POST"
            action="{{route('comments.destroy', ['id' => $comment->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">DELETE </button>
             </form>
            @endforeach 
                
        @endif 

        @if (Auth::user()->name != $post->poster)

            @foreach ($post->comments as $comment)
            <h4>{{$comment->name}} :</h4>  
            <a>{{$comment->comment}}</a>
            @endforeach 
                
        @endif

         

        <h4>
            @if('[]' == $post->comments) No comments
            @endif
        </h4>  

        <p>__________________________________________________</p>

        @if (session('message'))
            <p><b>{{session('message')}}</b></p>
        @endif

        <form method='POST' action="{{ route('comments.store')}}">
                @csrf

            <input type='hidden' name='name' value="{{Auth::user()->name}}">
            <p>Content: <input type='text' name='comment'
                value="{{old('comment')}}"></p>
            <p><input type='hidden' name='post_id'
                value="{{$post->id}}"></p>

            <input type='submit' value='Submit'>
        </form>

    </ul>
  
@endsection