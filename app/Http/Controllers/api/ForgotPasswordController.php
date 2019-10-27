<?php

namespace App\Http\Controllers\api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     *
     * @SWG\Post(
     *      tags={"Auth"},
     *      path="/reset-password",
     *      summary="Forgot password",
     *
     *      @SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *         default="email",
     *      ),
     *      @SWG\Response(response=200, description="success"),
     * )
     */
    public function reset(Request $request)
    {
        $this->validate($request , [
            'email' => 'required|email',
        ]);

        $email = $request->email;

        $user = User::where('email', '=', $email)->limit(1)->get();
        if(count($user) > 0)
        {
            $response = $this->broker()->sendResetLink($request->only(['email']));
            return response()->json(['data' => 'We have sent a reset password link to your email', 'state' => 1]);
        }else{
            return response()->json(['data' => 'No user assigned with this Email', 'state' => 0]);
        }

    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return back()->withErrors(
            ['email' => trans($response)]
        );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
