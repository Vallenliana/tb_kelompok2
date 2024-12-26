<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmrohTicket extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi melalui mass assignment
    protected $fillable = ['nama', 'alamat', 'telepon', 'tanggal_keberangkatan'];
}
