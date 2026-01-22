<!DOCTYPE html>
<html>
<head>
    <title>Audit Log Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #343a40; color: white; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN AUDIT LOG SISTEM</h2>
        <p>Dicetak pada: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Waktu</th>
                <th>User</th>
                <th>Aktivitas</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $log->user->nama ?? 'System' }}</td>
                <td>{{ $log->aktivitas }}</td>
                <td>{{ $log->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>