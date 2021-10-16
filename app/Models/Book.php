<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    function borrows()
    {
        return $this->belongsToMany(Borrow::class, 'borrow_detail');
    }
}
