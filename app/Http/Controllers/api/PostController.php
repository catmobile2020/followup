<?php

namespace App\Http\Controllers\api;

use App\Photo;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;

class PostController extends Controller
{
    use ApiResponser;

    /**
     *
     * @SWG\Get(
     *      tags={"posts"},
     *      path="/posts",
     *      summary="Get all posts",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="query",
     *         type="integer",
     *      ),
     *
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user_id =$request->user_id;
        if(empty($_GET['page']) || $_GET['page']==''){
            $posts = Post::orderBY('id', 'desc')->get();
        }else{
            $posts = Post::orderBY('id', 'desc')->paginate(10);
        }

        foreach ($posts as $post){
            $profile = Photo::where('imageable_id',$post->user_id)->where('imageable_type','App\User')->get();

            $post->profile_picture = implode(',', $profile->pluck('path')->all());
            $user_name = $post->user()->pluck('name')->all();
            $post->user = implode(",", $user_name);
            $post->photos;
            $last_comments = $post->comments()->latest()->take(3)->get();
            foreach ($last_comments as $last_comment)
            {
                $last_comment->user->photos[0];
                $last_comment->create_at = $last_comment->created_at->diffForHumans();
            }
            $post->last_comments = $last_comments;
            if ($user_id)
                $post->post_liked = in_array($user_id,$post->likes()->pluck('user_id')->toArray());
        }
        return $this->showAll($posts);

    }

    public function show(Post $post)
    {

    }

    /**
     *
     * @SWG\Post(
     *      tags={"posts"},
     *      path="/posts",
     *      summary="add new post",
     *      @SWG\Parameter(
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
     *      ),@SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         required=true,
     *         type="file",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $this->validate($request , [
            'user_id' => 'required',
            'body' => 'string|required_without:image',
            'image' => 'required_without:body',
        ]);

        $user = User::findOrFail($request->user_id);

        $post = $user->posts()->create(['body'=>$request->body, 'type'=>0]);

        $image = $request->image;
        if($image != '' && $image != null){
            //$image = substr($image, strpos($image, ",")+1);
            $file_name = 'image_'. $post->id . time() . '.jpg'; //generating unique file name;
            $path = public_path('uploads');
            $newImage = base64_decode($image);

            file_put_contents($path . '/' . $file_name, $newImage);
            $post->photos()->create(['path' => 'uploads/' .$file_name]);
        }

        $postData = Post::findOrFail($post->id);
        foreach ($postData->photos as $photo)
        {
            $photo = $photo->path;
        }

        return response()->json(['data'=> $postData, 'state'=>1]);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"posts"},
     *      path="/corporate-posts",
     *      summary="corporate-posts",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      )
     * ,@SWG\Parameter(
     *         name="body",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     * @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         required=true,
     *         type="file",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function corporateStore(Request $request)
    {

        $this->validate($request , [
            'user_id' => 'required',
            'body' => 'string|required_without:image',
            'image' => 'required_without:body',
        ]);

        $user = User::findOrFail($request->user_id);

        $post = $user->posts()->create(['body'=>$request->body, 'type'=>1]);

        $image = $request->image;
        if($image != '' && $image != null){
            //$image = substr($image, strpos($image, ",")+1);
            $file_name = 'image_'. $post->id . time() . '.jpg'; //generating unique file name;
            $path = public_path('uploads');
            $newImage = base64_decode($image);

            file_put_contents($path . '/' . $file_name, $newImage);
            $post->photos()->create(['path' => 'uploads/' .$file_name]);
        }

        $postData = Post::findOrFail($post->id);
        foreach ($postData->photos as $photo)
        {
            $photo = $photo->path;
        }

        return response()->json(['data'=> $postData, 'state'=>1]);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"posts"},
     *      path="/update-post/{post}",
     *      summary="update-post",
     *@SWG\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     * @SWG\Parameter(
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
     *      ),@SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         required=true,
     *         type="file",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request , [
            'user_id' => 'required',
            'body' => 'required|string',
            'image' => 'sometimes',
        ]);
        if($request->user_id == $post->user_id){
           $post->body = $request->body;
           $post->save();

           if($request->has('image')) {
               $image = $request->image;
               //$image = substr($image, strpos($image, ",")+1);
               $file_name = 'image_' . $post->id . time() . '.jpg'; //generating unique file name;
               $path = public_path('uploads');
               $newImage = base64_decode($image);

               file_put_contents($path . '/' . $file_name, $newImage);
               if (count($post->photos) > 0) {
                   foreach ($post->photos as $photo) {
                       if (file_exists($photo->path)) {
                           @unlink($photo->path);
                       }
                       $photo->path = 'uploads/' . $file_name;
                       $photo->save();
                   }
               } else {
                   $post->photos()->create(['path' => 'uploads/' . $file_name]);
               }

               foreach ($post->photos as $photo) {
                   $photo = $photo->path;
               }
           }

               return response()->json(['data'=> $post, 'state'=>1]);
       }else{
            return response()->json(['data'=> 'you don\'t have the right to update this post', 'state'=>0]);
        }
    }

    /**
     *
     * @SWG\Post(
     *      tags={"posts"},
     *      path="/delete-post/{post}",
     *      summary="delete-post",
     *@SWG\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     */

    public function destroy(Post $post)
    {

        foreach ($post->photos as $photo) {
            if (file_exists($photo->path)) {
                @unlink($photo->path);
            }
        }

        $post->photos()->delete();
        foreach ($post->comments as $comment)
        {
            foreach ($comment->photos as $photo) {
                if (file_exists($photo->path)) {
                    @unlink($photo->path);
                }
            }

            foreach ($comment->replies as $reply) {
                foreach ($reply->photos as $photo) {
                    if (file_exists($photo->path)) {
                        @unlink($photo->path);
                    }
                }
                $reply->photos()->delete();
            }
           $comment->photos()->delete();
            $comment->replies()->delete();
        }

        $post->comments()->delete();
        $post->likes()->delete();
        $post->delete();

        return response()->json(['data'=> 'Post Deleted Successfully ', 'state'=> 1]);


    }

    /**
     *
     * @SWG\Post(
     *      tags={"posts"},
     *      path="/user/{user}/posts",
     *      summary="user posts",
     * @SWG\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * ),
     */
    public function userPosts(User $user)
    {
        $posts = $user->posts()->paginate(10);

        foreach ($posts as $post){
            foreach ($post->photos as $photo) {
                $photo = $photo->path;
            }
        }

        return response()->json(['data'=> $posts, 'state'=> 1]);
    }

    public function comment(Request $request, Post $post)
    {
        $post->comments->create();
    }



}
