<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;

class CommentLikesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Comment $comment)
    {

        $comment->likes()->create([
            'user_id' => auth()->id()
        ]);

        /* == Like::create([
           'user_id'=>auth()->id(),
           'likeable_id'=>$comment->id,
           'likeable_type'=>get_class($comment),
       ]);*/
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->likes()->where([
            'user_id' => auth()->id()
        ])->delete();

        /*==    Like::Where([
            'user_id' => auth()->id(),
            'likeable_id' => $comment->id,
            'likeable_type' => get_class($comment),
        ])->delete();*/
    }
}
