<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    // contoh method
    public function index()
    {
        $cutis = Cuti::where('user_id', Auth::id())->latest()->get();
        return view('user.cuti.index', compact('cutis'));
    }

    public function create()
    {
        $user = auth()->user();
        $MAX_CUTI = 12;

        // Hitung total hari cuti yang sudah diajukan (pending & disetujui)
        $cutiTerpakai = $user->cutis()
            ->whereIn('status', ['pending', 'disetujui'])
            ->get()
            ->sum(function($cuti) {
                return \Carbon\Carbon::parse($cuti->tanggal_mulai)
                    ->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1;
            });

        $sisaCuti = $MAX_CUTI - $cutiTerpakai;

        return view('user.cuti.create', [
            'sisaCuti' => $sisaCuti,
            'MAX_CUTI' => $MAX_CUTI
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);

        Cuti::create([
            'user_id' => auth()->id(),
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'alasan' => $validated['alasan'],
            'status' => 'pending', // Status default
        ]);

        return redirect()->route('user.dashboard')
             ->with('success', 'Pengajuan cuti berhasil dikirim');
    }
    
        public function show($id)
    {
        $cuti = Cuti::where('user_id', Auth::id())->with('user')->findOrFail($id);
        return view('user.cuti.show', compact('cuti'));
    }
}
