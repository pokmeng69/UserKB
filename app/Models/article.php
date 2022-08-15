<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;
    protected $table = 'article';
    protected $fillable = [
        'id',
        'title_article',
        'content_article',
        'created_at',
        'updated_at',
        'id_cat'
    ];
    public $timestamps = false;
}