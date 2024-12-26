public function destroy($id)
{
    $umrohTicket = UmrohTicket::findOrFail($id);
    $umrohTicket->delete();

    return redirect()->route('umroh-tickets.index')
                     ->with('success', 'Tiket umroh berhasil dihapus.');
}
