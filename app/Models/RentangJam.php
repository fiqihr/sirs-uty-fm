<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentangJam extends Model
{
    use HasFactory;
    protected $table = 'rentang_jam';
    protected $primaryKey = 'id_rentang_jam';
    protected $guarded = [];
}
