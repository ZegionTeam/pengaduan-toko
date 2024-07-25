<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUpLaporan extends Model
{
    use HasFactory;
    protected $fillable = [
        'laporans_id',
        'before',
        'after',
        'note'
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'laporans_id');
    }
}
