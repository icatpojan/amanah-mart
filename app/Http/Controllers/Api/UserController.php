<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Member;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if (empty($user)) {
            return response('silakan login terlebih dahulu bos');
        }
        return $this->sendResponse('Success', 'ini dia profil anda bos', $user, 200);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', request('email'))->first();
        $user == null ? $user = "anda pengurus" : $user;

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token', 'user'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_id' => $request->get('role_id'),
        ])->sendEmailVerificationNotification();

        return response()->json([
            'status' => 'success',
            'message' => 'silakan verivikasi',
        ]);
    }
    public function register_member(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $User = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role_id' => 5
        ]);

        $User->save();
        $member = Member::create([
            'user_id' => $User->id,
            'member_id' => rand(10, 10000)
        ]);
        $User->sendEmailVerificationNotification();
        return response()->json([
            'status' => 'success',
            'message' => 'silakan verivikasi',
        ]);
    }
    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }
}
