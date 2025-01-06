<?php

namespace App\Http\Controllers;

use App\Models\UmrohTicket;
use Illuminate\Http\Request;

class UmrohTicketController extends Controller
{
    public function index()
    {
        $tickets = UmrohTicket::latest()->get();
        return view('admin.umroh-tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.umroh-tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:50',
            'package' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'departure_date' => 'required|date',
        ]);

        UmrohTicket::create($validated);

        return redirect()
            ->route('admin.umroh-tickets.index')
            ->with('success', 'Data jamaah berhasil ditambahkan');
    }

    public function edit(UmrohTicket $ticket)
    {
        return view('admin.umroh-tickets.edit', compact('ticket'));
    }

    public function update(Request $request, UmrohTicket $ticket)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:50',
            'package' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'departure_date' => 'required|date',
        ]);

        $ticket->update($validated);

        return redirect()
            ->route('admin.umroh-tickets.index')
            ->with('success', 'Data jamaah berhasil diperbarui');
    }

    public function destroy(UmrohTicket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('admin.umroh-tickets.index')
            ->with('success', 'Data jamaah berhasil dihapus');
    }
}
