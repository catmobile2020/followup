<?php

namespace App\Http\Controllers\api;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     *
     * @SWG\Get(
     *      tags={"comments"},
     *      path="/post/{post}/comments",
     *      summary="post comments",
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

        return response()->json(['data'=> $post->comments()->paginate(10), "state"=>1]);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"comments"},
     *      path="/post/{post}/comments",
     *      summary="add new comment",
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
     *      ),@SWG\Parameter(
     *         name="body",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Post $post)
    {
        $this->validate($request , [
            'user_id' => 'required',
            'body' => 'required|string',
        ]);
        $user = User::findOrFail($request->user_id);

        $body = $request->body;

       $comment =  $post->comments()->create(['body'=> $body, 'user_id'=> $user->id]);
        $image = $request->image;
        if($image != '' && $image != null){
            //$image = substr($image, strpos($image, ",")+1);
            $file_name = 'image_'. $comment->id . time() . '.jpg'; //generating unique file name;
            $path = public_path('uploads');
            $newImage = base64_decode($image);

            file_put_contents($path . '/' . $file_name, $newImage);
            $comment->photos()->create(['path' => 'uploads/' .$file_name]);
        }

        return response()->json(['data'=> $post->comments()->paginate(10) , 'state'=> 1 ]);

    }

    /**
     *
     * @SWG\Post(
     *      tags={"comments"},
     *      path="comment/{comment}/update",
     *      summary="update comment",
     *      @SWG\Parameter(
     *         name="comment",
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
     *         name="body",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     * @param Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Comment $comment)
    {
        //
        $this->validate($request , [
            'user_id' => 'required',
            'body' => 'required|string',
        ]);
        $user = User::findOrFail($request->user_id);
        $body = $request->body;

        if($request->user_id == $comment->user_id)
        {
            $comment->body = $body;
            $comment->save();

            if($request->has('image')) {
                $image = $request->image;
                //$image = substr($image, strpos($image, ",")+1);
                $file_name = 'image_' . $comment->id . time() . '.jpg'; //generating unique file name;
                $path = public_path('uploads');
                $newImage = base64_decode($image);

                file_put_contents($path . '/' . $file_name, $newImage);
                if (count($comment->photos) > 0) {
                    foreach ($comment->photos as $photo) {
                        if (file_exists($photo->path)) {
                            @unlink($photo->path);
                        }
                        $photo->path = 'uploads/' . $file_name;
                        $photo->save();
                    }
                } else {
                    $comment->photos()->create(['path' => 'uploads/' . $file_name]);
                }

                foreach ($comment->photos as $photo) {
                    $photo = $photo->path;
                }
            }
            return response()->json(['data'=> 'Comment Updated Successfully' , 'state'=> 1 ]);

        }else{
            return response()->json(['data'=> 'you don\'t have the right to update this comment', 'state'=>0]);
        }

    }

    /**
     *
     * @SWG\Post(
     *      tags={"comments"},
     *      path="comment/{comment}/delete",
     *      summary="delete comment",
     *      @SWG\Parameter(
     *         name="comment",
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
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Comment $comment)
    {
        //
        $this->validate($request , [
            'user_id' => 'required',
        ]);
        User::findOrFail($request->user_id);

        if($request->user_id == $comment->user_id)
        {
            foreach ($comment->photos as $photo) {
                if (file_exists($photo->path)) {
                    @unlink($photo->path);
                }
            }

            $comment->photos()->delete();
            foreach ($comment->replies as $reply) {
                foreach ($reply->photos as $photo) {
                    if (file_exists($photo->path)) {
                        @unlink($photo->path);
                    }
                }
                $reply->photos()->delete();
            }
            $comment->replies()->delete();
            $comment->delete();
            return response()->json(['data'=> 'Comment Deleted Successfully' , 'state'=> 1 ]);

        }else{
            return response()->json(['data'=> 'you don\'t have the right to delete this comment', 'state'=>0]);
        }
    }
}
