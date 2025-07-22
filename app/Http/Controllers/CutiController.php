<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function create()
    {
        return view('user.cuti.create');
    }

    public function index()
    {
        $cutis = Cuti::where('user_id', auth()->id())->latest()->get();
        return view('user.cuti.index', compact('cutis'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);


        Cuti::create([
            'user_id' => Auth::id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_akhir' => $request->tanggal_akhir,
            'alasan' => $request->alasan,
            'status' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Pengajuan cuti berhasil dikirim.');
    }

}
