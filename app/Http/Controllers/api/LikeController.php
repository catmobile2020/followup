<?php

namespace App\Http\Controllers\api;

use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        //
        return response()->json(['data'=> $post->likes()->paginate(10), "state"=>1]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        //
        $this->validate($request , [
            'user_id' => 'required',
        ]);

        User::findOrFail($request->user_id);
        $chk = $post->likes()->where('user_id', $request->user_id)->get();
        if(count($chk) > 0){
           Like::where('user_id',$request->user_id)->where('post_id', $post->id)->delete();

            return response()->json(['data'=> $post->likes()->count(), "state"=>1]);
        }else{
            $post->likes()->create(['user_id'=>$request->user_id]);

            return response()->json(['data'=> $post->likes()->count(), "state"=>1]);
        }

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Like $like)
    {
        //
        $this->validate($request , [
            'user_id' => 'required',
            'post_id' => 'required',
        ]);
        User::findOrFail($request->user_id);
        Post::findOrFail($request->post_id);

        if($like->user_id == $request->user_id){
            $like->delete();
            return response()->json(['data'=> 'you have unlike this post', "state"=>1]);
        }

            return response()->json(['data'=>'error', 'state'=>0]);

    }
}
