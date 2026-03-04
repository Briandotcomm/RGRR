<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        // Personal info
        'first_name',
        'surname',
        'middle_initial',
        'name',
        'email',
        'home_address',

        // School info
        'school_name',
        'year_level',
        'school_year',
        'required_hours',

        // Uploaded documents
        'moa_path',
        'school_id_path',

        // Account control
        'role',
        'status',
        'approved_at',

        // Auth
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'approved_at'       => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /* -------------------------------------------------------
       RELATIONSHIPS
    ------------------------------------------------------- */

    // A user has one payment record
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /* -------------------------------------------------------
       HELPER METHODS
    ------------------------------------------------------- */

    // Full name helper
    public function getFullNameAttribute(): string
    {
        $mi = $this->middle_initial ? ' ' . $this->middle_initial . '.' : '';
        return $this->first_name . $mi . ' ' . $this->surname;
    }

    // Check if user is admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Check if user is approved member
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    // Check if user is pending
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    // Avatar initials color based on name
    public function getAvatarColorAttribute(): string
    {
        $colors = [
            'linear-gradient(135deg,#2563eb,#1d4ed8)',
            'linear-gradient(135deg,#c8290a,#991b1b)',
            'linear-gradient(135deg,#10b981,#065f46)',
            'linear-gradient(135deg,#f5a623,#b45309)',
            'linear-gradient(135deg,#8b5cf6,#6d28d9)',
        ];
        return $colors[ord($this->first_name[0]) % count($colors)];
    }
}