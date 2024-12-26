<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jamaah Umroh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Jamaah Umroh</h1>

        <!-- Tombol Tambah Data -->
        <a href="{{ route('umroh-tickets.create') }}" class="btn btn-primary mb-3">Tambah Jamaah</a>

        <!-- Tabel Data -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Keberangkatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($umrohTickets as $ticket)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ticket->nama }}</td>
                        <td>{{ $ticket->alamat }}</td>
                        <td>{{ $ticket->telepon }}</td>
                        <td>{{ $ticket->tanggal_keberangkatan }}</td>
                        <td>
                            <a href="{{ route('umroh-tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('umroh-tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data jamaah umroh.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
