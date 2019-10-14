<?php

namespace App\Http\Controllers\api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->create($request->all());
        return response()->json(['data' => 'User Added successfully', 'state'=>'1']);


    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required',
        ]);
    }


    public function create(array $data)
    {
        $user =  User::create([
            'name' => $data->name,
            'username' => $data->username,
            'email' => $data->email,
            'phone' => $data->phone,
            'address' => $data->address,
            'bio' => $data->bio,
            'password' => bcrypt($data->password),
            'role_id' => $data->role_id,
            'team_id' => $data->team_id,
        ]);

        $user->skills()->attach($data->skills);

        return $user;
    }
}
