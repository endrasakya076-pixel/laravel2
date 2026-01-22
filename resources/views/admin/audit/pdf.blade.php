<!DOCTYPE html>
<html>
<head>
    <title>Audit Log Report</title>
    <style>
        /* Pengaturan Kertas Landscape */
        @page { size: landscape; margin: 20px; }
        
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 11px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; table-layout: fixed; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; word-wrap: break-word; }
        th { background-color: #f2f2f2; font-weight: bold; text-transform: uppercase; }
        
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; }
        .header p { margin: 5px 0 0; font-style: italic; }
        
        /* Lebar Kolom Spesifik */
        .col-waktu { width: 12%; }
        .col-user { width: 15%; }
        .col-aksi { width: 12%; }
        .col-ket { width: 35%; }
        .col-ip { width: 10%; }
        .col-browser { width: 16%; }

        /* Media Print untuk tombol window.print() */
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN RIWAYAT AKTIVITAS SISTEM (AUDIT LOG)</h2>
        <p>Dicetak pada: {{ $date }} | Oleh: {{ Auth::user()->nama }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-waktu">Waktu (WITA)</th>
                <th class="col-user">User</th>
                <th class="col-aksi">Aktivitas</th>
                <th class="col-ket">Keterangan</th>
                <th class="col-ip">IP Address</th>
                <th class="col-browser">Browser</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                {{-- Format Waktu Indonesia Tengah sesuai log --}}
                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</td>
                <td>
                    <strong>{{ $log->user->nama ?? 'System' }}</strong><br>
                    <small>{{ $log->user->jabatan ?? '-' }}</small>
                </td>
                <td>{{ $log->aktivitas }}</td>
                <td>{{ $log->keterangan }}</td>
                <td><code>{{ $log->ip_address }}</code></td>
                {{-- Menampilkan kolom browser agar laporan lengkap --}}
                <td><small>{{ Str::limit($log->browser, 50) }}</small></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>