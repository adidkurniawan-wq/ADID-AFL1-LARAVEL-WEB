<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambah baris ini
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory; // Tambah baris ini

    protected $fillable = ['name', 'slug'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
