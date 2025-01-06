<x-admin-layout>
    <div class="container-fluid px-4 py-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Tambah Data Jamaah</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.umroh-tickets.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Passport</label>
                        <input type="text" name="passport_number" class="form-control" value="{{ old('passport_number') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Paket Umroh</label>
                        <input type="text" name="package" class="form-control" value="{{ old('package') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Keberangkatan</label>
                        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date') }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.umroh-tickets.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout> 