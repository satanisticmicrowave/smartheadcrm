<?php

namespace App\Models;

use Database\Factories\TicketFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{

    /** @use HasFactory<TicketFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'customer_id',
        'title',
        'description',
        'status',
        'proceed_at',
    ];

    protected $casts = [
        'proceed_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
