<?php

namespace App\Http\Controllers\api;

use App\Comment;
use App\Like;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    use ApiResponser;
    /**
     *
     * @SWG\Get(
     *      tags={"Users"},
     *      path="/users",
     *      summary="Get all users",
     *
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function index()
    {
        if(empty($_GET['page']) || $_GET['page']==''){
            $users = User::where('active', 1)->get();

            foreach($users as $user) {
                if(count($user->photos) > 0){
                    foreach ($user->photos->pluck('path') as $photo){
                        $user->photo = $photo;
                    }
                }else{
                    $user->photo = 'nophoto';
                }
                unset($user->photos);
                foreach ($user->skills->pluck('name') as $skills) {

                }

                if($user->created_by != null){
                    $creator = User::find($user->created_by)->name;
                    $user->created_by = $creator;
                }

                $skills = $user->skills;
                $teamName = $user->team->name;
                $roleName = $user->role->name;
                $user->role_name = $roleName;
                $user->team_name = $teamName;
                unset($user->skills);
                $user->skills = $skills->map(function ($skills) {
                    return collect($skills->toArray())
                        ->only(['id', 'name'])
                        ->all();
                });
                $countryName = $user->country()->pluck('name')->first();
                $user->country = $countryName;
                unset($user->country_id);
                unset($user->pivot);
                unset($user->role);
                unset($user->team);
                unset($user->team_id);
                unset($user->role_id);
                unset($user->image_profile);

            }
        }else{
            $users = User::where('active', 1)->paginate(10);
            foreach($users as $user) {
                if(count($user->photos) > 0){
                    foreach ($user->photos->pluck('path') as $photo){
                        $user->photo = $photo;
                    }
                }else{
                    $user->photo = 'nophoto';
                }
                unset($user->photos);
                foreach ($user->skills->pluck('name') as $skills) {

                }

                if($user->created_by != null){
                    $creator = User::find($user->created_by)->name;
                    $user->created_by = $creator;
                }

                $skills = $user->skills;
                $teamName = $user->team->name;
                $roleName = $user->role->name;
                $user->role_name = $roleName;
                $user->team_name = $teamName;
                unset($user->skills);
                $user->skills = $skills->map(function ($skills) {
                    return collect($skills->toArray())
                        ->only(['id', 'name'])
                        ->all();
                });
                $countryName = $user->country()->pluck('name')->first();
                $user->country = $countryName;
                unset($user->country_id);
                unset($user->pivot);
                unset($user->role);
                unset($user->team);
                unset($user->team_id);
                unset($user->role_id);
                unset($user->image_profile);

            }
            return response()->json(['data' => $users, 'state' => 1], 200);
        }

        return $this->showAll($users);

    }
    /**
     *
     * @SWG\Post(
     *      tags={"Auth"},
     *      path="/user/add",
     *      summary="register",
     *      @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="Ahmed",
     *      ),@SWG\Parameter(
     *         name="username",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="ahmed.adel",
     *      ),@SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="admin@domai.com",
     *      ),@SWG\Parameter(
     *         name="phone",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="01278389852",
     *      ),@SWG\Parameter(
     *         name="address",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="537 corniche el nile",
     *      ),@SWG\Parameter(
     *         name="bio",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="User Bio/ Summary",
     *      ),@SWG\Parameter(
     *         name="role_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),@SWG\Parameter(
     *         name="team_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),@SWG\Parameter(
     *         name="country_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),
     *      @SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="123456",
     *      ),
     *     @SWG\Parameter(
     *         name="password_confirmation",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="123456",
     *      ),
     *     @SWG\Parameter(
     *         name="skills",
     *         in="formData",
     *         required=true,
     *          type = "array",
     *      @SWG\Items(
     *                       type="integer",
     *              ),
     *      ),
     *      @SWG\Response(response=200, description="user"),
     * )
     */
    public function addNew(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
            'team_id' => 'required',
            'country_id' => 'required|exists:countries,id',
        ]);


        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'bio' => $request->bio,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'country_id' => $request->country_id,
            'team_id' => $request->team_id,
        ]);

        $user->skills()->attach($request->skills);


        return response()->json(['data' => 'User Added successfully', 'state'=>'1']);
    }
    /**
     *
     * @SWG\Post(
     *      tags={"Users"},
     *      path="/update-user-image",
     *      summary="Update user profile with base64 image",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),
     *     @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="base64(image)",
     *      ),
     *      @SWG\Response(response=200, description="imagePath"),
     * )
     */
    public function updatePhoto(Request $request){
        $this->validate($request , [
            'user_id' => 'required',
            'image' => 'required|string',
        ]);
        $user = User::findOrFail($request->user_id);
        $image = $request->image;
        //$image = substr($image, strpos($image, ",")+1);
        $file_name = 'image_'. $user->id . time() . '.jpg'; //generating unique file name;
        $path = public_path('uploads');
        $newImage = base64_decode($image);
        if(count($user->photos) > 0) {
            foreach ($user->photos as $photo){
                if (file_exists($photo->path)) {
                    @unlink($photo->path);
                }
            }
            file_put_contents($path . '/' . $file_name, $newImage);
            $user->photos()->update(['path' => 'uploads/' .$file_name]);
            return response()->json(['data' => 'uploads/' .$file_name, 'state' => 1]);
        }else{
            file_put_contents($path . '/' . $file_name, $newImage);
            $user->photos()->create(['path' => 'uploads/' .$file_name]);
            return response()->json(['data' => 'uploads/' .$file_name, 'state' => 1]);
        }

    }
    /**
     *
     * @SWG\Post(
     *      tags={"Auth"},
     *      path="/change-password",
     *      summary="change-password",
     *      @SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="123456",
     *      ),
     *     @SWG\Parameter(
     *         name="newPassword",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="123456",
     *      ),
     *     @SWG\Parameter(
     *         name="newPassword_confirmation",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="123456",
     *      ),
     *      @SWG\Response(response=200, description="success"),
     * )
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [

            'password' => 'required|min:6',
            'newPassword' => 'required|string|min:6|confirmed',
        ]);

        $user_id = $request->user_id;
        $user = User::findOrFail($user_id);
        $curPassword = $request->password;
        $newPassword = $request->newPassword;

        if (Hash::check($curPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();

            return response()->json(["data"=>"Password Updated successfully", "state"=>1]);
        }
        else
        {
            return response()->json(["data"=>"Wrong Password", "state"=>0]);
        }
    }
    /**
     *
     * @SWG\Post(
     *      tags={"Users"},
     *      path="/update-player-id",
     *      summary="Update user player_id",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),
     *     @SWG\Parameter(
     *         name="player_id",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="454f5d4f-d78s7d8-8787dd",
     *      ),
     *      @SWG\Response(response=200, description="updated"),
     * )
     */
    public function updatePlayerId(Request $request){
        $this->validate($request , [
            'user_id' => 'required',
            'player_id' => 'required',
        ]);
        $user =User::findOrFail($request->user_id);

        $user->player_id = $request->player_id;

        $user->save();

        return response()->json(["data"=>"Data Updated Successfully", "state"=>1]);
    }
    /**
     *
     * @SWG\Get(
     *      tags={"Users"},
     *      path="/user-info/{user_id}",
     *      summary="Get full user information",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function userInfo($user){
        $user = User::findOrFail($user);
        if(count($user->photos) > 0){
            foreach ($user->photos->pluck('path') as $photo){
                $user->photo = $photo;
            }
        }else{
            $user->photo = 'nophoto';
        }
        unset($user->photos);
        foreach ($user->skills->pluck('name') as $skills) {

        }

        if($user->created_by != null){
            $creator = User::find($user->created_by)->name;
            $user->created_by = $creator;
        }

        $skills = $user->skills;
        $teamName = $user->team->name;
        $roleName = $user->role->name;
        $user->role_name = $roleName;
        $user->team_name = $teamName;
        unset($user->skills);
        $user->skills = $skills->map(function ($skills) {
            return collect($skills->toArray())
                ->only(['id', 'name'])
                ->all();
        });
        $countryName = $user->country()->pluck('name')->first();
        $user->country = $countryName;
        unset($user->country_id);
        unset($user->pivot);
        unset($user->role);
        unset($user->team);
        unset($user->team_id);
        unset($user->role_id);
        unset($user->image_profile);

        return $this->showOne($user, 200);
    }
    /**
     *
     * @SWG\Post(
     *      tags={"Users"},
     *      path="/update-user",
     *      summary="Update user info",
     *      @SWG\Parameter(
     *         name="user_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),@SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="ahmed adel",
     *      ),@SWG\Parameter(
     *         name="phone",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="01278389852",
     *      ),@SWG\Parameter(
     *         name="address",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="537 corniche el nile",
     *      ),@SWG\Parameter(
     *         name="bio",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="User Bio/ Summary",
     *      ),@SWG\Parameter(
     *         name="role_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),@SWG\Parameter(
     *         name="team_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),@SWG\Parameter(
     *         name="country_id",
     *         in="formData",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),
     *
     *     @SWG\Parameter(
     *         name="skills",
     *         in="formData",
     *         required=true,
     *          type = "array",
     *      @SWG\Items(
     *                       type="integer",
     *              ),
     *      ),
     *      @SWG\Response(response=200, description="user"),
     * )
     */
    public function updateUser(Request $request){
        $this->validate($request, [
            'user_id'=>'required',
            'name'=>'string|required',
            'phone'=>'required|numeric',
            'role_id' => 'required',
            'team_id' => 'required',
            'country_id' => 'required|exists:countries,id',
        ]);
        $user = User::findOrFail($request->user_id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role_id = $request->role_id;
        $user->bio = $request->bio;
        $user->team_id = $request->team_id;
        $user->country_id = $request->country_id;
        $user->save();

        $user->skills()->sync($request->skills);

        if(count($user->photos) > 0){
            foreach ($user->photos->pluck('path') as $photo){
                $user->photo = $photo;
            }
        }else{
            $user->photo = 'nophoto';
        }
        unset($user->photos);
        foreach ($user->skills->pluck('name') as $skills) {

        }

        if($user->created_by != null){
            $creator = User::find($user->created_by)->name;
            $user->created_by = $creator;
        }

        $skills = $user->skills;
        $teamName = $user->team->name;
        $roleName = $user->role->name;
        $user->role_name = $roleName;
        $user->team_name = $teamName;
        unset($user->skills);
        $user->skills = $skills->map(function ($skills) {
            return collect($skills->toArray())
                ->only(['id', 'name'])
                ->all();
        });

        unset($user->pivot);
        unset($user->role);
        unset($user->team);
        unset($user->team_id);
        unset($user->role_id);
        unset($user->image_profile);

        return $this->showOne($user, 200);
    }
    /**
     *
     * @SWG\Post(
     *      tags={"Users"},
     *      path="/delete-user/{user}",
     *      summary="Update user info",
     *      @SWG\Parameter(
     *         name="user",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *         default="1",
     *      ),@SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="user"),
     * )
     */
    public function deleteAccount(Request $request, User $user)
    {

        $this->validate($request, [
            'password' => 'required',
        ]);

        $curPassword = $request->password;


        if (Hash::check($curPassword, $user->password)) {

            if(count($user->photos) > 0)
            {
                foreach ($user->photos as $photo) {
                    if (file_exists($photo->path)) {
                        @unlink($photo->path);
                    }
                }
            }
            $user->photos()->delete();
            /*
            if(count($user->posts) > 0){
                foreach ($user->posts as $post){
                    foreach ($post->photos as $photo){
                        if (file_exists($photo->path)) {
                            @unlink($photo->path);
                        }
                    }
                    $post->photos()->delete();
                    $post->comments()->delete();
                    $post->likes()->delete();

                    $post->delete();
                }
            }

            Comment::where('user_id', '=', $user->id)->delete();
            Like::where('user_id', '=', $user->id)->delete();
                */
            $user->delete();

            return response()->json(['data'=>'Your account has been deleted', 'state'=>1]);
        }else{
            return response()->json(['data'=>'Wrong password .. please enter your password correctly to confirm', 'state'=>1]);
        }



    }



}
