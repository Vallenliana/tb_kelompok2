<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmrohTicket extends Model
{
    use HasFactory;

    protected $table = "umroh_tickets";

    protected $fillable = [
        'name',
        'passport_number',
        'package',
        'description',
        'price',
        'quota',
        'departure_date'
    ];

    protected $casts = [
        'departure_date' => 'date',
        'price' => 'decimal:2'
    ];
}
