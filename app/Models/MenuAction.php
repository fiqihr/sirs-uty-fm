<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAction extends Model
{
    use HasFactory;
    protected $table = 'menu_action';
    protected $primaryKey = 'id_menu_action';
    protected $guarded = [];
}
