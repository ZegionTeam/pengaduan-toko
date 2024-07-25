<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Toko extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'villages_id',
        'alamat'
    ];


    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class, 'villages_id');
    }
}
