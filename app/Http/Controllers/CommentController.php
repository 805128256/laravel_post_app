<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:20',
            'comment' => 'required|max:30',
            'post_id' => 'required'
        ]);

        $a = new Comment;
        $a->name = $validatedData['name'];
        $a->comment = $validatedData['comment'];
        $a->post_id = $validatedData['post_id'];
        $a->save();

        session()->flash('message','Comment was created.');
        return redirect()->route('posts.show', ['id' =>$a->post_id]);
        //return $a;
    }

    public function apiStore(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'name' => 'required|max:20',
            'comment' => 'required|max:50|min:3|alpha_num',
            'post_id' => 'required'
        ]);

        $a = new Comment;
        $a->name = $validatedData['name'];
        $a->comment = $validatedData['comment'];
        $a->post_id = $validatedData['post_id'];
        $a->save();

        session()->flash('message','Comment was created.');
        //return redirect()->route('posts.show', ['id' =>$a->post_id]);
        return $a;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $a = Comment::findOrFail($request->id);

        if($user->can('update',$a)) {
            $a->comment = $request->comment;
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
        $comment = Comment::findOrFail($id);
        $post = $comment->post_id;
        $comment->delete();

        return redirect()->route('posts.show',['id' => $post])->with('message', 'comment was deleted.');
    }
}
