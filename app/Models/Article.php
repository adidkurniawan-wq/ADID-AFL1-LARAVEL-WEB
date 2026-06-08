<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambah baris ini
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory; // Tambah baris ini

    protected $fillable = ['category_id', 'title', 'slug', 'content'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
