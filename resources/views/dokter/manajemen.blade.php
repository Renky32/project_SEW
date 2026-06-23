@extends('layouts.dokter')

@section('title', 'Manajemen Konsultasi')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-clipboard-list"></i> Manajemen Konsultasi</h1>
</div>

<!-- Action Buttons -->
<div class="row mb-4">
    <div class="col-md-12">
        <button class="btn btn-primary" onclick="tambahKonsultasi()">
            <i class="bi bi-plus-lg"></i> Tambah Konsultasi
        </button>
        <button class="btn btn-secondary" onclick="exportData()">
            <i class="bi bi-download"></i> Export
        </button>
    </div>
</div>

<!-- Search & Filter -->
<div class="row mb-4">
    <div class="col-md-12">
        <div style="background: white; padding: 1.5rem; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Cari Pasien</label>
                    <input type="text" class="form-control" placeholder="Nama atau No. Telepon Pasien" id="searchPasien">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Diagnosis</label>
                    <select class="form-select" id="filterDiagnosis">
                        <option value="">Semua Diagnosis</option>
                        <option value="flu">Flu</option>
                        <option value="hipertensi">Hipertensi</option>
                        <option value="asma">Asma</option>
                        <option value="dermatitis">Dermatitis</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-primary w-100" onclick="cariKonsultasi()">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Konsultasi Table -->
<div class="table-container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Tanggal Konsultasi</th>
                <th>Diagnosis</th>
                <th>Resep</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample Data -->
            <tr>
                <td>1</td>
                <td>Budi Santoso</td>
                <td>19 Juni 2026</td>
                <td>Migrain</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="lihatResep(1)">
                        <i class="bi bi-prescription"></i> Lihat
                    </button>
                </td>
                <td><small>Istirahat cukup, hindari stress</small></td>
                <td>
                    <a href="#" class="btn-action btn-edit" onclick="editKonsultasi(1)">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="#" class="btn-action btn-delete" onclick="hapusKonsultasi(1)">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Siti Nurhaliza</td>
                <td>18 Juni 2026</td>
                <td>Demam Berdarah</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="lihatResep(2)">
                        <i class="bi bi-prescription"></i> Lihat
                    </button>
                </td>
                <td><small>Minum banyak air, istirahat total</small></td>
                <td>
                    <a href="#" class="btn-action btn-edit" onclick="editKonsultasi(2)">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="#" class="btn-action btn-delete" onclick="hapusKonsultasi(2)">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Rinto Harahap</td>
                <td>17 Juni 2026</td>
                <td>Asma</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="lihatResep(3)">
                        <i class="bi bi-prescription"></i> Lihat
                    </button>
                </td>
                <td><small>Gunakan inhaler secara teratur</small></td>
                <td>
                    <a href="#" class="btn-action btn-edit" onclick="editKonsultasi(3)">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="#" class="btn-action btn-delete" onclick="hapusKonsultasi(3)">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Ani Wijaya</td>
                <td>16 Juni 2026</td>
                <td>Hipertensi</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="lihatResep(4)">
                        <i class="bi bi-prescription"></i> Lihat
                    </button>
                </td>
                <td><small>Kurangi asupan garam, olahraga rutin</small></td>
                <td>
                    <a href="#" class="btn-action btn-edit" onclick="editKonsultasi(4)">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="#" class="btn-action btn-delete" onclick="hapusKonsultasi(4)">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>Tono Prasetyo</td>
                <td>15 Juni 2026</td>
                <td>Dermatitis</td>
                <td>
                    <button class="btn btn-sm btn-outline-primary" onclick="lihatResep(5)">
                        <i class="bi bi-prescription"></i> Lihat
                    </button>
                </td>
                <td><small>Oleskan salep, hindari alergen</small></td>
                <td>
                    <a href="#" class="btn-action btn-edit" onclick="editKonsultasi(5)">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="#" class="btn-action btn-delete" onclick="hapusKonsultasi(5)">
                        <i class="bi bi-trash"></i> Hapus
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Form Modal Tambah/Edit -->
<div class="modal fade" id="konsultasiModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="konsultasiForm" onsubmit="simpanKonsultasi(event)">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Pasien</label>
                        <select class="form-select" id="namaPasien" required>
                            <option value="">-- Pilih Pasien --</option>
                            <option value="Budi Santoso">Budi Santoso</option>
                            <option value="Siti Nurhaliza">Siti Nurhaliza</option>
                            <option value="Rinto Harahap">Rinto Harahap</option>
                            <option value="Ani Wijaya">Ani Wijaya</option>
                            <option value="Tono Prasetyo">Tono Prasetyo</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Konsultasi</label>
                                <input type="date" class="form-control" id="tanggalKonsultasi" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Diagnosis</label>
                                <input type="text" class="form-control" id="diagnosis" placeholder="Contoh: Migrain" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Resep Obat</label>
                        <textarea class="form-control" id="resep" rows="3" placeholder="Masukkan resep obat" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan / Rekomendasi</label>
                        <textarea class="form-control" id="catatan" rows="3" placeholder="Masukkan catatan untuk pasien" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Resep Modal -->
<div class="modal fade" id="resepModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resep Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Pasien</label>
                    <p id="resepNama" style="color: #4b5563; font-weight: 500;">-</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Diagnosis</label>
                    <p id="resepDiagnosis" style="color: #4b5563; font-weight: 500;">-</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Resep Obat</label>
                    <div style="background: #f3f4f6; padding: 1rem; border-radius: 0.5rem;">
                        <p id="resepIsi" style="color: #4b5563; white-space: pre-wrap; margin: 0;">-</p>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Resep</label>
                    <p id="resepTanggal" style="color: #4b5563; font-weight: 500;">-</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="printResep()">
                    <i class="bi bi-printer"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extra-scripts')
<script>
    const konsultasiData = {
        1: {
            nama: 'Budi Santoso',
            tanggal: '2026-06-19',
            diagnosis: 'Migrain',
            resep: 'Paracetamol 500mg - 2x1 tablet sehari\nIbuprofen 200mg - 1x1 tablet jika diperlukan',
            catatan: 'Istirahat cukup, hindari stress'
        },
        2: {
            nama: 'Siti Nurhaliza',
            tanggal: '2026-06-18',
            diagnosis: 'Demam Berdarah',
            resep: 'Parasetamol 500mg - 3x1 tablet sehari\nParacetamol forte 500mg - jika demam tinggi',
            catatan: 'Minum banyak air, istirahat total'
        },
        3: {
            nama: 'Rinto Harahap',
            tanggal: '2026-06-17',
            diagnosis: 'Asma',
            resep: 'Salbutamol inhaler - 2-4x sehari\nFluticasone inhaler - 2x1 kali sehari',
            catatan: 'Gunakan inhaler secara teratur'
        },
        4: {
            nama: 'Ani Wijaya',
            tanggal: '2026-06-16',
            diagnosis: 'Hipertensi',
            resep: 'Lisinopril 10mg - 1x1 tablet pagi\nAmlodipin 5mg - 1x1 tablet malam',
            catatan: 'Kurangi asupan garam, olahraga rutin'
        },
        5: {
            nama: 'Tono Prasetyo',
            tanggal: '2026-06-15',
            diagnosis: 'Dermatitis',
            resep: 'Krim hidrokortison 2.5% - oleskan 2x sehari\nLoratadin tablet - 1x1 setiap malam',
            catatan: 'Oleskan salep, hindari alergen'
        }
    };

    function tambahKonsultasi() {
        document.getElementById('modalTitle').textContent = 'Tambah Konsultasi';
        document.getElementById('konsultasiForm').reset();
        const modal = new bootstrap.Modal(document.getElementById('konsultasiModal'));
        modal.show();
    }

    function editKonsultasi(id) {
        const data = konsultasiData[id];
        if (data) {
            document.getElementById('modalTitle').textContent = 'Edit Konsultasi';
            document.getElementById('namaPasien').value = data.nama;
            document.getElementById('tanggalKonsultasi').value = data.tanggal;
            document.getElementById('diagnosis').value = data.diagnosis;
            document.getElementById('resep').value = data.resep;
            document.getElementById('catatan').value = data.catatan;
            
            const modal = new bootstrap.Modal(document.getElementById('konsultasiModal'));
            modal.show();
        }
    }

    function lihatResep(id) {
        const data = konsultasiData[id];
        if (data) {
            document.getElementById('resepNama').textContent = data.nama;
            document.getElementById('resepDiagnosis').textContent = data.diagnosis;
            document.getElementById('resepIsi').textContent = data.resep;
            document.getElementById('resepTanggal').textContent = new Date(data.tanggal).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
            
            const modal = new bootstrap.Modal(document.getElementById('resepModal'));
            modal.show();
        }
    }

    function simpanKonsultasi(event) {
        event.preventDefault();
        alert('Data konsultasi berhasil disimpan');
        bootstrap.Modal.getInstance(document.getElementById('konsultasiModal')).hide();
    }

    function hapusKonsultasi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data konsultasi ini?')) {
            alert('Data konsultasi berhasil dihapus');
        }
    }

    function cariKonsultasi() {
        alert('Mencari data konsultasi...');
    }

    function exportData() {
        alert('Mengekspor data ke file Excel...');
    }

    function printResep() {
        alert('Membuka halaman cetak resep...');
        window.print();
    }
</script>
@endsection
