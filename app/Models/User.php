<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'name',
        'password',
        'avatar',
        'role',
        'tokos_id'
    ];

    public function getInitialName()
    {
        $name = $this->attributes['name'];
        $words = explode(' ', $name);
        $initial = '';

        foreach ($words as $word) {
            $initial .= strtoupper($word[0]);
        }

        return $initial;
    }

    public function toko(): BelongsTo
    {
        return $this->belongsTo(Toko::class, 'tokos_id');
    }
}
