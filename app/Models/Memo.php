<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;
    protected $table = 'memo';
    protected $primaryKey = 'id_memo';
    protected $guarded = [];
}