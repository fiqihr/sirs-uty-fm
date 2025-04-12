<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggalRs extends Model
{
    use HasFactory;
    protected $table = 'tanggal_rs';
    protected $primaryKey = 'id_tgl_rs';
    public $incrementing = true;
    protected $guarded = [];

    public function rs()
    {
        return $this->hasMany(RancanganSiar::class, 'id_tgl_rs', 'id_tgl_rs');
    }
}