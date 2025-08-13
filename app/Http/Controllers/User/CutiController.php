<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cuti;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class CutiController extends Controller
{
    public function index()
    {
        $cutis = Cuti::where('user_id', Auth::id())->latest()->get();
        return view('user.cuti.index', compact('cutis'));
    }

    public function create()
    {
        $user = auth()->user();
        $MAX_CUTI = 12;

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
            'status' => 'pending', 
        ]);

        return redirect()->route('user.dashboard')
             ->with('success', 'Pengajuan cuti berhasil dikirim');
    }
    
        public function show($id)
    {
        $cuti = Cuti::where('user_id', Auth::id())->with('user')->findOrFail($id);
        return view('user.cuti.show', compact('cuti'));
    }

    public function cetak($id)
    {
        $cuti = Cuti::with('user')->findOrFail($id);

        if ($cuti->user_id !== auth()->id()) {
            abort(403, 'Kamu tidak punya akses ke data ini.');
        }

        $pdf = Pdf::loadView('user.cuti.pdf', compact('cuti'));
        return $pdf->download('cuti-detail.pdf');
    }
}
