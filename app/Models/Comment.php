<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambah baris ini
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory; // Tambah baris ini

    protected $fillable = ['article_id', 'body'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
