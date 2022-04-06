<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decentralizations extends Model
{
    use HasFactory;
    protected $table = 'decentralizations';
    protected $filltable = [
        "user_id",
        "authorization_id",
    ];
}
