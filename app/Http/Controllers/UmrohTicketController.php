<?php

namespace App\Http\Controllers;

use App\Models\UmrohTicket; // Pastikan model ini sudah dibuat
use Illuminate\Http\Request;

class UmrohTicketController extends Controller
{
    // Menampilkan daftar semua tiket umroh
    public function index()
    {
        $umrohTickets = UmrohTicket::all(); // Ambil semua data jamaah umroh dari database
        return view('umroh_tickets.index', compact('umrohTickets'));
    }

    // Metode lain seperti create, store, edit, update, destroy juga ada di sini
}
