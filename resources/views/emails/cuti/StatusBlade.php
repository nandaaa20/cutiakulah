<?php
echo "# Halo, " . htmlspecialchars($user->name) . "\n\n";

echo "Pengajuan cuti Anda telah **{{ $status }}**";
echo "Pengajuan cuti Anda telah <strong>" . htmlspecialchars($status) . "</strong>.<br><br>\n";

if (!empty($catatan)) {
	echo "Catatan:<br>\n";
	echo "&gt; " . nl2br(htmlspecialchars($catatan)) . "<br><br>\n";
}

echo '<a href="' . url('/cuti') . '" style="display:inline-block;padding:10px 20px;background:#3869D4;color:#fff;text-decoration:none;border-radius:4px;">Lihat Pengajuan Cuti</a><br><br>';

echo "Terima kasih,<br>\n";
echo htmlspecialchars(config('app.name')) . "\n";

