<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotMemo extends Model
{
    use HasFactory;
    protected $table = 'pivot_memo';
    protected $primaryKey = 'id_pivot_memo';
    protected $guarded = [];

    public function memo()
    {
        return $this->belongsTo(Memo::class, 'id_memo', 'id_memo');
    }
}
