<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    use HasFactory;
    protected $table = 'traffic';
    protected $primaryKey = 'id_traffic';
    protected $guarded = [];
}