@extends('layouts.app')

@section('title', 'Post Details')


@section('content')

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <ul id="root">
        
        <h3 v-show="post">@{{post.poster}} :</h3>
        <a v-show="post">@{{post.content}}</a>
        <p style="color:crimson" v-show="post">views: @{{post.view_times}}</p>

        @if (Auth::user() != null && Auth::user()->name == $post->poster)
            <form method="POST"
                action="{{route('posts.update', ['id' => $post->id]) }}">
                @csrf
                @method('PUT')
                <input type='text' name='content'>
                <button type="submit">update</button>
            </form>
        @endif 

        <h3>Comments :</h3>

        <div v-for="com in comments" :key="com.id">
            <h4>@{{com.name}} :</h4>  
            <a>@{{com.comment}}</a>

                <form method="POST"
                    action="{{route('comments.update', ['id' => $post->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type='hidden' name='id' :value= "com.id">
                    <input type='text' name='comment'>
                    <button type="submit">edit</button>
                </form>
        </div>
         

        <p>__________________________________________________</p>

        @if (session('message'))
            <p><b>{{session('message')}}</b></p>
        @endif


        <h4>Your comment: </h4>

        
            <input type='text' v-model="newComment">
            <button @click="createComment('{{Auth::user()->name}}')">submit</button> 

            <!--
            <input type='text' v-model="newCommentName">
            <input type='text' v-model="newComment">
            <button @click="createComment()">submit</button>
            -->
            

    </ul>

    <script>
        var app = new Vue({
            el: "#root",
            data: {
                post:'',
                comments: [],
                newComment: '',
                newContent: '',
            },
            mounted() {
                axios.get("{{ route ('api.posts.show',['id' => $post->id])}}")
                .then(response => {
                    this.comments = response.data.comments;
                    this.post = response.data.post;
                })
                .catch(response => {
                    console.log(response);
                })
            },
            methods: {
                createComment: function (newCommentName){
                    axios.post("{{ route ('api.comment.store')}}", {
                        "name" : newCommentName,
                        "comment": this.newComment,
                        "post_id": this.post.id
                    })
                    .then(response => {
                        this.comments.push(response.data);
                        this.newComment = '';
                    })
                    .catch(response => {
                        console.log(response);
                    })
                },
            }
        })
    </script>

    
  
@endsection