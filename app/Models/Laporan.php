<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Laporan extends Model
{
    use HasFactory;
    protected $fillable = [
        'pelapor',
        'pekerja',
        'laporan',
        'jenis_aduans_id',
        'foto',
        'status'
    ];

    public function userPelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor');
    }
    public function userPekerja(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pekerja');
    }

    public function jenisAduan(): BelongsTo
    {
        return $this->belongsTo(JenisAduan::class, 'jenis_aduans_id');
    }
}
