<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $filltable = [
        "date_booking",
        "user_id",
        "receiver",
        "address_booking",
        "total",
    ];
}
