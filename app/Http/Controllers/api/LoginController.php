<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    /**
     *
     * @SWG\Post(
     *      tags={"Auth"},
     *      path="/login",
     *      summary="login",
     *
     *      @SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="email/username",
     *      ),
     *      @SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="123456",
     *      ),
     *      @SWG\Response(response=200, description="user Data"),
     * )
     */

    public function login(Request $request){

        $this->validate($request , [
            'email' => 'required',
            'password' => 'required',
        ]);

        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        if(Auth::attempt([$field => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  str_random(60);
            $user = User::findOrFail($user->id);
            if(count($user->photos) > 0){
                foreach ($user->photos->pluck('path') as $photo){
                    $user->photo = $photo;
                }
            }else{
                $user->photo = 'nophoto';
            }
            unset($user->photos);

            foreach ($user->skills->pluck('name') as $kills){

            }
            $skills = $user->skills;
            unset($user->skills);
            $user->skills = $skills->map(function ( $groups) {
                return collect($groups->toArray())
                    ->only(['id', 'name'])
                    ->all();
            });

            if($user->active == 0){
                return response()->json(['data' => 'Your Account has been deactivated.. please call support for help!!', 'state'=>'0']);
            }else{
                return response()->json(['data' => $user, 'state'=>'1']);
            }

        }
        else{
            $userexist = User::where($field , '=', $request->email)->count();
            if ($userexist > 0) {
                return response()->json(['data' => 'Wrong password for '. $request->email, 'state' => '0'], 200);
            }
            return response()->json(['data'=>'User not found', 'state'=>'0'], 200);
        }

    }

}
