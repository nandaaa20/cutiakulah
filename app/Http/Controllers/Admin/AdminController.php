<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $cutis = Cuti::with('user')->latest()->paginate(10);
        return view('admin.dashboard', compact('cutis'));
    }

}
