<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotMenuAction extends Model
{
    use HasFactory;
    protected $table = 'pivot_menu_action';
    protected $primaryKey = 'id_pivot_menu_action';
    protected $guarded = [];

    public function menu_action()
    {
        return $this->belongsTo(MenuAction::class, 'id_menu_action', 'id_menu_action');
    }
}
