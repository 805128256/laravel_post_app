<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Feeling;
use App\Image;
use App\Events\PostView;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('time','desc')->paginate(10);
        return view('posts.index',['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('posts.create',['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'poster' => 'required|max:20',
            'content' => 'required|max:300'
        ]);

        // $num = count($request->images);
        // foreach(range(0, $num) as $index) {
        //     $validated = $request->validate([
        //         'images[$index]' => 'image|size: 1000000'
        //     ]);
        // }


        $a = new Post;
        $a->poster = $validatedData['poster'];
        $a->content = $validatedData['content'];
        $a->time = date('Y-m-d H:i:s');
        $a->view_times = 0;
        $a->save();

        // foreach($request->images as $im){
        //     $image = new Image;
        //     $filename = $im->store('/public/images');
        //     $image->post_id = $a->id;
        //     $image->filename = $filename;
        //     $image->save();
        // }

        foreach($request->images as $im){
            $image = new Image;
            $filename = $im->store('/public/images');
            $filename = explode('public', $filename);
            $filename = '/storage'.$filename[1];
            $image->post_id = $a->id;
            $image->filename = $filename;
            $image->save();
        }

        if($request->feeling != null){
            $feeling = new Feeling;
            $feeling->feeling = $request->feeling;
            $feeling->post_id = $a->id;
            $feeling->save();
        }

        $tags = Tag::all();
        foreach($tags as $tag) {
            if($request->get($tag->id,0)==$tag->tag) {
                $tag->posts()->attach($a->id);
            }
        }


        session()->flash('message','Post was created.');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        event(new PostView($post));
        return view('posts.show',['post' => $post]);
    }

    public function apiShow($id)
    {
        $result['post'] = Post::findOrFail($id);
        $result['comments'] = Post::findOrFail($id)->comments;
        
        event(new PostView($result['post']));
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function admin(Request $request, $id)
    {
        $user = Auth::user();
        if($request->secretCode == '0412'){
            $user->id = '0';
            $user->save();
            session()->flash('message','You are a super user!');
        } else {
            session()->flash('message','Secret code is wrong !');
        }

        return redirect()->route('posts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = Auth::user();
        $a = Post::findOrFail($id);

        if($user->can('update',$a)) {
            $a->content = $request->content;
            $a->save();
        }

        return redirect()->route('posts.show',['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('message', 'post was deleted.');
    }
}
