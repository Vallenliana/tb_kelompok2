<?php

namespace App\Http\Controllers;

use App\Models\UmrohBooking;
use App\Models\UmrohTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => UmrohBooking::count(),
            'pending_bookings' => UmrohBooking::where('status', 'pending')->count(),
            'confirmed_bookings' => UmrohBooking::where('status', 'confirmed')->count(),
            'total_revenue' => UmrohBooking::where('payment_status', 'paid')->sum('total_amount'),
            'total_jamaah' => User::where('usertype', 'jamaah')->count(),
            'unpaid_bookings' => UmrohBooking::where('payment_status', 'unpaid')->count(),
        ];

        $recent_bookings = UmrohBooking::with(['user', 'ticket'])
            ->latest()
            ->take(5)
            ->get();

        $monthly_bookings = UmrohBooking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings', 'monthly_bookings'));
    }

    public function bookingIndex()
    {
        $bookings = UmrohBooking::with(['user', 'ticket'])
            ->latest()
            ->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function bookingShow(UmrohBooking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function confirmBooking(UmrohBooking $booking)
    {
        $booking->update([
            'status' => 'confirmed'
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Pemesanan berhasil dikonfirmasi');
    }

    public function rejectBooking(UmrohBooking $booking)
    {
        $booking->update([
            'status' => 'cancelled'
        ]);

        return redirect()
            ->route('admin.bookings.index')
            ->with('success', 'Pemesanan berhasil ditolak');
    }

    public function paymentIndex()
    {
        $bookings = UmrohBooking::with(['user', 'ticket'])
            ->whereIn('payment_status', ['paid', 'unpaid'])
            ->latest()
            ->get();

        $stats = [
            'total_revenue' => $bookings->where('payment_status', 'paid')->sum('total_amount'),
            'pending_payments' => $bookings->where('payment_status', 'unpaid')->count(),
            'completed_payments' => $bookings->where('payment_status', 'paid')->count(),
        ];

        return view('admin.payments.index', compact('bookings', 'stats'));
    }

    public function verifyPayment(UmrohBooking $booking)
    {
        $booking->update([
            'payment_status' => 'paid',
            'status' => 'confirmed'
        ]);

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil diverifikasi');
    }

    public function profile()
    {
        return view('admin.profile', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password berhasil diperbarui');
    }
}
