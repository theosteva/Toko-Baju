<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'image2',
        'image3',
        'image4',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
