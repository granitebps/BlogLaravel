<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    protected $table = 'tag';
    protected $primaryKey = 'tag_id';
    protected $fillable = ['tag_name', 'tag_slug'];

    // Relasi Many to Many dengan Post (Pivot : post_tag)
    public function post()
    {
        return $this->belongsToMany('App\Models\Blog\PostModel', 'post_tag', 'tag_id', 'post_id');
    }
}
