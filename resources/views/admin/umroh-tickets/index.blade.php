<x-admin-layout>
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0">Daftar Tiket Umroh</h2>
            <a href="{{ route('admin.umroh-tickets.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Tiket
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">No. Passport</th>
                                <th scope="col">Paket</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Tanggal Keberangkatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ticket->name }}</td>
                                    <td>{{ $ticket->passport_number }}</td>
                                    <td>{{ $ticket->package }}</td>
                                    <td>Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                                    <td>{{ $ticket->departure_date->format('d M Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.umroh-tickets.edit', $ticket) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.umroh-tickets.destroy', $ticket) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                                            <p class="text-muted mb-0">Belum ada data tiket umroh</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table th {
            font-weight: 600;
            background: #f8f9fa;
        }
        
        .btn-sm {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</x-admin-layout> 