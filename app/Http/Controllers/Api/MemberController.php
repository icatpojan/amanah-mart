<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $User = User::where('role_id', 5)->with(['member'])->get();
        if ($User == '[]') {
            return $this->sendResponse('Failed', 'data kosong', null, 404);
        }
        return $this->sendResponse('Success', 'ini dia daftar member bos', $User, 200);
    }

}
