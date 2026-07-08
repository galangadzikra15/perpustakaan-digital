<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">📚 Data Peminjaman Buku</h3>
                    <a href="/dashboard" class="btn btn-light btn-sm">Dashboard</a>
                </div>
            </div>
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>
        <i class="bi bi-journal"></i> Data Peminjaman Buku
    </h2>
    <div>
        <a href="{{ url('/loans/create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Tambah Peminjaman
        </a>
    </div>
</div>
                <!-- Form Export -->
                <div class="card mb-4 border border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">📤 Export Laporan</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" class="row g-3 align-items-end">
                            @csrf
                            <div class="col-md-4">
                                <label for="bulan" class="form-label">Pilih Bulan</label>
                                <input type="month" id="bulan" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <button 
                                    type="submit" 
                                    formaction="{{ url('/loans/export/excel') }}"
                                    name="bulan" 
                                    value=""
                                    class="btn btn-success me-2"
                                >
                                    📊 Export Excel
                                </button>
                                <button 
                                    type="submit" 
                                    formaction="{{ url('/loans/export/pdf') }}"
                                    name="bulan" 
                                    value=""
                                    class="btn btn-danger"
                                >
                                    📄 Export PDF
                                </button>
                            </div>
                        </form>
                    </div>
                    
                </div>

                <!-- Tabel Data Peminjaman -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Anggota</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="loanTable">
                            <tr>
                                <td colspan="7" class="text-center text-muted">Loading data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script untuk mengambil data dari API
        fetch('/api/loans')
            .then(response => response.json())
            .then(data => {
                let html = '';
                data.forEach((loan, index) => {
                    const statusBadge = {
                        'dipinjam': 'warning',
                        'dikembalikan': 'success',
                        'hilang': 'danger',
                        'terlambat': 'dark'
                    };
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${loan.book?.judul || '-'}</td>
                            <td>${loan.member?.nama || '-'}</td>
                            <td>${loan.tanggal_pinjam}</td>
                            <td>${loan.tanggal_kembali || '-'}</td>
                            <td>
                                <span class="badge bg-${statusBadge[loan.status] || 'secondary'}">
                                    ${loan.status || '-'}
                                </span>
                            </td>
                            <td>${loan.catatan || '-'}</td>
                        </tr>
                    `;
                });
                document.getElementById('loanTable').innerHTML = html;
            })
            .catch(() => {
                document.getElementById('loanTable').innerHTML = `
                    <tr><td colspan="7" class="text-center text-danger">Gagal mengambil data</td></tr>
                `;
            });

        // Script untuk mengambil nilai bulan dari input month
        document.querySelectorAll('button[name=bulan]').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const bulanInput = document.getElementById('bulan');
                if (bulanInput.value) {
                    const bulan = bulanInput.value.split('-')[1];
                    this.value = bulan;
                } else {
                    e.preventDefault();
                    alert('Silakan pilih bulan terlebih dahulu!');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>