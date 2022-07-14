<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'menu_categori';

    public function menu()
    {
        return $this->hasMany('App\Models\Menu','tipe', 'id');
    }
}
