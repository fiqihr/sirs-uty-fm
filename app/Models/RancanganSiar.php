<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RancanganSiar extends Model
{
    use HasFactory;
    protected $table = 'rancangan_siar';
    protected $primaryKey = 'id_rs';
    protected $guarded = [];

    public function tanggal_rs()
    {
        return $this->belongsTo(TanggalRs::class, 'id_tgl_rs', 'id_tgl_rs');
    }
}