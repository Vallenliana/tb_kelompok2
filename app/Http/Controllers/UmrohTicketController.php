<?php

namespace App\Http\Controllers;

use App\Models\UmrohTicket; // Pastikan model ini sudah dibuat
use Illuminate\Http\Request;

class UmrohTicketController extends Controller
{
    // Menampilkan daftar semua tiket umroh
    public function index()
    {
        $umrohTickets = UmrohTicket::all();
        return view('umroh_tickets.index', compact('umrohTickets'));
    }

    public function add()
    {
        return view("umroh_tickets.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'passport_number' => 'required',
            'package' => 'required',
            'price' => 'required|numeric',
            'departure_date' => 'required|date',
        ], [
            'name.required' => 'Nama Produk dibutuhkan',
            'name.min' => 'Minimal 3 karakter',
            'name.max' => 'Maksimal 150 karakter',
            'passport_number.required' => "Nomor passport dibutuhkan",
            'package.required' => "Paket dibutuhkan",
            'price.required' => "Harga dibutuhkan",
            'departure_date.required' => "Tanggal keberangkatan dibutuhkan"
        ]);

        try {
            UmrohTicket::create([
                'name' => $validated['name'],
                'passport_number' => $validated['passport_number'],
                'package' => $validated['package'],
                'price' => $validated['price'],
                'departure_date' => $validated['departure_date'],
            ]);

            return redirect()
                ->route('umroh.index')
                ->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit(Request $request)
    {
        $ticket = UmrohTicket::findOrFail($request->id);
        return view('umroh_tickets.edit', compact('ticket'));
    }

    public function edit_put(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'passport_number' => 'required',
            'package' => 'required',
            'price' => 'required|numeric',
            'departure_date' => 'required|date',
        ], [
            'name.required' => 'Nama Produk dibutuhkan',
            'name.min' => 'Minimal 3 karakter',
            'name.max' => 'Maksimal 150 karakter',
            'passport_number.required' => "Nomor passport dibutuhkan",
            'package.required' => "Paket dibutuhkan",
            'price.required' => "Harga dibutuhkan",
            'departure_date.required' => "Tanggal keberangkatan dibutuhkan"
        ]);

        try {
            $ticket = UmrohTicket::findOrFail($request->id);
            $ticket->update([
                'name' => $validated['name'],
                'passport_number' => $validated['passport_number'],
                'package' => $validated['package'],
                'price' => $validated['price'],
                'departure_date' => $validated['departure_date'],
            ]);

            return redirect()
                ->route('umroh.index')
                ->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

    public function delete(Request $request)
    {
        try {
            $ticket = UmrohTicket::findOrFail($request->id);
            $ticket->delete();

            return redirect()
                ->route('umroh.index')
                ->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
