<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Detail Pengajuan Cuti</title>
    <style>
        @page {
            margin: 100px 50px;
        }

        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 70px;
            text-align: center;
            line-height: 20px;
            border-bottom: 1px solid #aaa;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 50px;
            font-size: 12px;
            text-align: center;
            border-top: 1px solid #aaa;
            line-height: 30px;
        }

        .detail-box {
            padding: 20px;
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .row {
            margin-bottom: 12px;
        }

        .label {
            font-weight: bold;
            width: 160px;
            display: inline-block;
        }

        .status {
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: bold;
            display: inline-block;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-disetujui {
            background-color: #d4edda;
            color: #155724;
        }

        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <h2>HRIS • Sistem Pengajuan Cuti</h2>
        <h2>Jl. Bojonggede, Jakarta - Indonesia</h2>
    </header>

    <!-- FOOTER -->
    <footer>
        Dicetak pada {{ \Carbon\Carbon::now()->format('d M Y, H:i') }} • Halaman <span class="page"></span>
    </footer>

    <!-- CONTENT -->
    <main>
        <h3 style="text-align: center; margin-top: 30px;">Detail Pengajuan Cuti</h3>

        <div class="detail-box">
            <div class="row">
                <span class="label">Nama:</span>
                <span>{{ $cuti->user->name }}</span>
            </div>
            <div class="row">
                <span class="label">Email:</span>
                <span>{{ $cuti->user->email }}</span>
            </div>
            <div class="row">
                <span class="label">Tanggal Mulai:</span>
                <span>{{ $cuti->tanggal_mulai->format('d M Y') }}</span>
            </div>
            <div class="row">
                <span class="label">Tanggal Selesai:</span>
                <span>{{ $cuti->tanggal_selesai->format('d M Y') }}</span>
            </div>
            <div class="row">
                <span class="label">Durasi:</span>
                <span>
                    {{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($cuti->tanggal_selesai)) + 1 }} hari
                </span>
            </div>
            <div class="row">
                <span class="label">Alasan:</span>
                <span>{{ $cuti->alasan }}</span>
            </div>
            <div class="row">
                <span class="label">Status:</span>
                <span>
                    @if ($cuti->status === 'pending')
                        <span class="status status-pending">Menunggu</span>
                    @elseif ($cuti->status === 'disetujui')
                        <span class="status status-disetujui">Disetujui</span>
                    @else
                        <span class="status status-ditolak">Ditolak</span>
                    @endif
                </span>
            </div>
        </div>
    </main>

</body>
</html>
