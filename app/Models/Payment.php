<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'method',
        'gcash_reference_number',
        'proof_path',
        'status',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    /* -------------------------------------------------------
       RELATIONSHIPS
    ------------------------------------------------------- */

    // Payment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* -------------------------------------------------------
       HELPER METHODS
    ------------------------------------------------------- */

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isGcash(): bool
    {
        return $this->method === 'gcash';
    }
}