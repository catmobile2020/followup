<?php

namespace App\Http\Controllers\api;

use App\Comment;
use App\Reply;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{

    /**
     *
     * @SWG\Get(
     *      tags={"replies"},
     *      path="/comment/{comment}/replies",
     *      summary="comment replies",
     *      @SWG\Parameter(
     *         name="comment",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Comment $comment)
    {
        return response()->json(['data'=> $comment->replies()->paginate(10), "state"=>1]);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"replies"},
     *      path="/comment/{comment}/replies",
     *      summary="add new replie",
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
    public function store(Request $request, Comment $comment)
    {
        $this->validate($request , [
            'user_id' => 'required',
            'body' => 'required|string',
        ]);
        $user = User::findOrFail($request->user_id);

        $body = $request->body;

        $reply = $comment->replies()->create(['body'=> $body, 'user_id'=> $user->id]);
        $image = $request->image;
        if($image != '' && $image != null){
            //$image = substr($image, strpos($image, ",")+1);
            $file_name = 'image_'. $reply->id . time() . '.jpg'; //generating unique file name;
            $path = public_path('uploads');
            $newImage = base64_decode($image);

            file_put_contents($path . '/' . $file_name, $newImage);
            $reply->photos()->create(['path' => 'uploads/' .$file_name]);
        }

        return response()->json(['data'=> $comment->replies()->paginate(10) , 'state'=> 1 ]);

    }

    /**
     *
     * @SWG\Post(
     *      tags={"replies"},
     *      path="/reply/{reply}/update",
     *      summary="update replie",
     *      @SWG\Parameter(
     *         name="reply",
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
     * @param Reply $reply
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Reply $reply)
    {
        $this->validate($request , [
            'user_id' => 'required',
            'body' => 'required|string',
        ]);
        $user = User::findOrFail($request->user_id);
        $body = $request->body;

        if($request->user_id == $reply->user_id)
        {
            $reply->body = $body;
            $reply->save();
            if($request->has('image')) {
                $image = $request->image;
                //$image = substr($image, strpos($image, ",")+1);
                $file_name = 'image_' . $reply->id . time() . '.jpg'; //generating unique file name;
                $path = public_path('uploads');
                $newImage = base64_decode($image);

                file_put_contents($path . '/' . $file_name, $newImage);
                if (count($reply->photos) > 0) {
                    foreach ($reply->photos as $photo) {
                        if (file_exists($photo->path)) {
                            @unlink($photo->path);
                        }
                        $photo->path = 'uploads/' . $file_name;
                        $photo->save();
                    }
                } else {
                    $reply->photos()->create(['path' => 'uploads/' . $file_name]);
                }

                foreach ($reply->photos as $photo) {
                    $photo = $photo->path;
                }
            }
            return response()->json(['data'=> 'Reply Updated Successfully' , 'state'=> 1 ]);

        }else{
            return response()->json(['data'=> 'you don\'t have the right to update this Reply', 'state'=>0]);
        }

    }


    /**
     *
     * @SWG\Post(
     *      tags={"replies"},
     *      path="/reply/{reply}/delete",
     *      summary="delete replie",
     *      @SWG\Parameter(
     *         name="reply",
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
     * @param Reply $reply
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, Reply $reply)
    {
        $this->validate($request , [
            'user_id' => 'required',
        ]);
        User::findOrFail($request->user_id);

        if($request->user_id == $reply->user_id)
        {
            foreach ($reply->photos as $photo) {
                if (file_exists($photo->path)) {
                    @unlink($photo->path);
                }
            }

            $reply->photos()->delete();
            $reply->delete();
            return response()->json(['data'=> 'Reply Deleted Successfully' , 'state'=> 1 ]);

        }else{
            return response()->json(['data'=> 'you don\'t have the right to delete this Reply', 'state'=>0]);
        }
    }


}
