<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // ... atribut fillable lainnya jika ada ...
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

Schema::table('tags', function (Blueprint $table) {
    // Periksa apakah kolom 'name' sudah ada
    if (!Schema::hasColumn('tags', 'name')) {
        $table->string('name');
    }
});
