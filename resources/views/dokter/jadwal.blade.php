@extends('layouts.dokter')

@section('title', 'Lihat Jadwal Konsultasi')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-calendar-check"></i> Lihat Jadwal Konsultasi</h1>
</div>

<!-- Filter Section -->
<div class="row mb-4">
    <div class="col-md-12">
        <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <form method="GET" action="/dokter/jadwal">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Filter Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jadwal Table -->
<div class="table-container">
    @if($jadwal->count() > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Pasien</th>
                    <th>No. Telepon</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $key => $item)
                <tr>
                    <td>{{ $jadwal->firstItem() + $key }}</td>
                    <td>{{ $item->tanggal->format('d M Y') }}</td>
                    <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                    <td>{{ $item->pasien->nama }}</td>
                    <td>{{ $item->pasien->nomor_telepon ?? '-' }}</td>
                    <td>{{ Str::limit($item->keluhan, 30) }}</td>
                    <td>
                        @if($item->status == 'pending')
                            <span class="badge-schedule badge-pending">Menunggu Konfirmasi</span>
                        @elseif($item->status == 'confirmed')
                            <span class="badge-schedule badge-confirmed">Terkonfirmasi</span>
                        @elseif($item->status == 'completed')
                            <span class="badge-schedule badge-completed">Selesai</span>
                        @else
                            <span class="badge-schedule badge-cancelled">Dibatalkan</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn-action btn-view" onclick="lihatDetail({{ $item->id_jadwal_konsultasi }})">
                            <i class="bi bi-eye"></i> Lihat
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div style="padding: 1rem; display: flex; justify-content: center;">
            {{ $jadwal->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h5>Tidak ada jadwal konsultasi</h5>
            <p>Belum ada jadwal konsultasi yang ditampilkan</p>
        </div>
    @endif
</div>

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Jadwal Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Pasien</label>
                        <p id="detailNama" style="color: #4b5563; font-weight: 500;">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <p id="detailTelepon" style="color: #4b5563; font-weight: 500;">-</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal</label>
                        <p id="detailTanggal" style="color: #4b5563; font-weight: 500;">-</p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Waktu</label>
                        <p id="detailWaktu" style="color: #4b5563; font-weight: 500;">-</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Keluhan</label>
                        <p id="detailKeluhan" style="color: #4b5563; font-weight: 500;">-</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Riwayat Penyakit</label>
                        <p id="detailRiwayat" style="color: #4b5563; font-weight: 500;">Tidak ada data</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Status</label>
                        <p id="detailStatus" style="color: #4b5563; font-weight: 500;">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script>
    function lihatDetail(id) {
        fetch(`/dokter/jadwal/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailNama').textContent = data.pasien.nama;
                document.getElementById('detailTelepon').textContent = data.pasien.nomor_telepon || '-';
                document.getElementById('detailTanggal').textContent = new Date(data.tanggal).toLocaleDateString('id-ID');
                document.getElementById('detailWaktu').textContent = data.jam_mulai + ' - ' + data.jam_selesai;
                document.getElementById('detailKeluhan').textContent = data.keluhan;
                document.getElementById('detailRiwayat').textContent = data.riwayat_penyakit || 'Tidak ada data';
                
                const statusBadge = {
                    'pending': '<span class="badge-schedule badge-pending">Menunggu Konfirmasi</span>',
                    'confirmed': '<span class="badge-schedule badge-confirmed">Terkonfirmasi</span>',
                    'completed': '<span class="badge-schedule badge-completed">Selesai</span>',
                    'cancelled': '<span class="badge-schedule badge-cancelled">Dibatalkan</span>'
                };
                
                document.getElementById('detailStatus').innerHTML = statusBadge[data.status];
                
                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            });
    }
</script>
@endsection
