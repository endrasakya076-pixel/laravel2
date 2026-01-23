<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Nama Nasabah</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th class="text-center">Aksi</th> </tr>
        </thead>
        <tbody>
            @foreach($approvals as $approval)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $approval->nasabah_name }}</td>
                <td>Rp {{ number_format($approval->amount, 0, ',', '.') }}</td>
                <td>{{ $approval->keterangan }}</td>
                <td>{{ $approval->status }}</td>

                <td class="text-center">
                    @php
                        $authorizedPositions = [
                            'Supervisor 1', 'Supervisor 2', 'Supervisor 3', 'Supervisor 4', 'Supervisor 5',
                            'Kepala Cabang Gerung', 'Kepala Cabang Pancor', 'Kepala Cabang Tanjung'
                        ];
                        
                        $canAccess = Auth::user()->nama === 'Hendra Sakya Permana' || 
                                     Auth::user()->role === 'admin1' || 
                                     in_array(Auth::user()->jabatan, $authorizedPositions);
                    @endphp

                    @if($canAccess)
                        @if($approval->status == 'Baru Masuk')
                            <div class="btn-group">
                                <form action="{{ route('approvals.hold', $approval->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mr-1 shadow-sm">
                                        <i class="fas fa-check"></i> Setuju
                                    </button>
                                </form>

                                <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning mr-1 shadow-sm">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>

                                <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @else
                            {{-- Jika status bukan 'Baru Masuk', tampilkan statusnya saja --}}
                            <span class="badge badge-info p-2">{{ $approval->status }}</span>
                        @endif
                    @else
                        {{-- Tampilan jika user login bukan pejabat yang berwenang --}}
                        <small class="text-muted font-italic">Menunggu Otorisasi Pejabat</small>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>