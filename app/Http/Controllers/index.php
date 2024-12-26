public function index()
{
    $umrohTickets = UmrohTicket::all();
    return view('umroh_tickets.index', compact('umrohTickets'));
}
