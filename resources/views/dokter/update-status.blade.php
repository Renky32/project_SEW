@extends('layouts.dokter')

@section('title', 'Update Status Konsultasi')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-arrow-repeat"></i> Update Status Konsultasi</h1>
</div>

<!-- Filter Section -->
<div class="row mb-4">
    <div class="col-md-12">
        <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Cari Konsultasi</label>
                    <input type="text" class="form-control" placeholder="Nama Pasien atau Tanggal Konsultasi" id="searchStatus">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status Saat Ini</label>
                    <select class="form-select" id="filterStatusAwal">
                        <option value="">Semua Status</option>
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="confirmed">Terkonfirmasi</option>
                        <option value="completed">Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-primary w-100" onclick="cariStatus()">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Konsultasi Status Table -->
<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Tanggal Konsultasi</th>
                <th>Status Saat Ini</th>
                <th>Status Baru</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample Data -->
            <tr>
                <td>1</td>
                <td>Budi Santoso</td>
                <td>19 Juni 2026</td>
                <td><span class="badge-schedule badge-pending">Menunggu Konfirmasi</span></td>
                <td>
                    <select class="form-select form-select-sm" id="status1" onchange="statusChanged()">
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="confirmed">Terkonfirmasi</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control form-control-sm" id="keterangan1" rows="2" placeholder="Masukkan keterangan"></textarea>
                </td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="updateStatus(1)">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Siti Nurhaliza</td>
                <td>18 Juni 2026</td>
                <td><span class="badge-schedule badge-confirmed">Terkonfirmasi</span></td>
                <td>
                    <select class="form-select form-select-sm" id="status2" onchange="statusChanged()">
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="confirmed" selected>Terkonfirmasi</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control form-control-sm" id="keterangan2" rows="2" placeholder="Masukkan keterangan"></textarea>
                </td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="updateStatus(2)">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Rinto Harahap</td>
                <td>17 Juni 2026</td>
                <td><span class="badge-schedule badge-confirmed">Terkonfirmasi</span></td>
                <td>
                    <select class="form-select form-select-sm" id="status3" onchange="statusChanged()">
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="confirmed" selected>Terkonfirmasi</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control form-control-sm" id="keterangan3" rows="2" placeholder="Masukkan keterangan"></textarea>
                </td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="updateStatus(3)">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Ani Wijaya</td>
                <td>16 Juni 2026</td>
                <td><span class="badge-schedule badge-completed">Selesai</span></td>
                <td>
                    <select class="form-select form-select-sm" id="status4" onchange="statusChanged()">
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="confirmed">Terkonfirmasi</option>
                        <option value="completed" selected>Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control form-control-sm" id="keterangan4" rows="2" placeholder="Masukkan keterangan"></textarea>
                </td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="updateStatus(4)">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Tono Prasetyo</td>
                <td>15 Juni 2026</td>
                <td><span class="badge-schedule badge-confirmed">Terkonfirmasi</span></td>
                <td>
                    <select class="form-select form-select-sm" id="status5" onchange="statusChanged()">
                        <option value="pending">Menunggu Konfirmasi</option>
                        <option value="confirmed" selected>Terkonfirmasi</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </td>
                <td>
                    <textarea class="form-control form-control-sm" id="keterangan5" rows="2" placeholder="Masukkan keterangan"></textarea>
                </td>
                <td>
                    <button class="btn btn-sm btn-success" onclick="updateStatus(5)">
                        <i class="bi bi-check-lg"></i> Update
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- History Log -->
<div class="row mt-4">
    <div class="col-md-12">
        <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <h5 style="color: #1f2937; margin-bottom: 1rem; font-weight: 600;">
                <i class="bi bi-clock-history"></i> Riwayat Perubahan Status
            </h5>
            
            <div style="max-height: 300px; overflow-y: auto;">
                <div class="timeline-item" style="padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                    <div style="display: flex; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <span style="display: inline-flex; width: 30px; height: 30px; background: #dbeafe; color: #0c4a6e; border-radius: 50%; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem;">
                                ✓
                            </span>
                        </div>
                        <div style="flex-grow: 1;">
                            <p style="margin: 0; color: #1f2937; font-weight: 500;">Siti Nurhaliza</p>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Status diubah dari Menunggu Konfirmasi menjadi Terkonfirmasi</p>
                            <p style="margin: 0; color: #9ca3af; font-size: 0.85rem;">20 Juni 2026, 12:30</p>
                        </div>
                    </div>
                </div>

                <div class="timeline-item" style="padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                    <div style="display: flex; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <span style="display: inline-flex; width: 30px; height: 30px; background: #dcfce7; color: #15803d; border-radius: 50%; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem;">
                                ✓
                            </span>
                        </div>
                        <div style="flex-grow: 1;">
                            <p style="margin: 0; color: #1f2937; font-weight: 500;">Ani Wijaya</p>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Status diubah dari Terkonfirmasi menjadi Selesai</p>
                            <p style="margin: 0; color: #9ca3af; font-size: 0.85rem;">19 Juni 2026, 14:15</p>
                        </div>
                    </div>
                </div>

                <div class="timeline-item" style="padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                    <div style="display: flex; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <span style="display: inline-flex; width: 30px; height: 30px; background: #fee2e2; color: #991b1b; border-radius: 50%; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem;">
                                ✗
                            </span>
                        </div>
                        <div style="flex-grow: 1;">
                            <p style="margin: 0; color: #1f2937; font-weight: 500;">Tono Prasetyo</p>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Status diubah dari Terkonfirmasi menjadi Dibatalkan</p>
                            <p style="margin: 0; color: #9ca3af; font-size: 0.85rem;">Alasan: Pasien tidak hadir - 18 Juni 2026, 09:00</p>
                        </div>
                    </div>
                </div>

                <div class="timeline-item" style="padding-bottom: 0;">
                    <div style="display: flex; gap: 1rem;">
                        <div style="flex-shrink: 0;">
                            <span style="display: inline-flex; width: 30px; height: 30px; background: #dbeafe; color: #0c4a6e; border-radius: 50%; align-items: center; justify-content: center; font-weight: 600; font-size: 0.8rem;">
                                ✓
                            </span>
                        </div>
                        <div style="flex-grow: 1;">
                            <p style="margin: 0; color: #1f2937; font-weight: 500;">Rinto Harahap</p>
                            <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">Status diubah dari Menunggu Konfirmasi menjadi Terkonfirmasi</p>
                            <p style="margin: 0; color: #9ca3af; font-size: 0.85rem;">17 Juni 2026, 10:45</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script>
    const statusData = {
        1: { nama: 'Budi Santoso', statusAwal: 'pending', statusBaru: 'pending' },
        2: { nama: 'Siti Nurhaliza', statusAwal: 'confirmed', statusBaru: 'confirmed' },
        3: { nama: 'Rinto Harahap', statusAwal: 'confirmed', statusBaru: 'confirmed' },
        4: { nama: 'Ani Wijaya', statusAwal: 'completed', statusBaru: 'completed' },
        5: { nama: 'Tono Prasetyo', statusAwal: 'confirmed', statusBaru: 'confirmed' }
    };

    const statusLabel = {
        'pending': 'Menunggu Konfirmasi',
        'confirmed': 'Terkonfirmasi',
        'completed': 'Selesai',
        'cancelled': 'Dibatalkan'
    };

    function statusChanged() {
        console.log('Status berubah');
    }

    function updateStatus(id) {
        const status = document.getElementById('status' + id).value;
        const keterangan = document.getElementById('keterangan' + id).value;
        const data = statusData[id];

        if (status === data.statusAwal && !keterangan) {
            alert('Silakan ubah status atau tambahkan keterangan');
            return;
        }

        const statusBaru = statusLabel[status];
        
        if (confirm(`Update status ${data.nama} menjadi ${statusBaru}?\n\nKeterangan: ${keterangan || '(Tidak ada)'}`)) {
            alert(`Status untuk ${data.nama} berhasil diperbarui menjadi ${statusBaru}`);
            document.getElementById('keterangan' + id).value = '';
        }
    }

    function cariStatus() {
        const search = document.getElementById('searchStatus').value;
        const filter = document.getElementById('filterStatusAwal').value;
        
        if (!search && !filter) {
            alert('Silakan masukkan kriteria pencarian');
            return;
        }
        
        alert(`Mencari konsultasi dengan kriteria:\nNama: ${search || 'Semua'}\nStatus: ${filter || 'Semua'}`);
    }
</script>
@endsection
