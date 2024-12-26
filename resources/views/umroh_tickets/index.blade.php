@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Daftar Jamaah Umroh</h1>
            <a href="{{ route('umroh.add') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Jamaah
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>No. Paspor</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th>Keberangkatan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($umrohTickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->passport_number }}</td>
                                <td>{{ $ticket->package }}</td>
                                <td>Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($ticket->departure_date)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('umroh.edit', $ticket->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('umroh.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                                        Belum ada data jamaah umroh.
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

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
@endpush
@endsection