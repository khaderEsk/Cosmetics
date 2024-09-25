<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    use GeneralTrait;



    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $token = JWTAuth::attempt($credentials);

        $exist = User::where('email', $request->email)->first();
        if ($exist && !$token)
            return $this->returnError(401, __('backend.The password is wrong', [], app()->getLocale()));

        if (!$token)
            return $this->returnError(401, __('backend.Account Not found', [], app()->getLocale()));

        if (isset($exist->block))
            return $this->returnError(401, __('backend.You are block', [], app()->getLocale()));

        $user = auth()->user();
        $user->token = $token;
        $user->loadMissing(['roles']);

        return $this->returnData($user, __('backend.operation completed successfully', [], app()->getLocale()));
    }



    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'firstName'           => $request->firstName,
            'lastName'          => $request->lastName,
            'email'       => $request->email,
            'password'        => $request->password,
            'phone'    => $request->phone,
            'point' => 0
        ]);

        $credentials = ['email' => $user->email, 'password' => $request->password];
        $token = JWTAuth::attempt($credentials);
        $user->token = $token;

        $role = Role::where('id', '=', 1)->first();
        if (!$role)
            return $this->returnError(404, 'Role Not found');
        $user->assignRole($role);
        // $user->loadMissing(['roles']);
        if (!$token)
            return $this->returnError(401, 'Unauthorized');
        return $this->returnData($user, __('backend.operation completed successfully', [], app()->getLocale()));
    }


    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate();
                return $this->returnSuccessMessage("Logged out successfully", "200");
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return $this->returnError($e->getCode(), 'some thing went wrongs');
            }
        } else {
            return $this->returnError("400", 'some thing went wrongs');
        }
    }
}
