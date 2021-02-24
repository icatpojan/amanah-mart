<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Absen;
use App\Model\karyawan;
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
        if ($user->role_id == 5) {
            $User = User::where('id', Auth::id())->first();
            $Member = Member::where('user_id', $user->id)->first();
            return $this->sendResponse('Success', 'ini dia profil anda bos', compact('Member', 'User'), 200);
        } else {
            $user = User::where('id', Auth::user()->id)->first();
            $Karyawan = Karyawan::where('user_id', $user->id)->first();
            $telat = Absen::where('user_id', Auth::id())->where('status', 3)->count();
            $hadir = Absen::where('user_id', Auth::id())->where('status', '!=', 1)->count();
            $alpha = Absen::where('user_id', Auth::id())->where('status', 1)->count();
            $kehadiran = Absen::where('user_id', Auth::id())->whereMonth('tanggal', date('m'))->whereYear('tanggal', date('Y'))->where('status', 3)->get();
            $totalJamTelat = 0;
            foreach ($kehadiran as $present) {
                $totalJamTelat = $totalJamTelat + (\Carbon\Carbon::parse($present->jam_masuk)->diffInHours(\Carbon\Carbon::parse('07:00:00')));
            }
            return $this->sendResponse('Success', 'ini dia profil anda bos', compact('Karyawan', 'User','telat','hadir','alpha','totalJamTelat'), 200);
        }
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', request('email'))->first();
        $user == null ? $user = "anda pengurus" : $user;
        if ($user->role_id == 5) {
            $member = Member::where('user_id', $user->id)->first();
            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return response()->json(compact('token', 'user', 'member'));
        } else {
            $karyawan = karyawan::where('user_id', $user->id)->first();
            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return response()->json(compact('token', 'user', 'karyawan'));
        }
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
