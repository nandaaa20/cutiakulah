<?php

namespace App\Http\Controllers;
use App\Models\Cuti;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $cuti_terakhir = Cuti::where('user_id', auth()->id())->latest()->first();
        return view('user.dashboard', compact('cuti_terakhir'));
    }

}
