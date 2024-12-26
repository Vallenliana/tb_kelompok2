public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'passport_number' => 'required|string|max:50',
        'package' => 'required|string|max:100',
        'price' => 'required|integer|min:0',
        'departure_date' => 'required|date',
    ]);

    $umrohTicket = UmrohTicket::findOrFail($id);
    $umrohTicket->update($request->all());

    return redirect()->route('umroh-tickets.index')
                     ->with('success', 'Tiket umroh berhasil diperbarui.');
}
