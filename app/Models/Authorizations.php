<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorizations extends Model
{
    use HasFactory;
    protected $table = 'authorizations';
    protected $filltable = [
        "authorizations_name",
    ];
}
