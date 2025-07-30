<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $cutis = Cuti::where('user_id', Auth::id())->latest()->get();
        return view('user.dashboard', compact('cutis'));
    }

}
