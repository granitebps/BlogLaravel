<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostModel extends Model
{
    use SoftDeletes;
    protected $table = 'post';
    protected $primaryKey = 'post_id';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    // Relasi Many to Many dengan Tag (Pivot : post_tag)
    public function tags()
    {
        return $this->belongsToMany('App\Models\Blog\TagModel', 'post_tag', 'post_id', 'tag_id');
    }

    // Relasi One To Many dengan User
    public function category()
    {
        return $this->belongsTo('App\Models\Blog\CategoryModel', 'category_id', 'category_id');
    }

    // Relasi One To Many dengan User
    public function user()
    {
        return $this->belongsTo('App\Models\Blog\User', 'user_id', 'id');
    }

    // Relasi One To Many dengan Profile
    public function profile()
    {
        return $this->belongsTo('App\Models\Blog\ProfileModel', 'user_id', 'user_id');
    }

    // Menampilkan semua post yang di publish dengan paginate atau maksimal 10 post
    public static function get_post_publish()
    {
        return PostModel::where('publish', 1)->orderBy('created_at', 'desc')->paginate(10);
    }

    // Mengambil post random
    public static function get_post_random()
    {
        return PostModel::where('publish', 1)->inRandomOrder()->limit(6)->get();
    }

    // Mengambil 3 post featured
    public static function get_post_featured()
    {
        return PostModel::where('publish', 1)->orderBy('created_at', 'desc')->take(3)->get();
    }
}
