<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function hehe()
    {
        return $this->hasOne('App\Models\Order','id_order','id_order');
    }
}
