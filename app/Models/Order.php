<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function booked()
    {
        return $this->hasOne('App\Models\Booked', 'id', 'id_booked');
    }

    public function detail()
    {
        return $this->hasOne('App\Models\OrderDetail','id_order','id_order');
    }
}
