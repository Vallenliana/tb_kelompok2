<x-jamaah-layout>
    <div class="container-fluid px-4 py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 mb-0">Daftar Paket Umroh</h2>
        </div>

        <div class="row g-4">
            @forelse($tickets as $ticket)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ticket->package }}</h5>
                            <p class="card-text text-muted mb-3">
                                Keberangkatan: {{ $ticket->departure_date->format('d M Y') }}
                            </p>
                            <h4 class="text-primary mb-4">
                                Rp {{ number_format($ticket->price, 0, ',', '.') }}
                            </h4>
                            <a href="{{ route('jamaah.bookings.create') }}" class="btn btn-primary">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada paket umroh tersedia
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-jamaah-layout> 