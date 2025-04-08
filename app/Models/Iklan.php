<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    use HasFactory;
    protected $table = 'iklan';
    protected $primaryKey = 'id_iklan';
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id_client');
    }
}
