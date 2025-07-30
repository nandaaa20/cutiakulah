use App\Mail\CutiStatusNotification;
use Illuminate\Support\Facades\Mail;

public function updateStatus(Request $request, $id)
{
    $cuti = Cuti::findOrFail($id); // Sesuaikan nama model jika berbeda
    $cuti->status = $request->status; // 'disetujui' atau 'ditolak'
    $cuti->catatan = $request->catatan;
    $cuti->save();

    // Kirim email notifikasi
    Mail::to($cuti->user->email)->send(new CutiStatusNotification(
        $cuti->user,
        $cuti->status,
        $cuti->catatan
    ));

    return redirect()->back()->with('success', 'Status cuti diperbarui dan email telah dikirim.');
}
