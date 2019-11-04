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
     *
     * @SWG\Get(
     *      tags={"likes"},
     *      path="/post/{post}/likes",
     *      summary="post likes",
     *      @SWG\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Post $post)
    {
        //
        return response()->json(['data'=> $post->likes()->paginate(10), "state"=>1]);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"likes"},
     *      path="/post/{post}/likes",
     *      summary="add like",
     *      @SWG\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
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
     *
     * @SWG\Post(
     *      tags={"likes"},
     *      path="/like/{like}/delete",
     *      summary="delete like",
     *      @SWG\Parameter(
     *         name="like",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="post_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     * @param Request $request
     * @param Like $like
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
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
