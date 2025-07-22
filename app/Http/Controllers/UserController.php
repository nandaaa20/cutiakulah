<?php

namespace App\Http\Controllers;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;
// use statements removed because they are not used

class UserController extends Controller
{


    public function index()
    {
        $cutis = Cuti::where('user_id', Auth::id())->latest()->get();
        return view('user.dashboard', compact('cutis'));
    }


}
