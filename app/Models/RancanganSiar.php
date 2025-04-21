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

    public function iklan()
    {
        return $this->belongsTo(Iklan::class, 'id_iklan', 'id_iklan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_program', 'id_program');
    }

    public function rentangJam()
    {
        return $this->belongsTo(RentangJam::class, 'id_rentang_jam', 'id');
    }

    public function memoPivot()
    {
        return $this->hasMany(PivotMemo::class, 'id_rs', 'id_rs');
    }

    public function menuActionPivot()
    {
        return $this->hasMany(PivotMenuAction::class, 'id_rs', 'id_rs');
    }
}
