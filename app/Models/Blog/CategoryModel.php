<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = ['category_name', 'category_slug'];

    // Relasi One To Many dengan Post
    public function post()
    {
        return $this->hasMany('App\Models\Blog\PostModel', 'category_id', 'category_id');
    }
}
