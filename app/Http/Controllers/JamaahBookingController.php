<?php

namespace App\Http\Controllers;

use App\Models\UmrohBooking;
use App\Models\UmrohTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JamaahBookingController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => UmrohBooking::where('user_id', Auth::id())->count(),
            'pending_bookings' => UmrohBooking::where('user_id', Auth::id())
                ->where('status', 'pending')
                ->count(),
            'confirmed_bookings' => UmrohBooking::where('user_id', Auth::id())
                ->where('status', 'confirmed')
                ->count(),
            'total_spent' => UmrohBooking::where('user_id', Auth::id())
                ->where('payment_status', 'paid')
                ->sum('total_amount'),
        ];

        $recent_bookings = UmrohBooking::with(['ticket'])
            ->where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        $available_tickets = UmrohTicket::where('departure_date', '>', now())
            ->latest()
            ->take(5)
            ->get();

        return view('jamaah.dashboard', compact('stats', 'recent_bookings', 'available_tickets'));
    }

    public function packages()
    {
        $tickets = UmrohTicket::where('departure_date', '>', now())
            ->latest()
            ->get();
        return view('jamaah.packages.index', compact('tickets'));
    }

    public function index()
    {
        $bookings = UmrohBooking::where('user_id', Auth::id())
            ->with(['ticket'])
            ->latest()
            ->get();
        return view('jamaah.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $availableTickets = UmrohTicket::where('departure_date', '>', now())
            ->get();
        return view('jamaah.bookings.create', compact('availableTickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'umroh_ticket_id' => 'required|exists:umroh_tickets,id',
            'notes' => 'nullable|string'
        ]);

        $ticket = UmrohTicket::findOrFail($validated['umroh_ticket_id']);

        $booking = UmrohBooking::create([
            'user_id' => Auth::id(),
            'umroh_ticket_id' => $ticket->id,
            'total_amount' => $ticket->price,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('jamaah.bookings.show', $booking)
            ->with('success', 'Pemesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }

    public function show(UmrohBooking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('jamaah.bookings.show', compact('booking'));
    }

    public function cancel(UmrohBooking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'pending') {
            $booking->update(['status' => 'cancelled']);
            return redirect()
                ->route('jamaah.bookings.index')
                ->with('success', 'Pemesanan berhasil dibatalkan.');
        }

        return back()->with('error', 'Pemesanan tidak dapat dibatalkan.');
    }

    public function showPayment(UmrohBooking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->payment_status === 'paid') {
            return redirect()
                ->route('jamaah.bookings.show', $booking)
                ->with('error', 'Pembayaran sudah dilakukan');
        }

        return view('jamaah.bookings.payment', compact('booking'));
    }

    public function submitPayment(Request $request, UmrohBooking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:transfer_bca,transfer_mandiri,transfer_bni',
            'payment_proof' => 'required|image|max:2048'
        ]);

        // Store payment proof
        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        // Update booking
        $booking->update([
            'payment_method' => $validated['payment_method'],
            'payment_proof' => $path,
            'payment_status' => 'paid',
            'paid_at' => now()
        ]);

        return redirect()
            ->route('jamaah.bookings.show', $booking)
            ->with('success', 'Pembayaran berhasil dikonfirmasi. Mohon tunggu verifikasi dari admin.');
    }
}
