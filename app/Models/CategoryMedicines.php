<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMedicines extends Model
{
    use HasFactory;
    protected $table = 'category_medicines';
    protected $filltable = [
        "parent_id",
        "category_name",
        "content",
        "image"
    ];
}
