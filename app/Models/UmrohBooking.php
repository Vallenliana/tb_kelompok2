<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UmrohBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'umroh_ticket_id',
        'status',
        'total_amount',
        'payment_status',
        'payment_method',
        'payment_proof',
        'paid_at',
        'notes'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(UmrohTicket::class, 'umroh_ticket_id');
    }
}
