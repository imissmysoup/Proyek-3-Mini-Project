<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'user_id', 'sekolah_id', 'distribusi_id', 'keluhan',
        'path_bukti', 'status', 'catatan_pemantau',
    ];

    public function sekolah() { return $this->belongsTo(Sekolah::class); }
    public function distribusi() { return $this->belongsTo(Distribusi::class); }
}
