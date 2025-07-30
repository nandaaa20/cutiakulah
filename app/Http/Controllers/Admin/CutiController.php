<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;

class CutiController extends Controller
{
    public function CutiIndex()
    {
        $cutis = Cuti::with('user')->paginate(10);
        return view('admin.cuti.index', compact('cutis'));
    }

    public function show($id)
    {
        $cuti = Cuti::with('user')->findOrFail($id);
        return view('admin.cuti.show', compact('cuti'));
    }

    public function verifikasi($id, Request $request)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $cuti = Cuti::findOrFail($id);
        $cuti->status = $request->status;
        $cuti->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status cuti diperbarui.');
    }
}

