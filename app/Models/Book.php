<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        "category_id",
        "author",
        "year",
        "qty",
        "title"
    ];

}
