<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Illuminate\Support\Facades\File;

class PostModel extends Model
{
    use SoftDeletes;
    protected $table = 'post';
    protected $primaryKey = 'post_id';
    protected $guarded = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    // Relasi One to Many dengan Category
    public function category()
    {
        return $this->belongsTo('App\Models\Blog\CategoryModel', 'category_id', 'category_id');
    }

    // Relasi Many to Many dengan Tag (Pivot : post_tag)
    public function tags()
    {
        return $this->belongsToMany('App\Models\Blog\TagModel', 'post_tag', 'post_id', 'tag_id');
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

    // Menampilkan semua post dengan paginate atau maksimal 10 post
    public static function get_post()
    {
        return PostModel::orderBy('created_at', 'desc')->paginate(10);
    }

    // Menampilkan semua post yang di publish dengan paginate atau maksimal 10 post
    public static function get_post_publish()
    {
        return PostModel::where('publish', 1)->orderBy('created_at', 'desc')->paginate(10);
    }

    // Proses/fungsi membuat post
    public static function create_post($request)
    {
        $post_title = $request['post_title'];
        $post_content = $request['post_content'];
        $post_slug = str_slug($post_title);
        $featured = $request['featured'];
        $category = $request['category_id'];
        $tag = $request['tag'];
        $user = Auth::id();
        $featured_name = time() . $featured->getClientOriginalName();
        $featured->move('images/posts', $featured_name);
        $post = PostModel::create([
            'post_title' => $post_title,
            'post_content' => $post_content,
            'post_slug' => $post_slug,
            'featured' => 'images/posts/' . $featured_name,
            'category_id' => $category,
            'user_id' => $user,
        ]);
        $post->tags()->attach($tag);
    }

    // Mengambil post berdasarkan id
    public static function get_post_id($id)
    {
        return PostModel::find($id);
    }

    // Mengambil post berdasarkan slug
    public static function get_post_slug($slug)
    {
        return PostModel::where('post_slug', $slug)->first();
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

    // Proses atau fungsi edit foto post
    public static function update_featured($featured_name, $id)
    {
        $post = self::get_post_id($id);
        $post->featured = 'images/posts/' . $featured_name;
        $post->save();
    }

    // Proses atau fungsi edit post
    public static function update_post($request, $id)
    {
        $post = self::get_post_id($id);
        $post->post_title = $request['post_title'];
        $post->post_content = $request['post_content'];
        $post->post_slug = str_slug($post->post_title);
        $post->category_id = $request['category_id'];
        $tag = $request['tag'];
        $post->save();
        $post->tags()->sync($tag);
    }

    // Proses atau fungsi hapus/trashed post
    public static function delete_post($id)
    {
        $post = self::get_post_id($id);
        $post->delete();
    }

    // Proses atau fungsi menampilkan trashed post
    public static function trashed_post()
    {
        return PostModel::onlyTrashed()->get();
    }

    // Proses atau fungsi restore post
    public static function restore($id)
    {
        return PostModel::withTrashed()->where('post_id', $id)->restore();
    }

    // Proses atau fungsi hapus post permanen
    public static function killed($id)
    {
        $post = PostModel::onlyTrashed()->where('post_id', $id)->first();
        File::delete($post->featured);
        $post->tags()->detach();
        $post->forceDelete();
    }

    // Membuat post Publish / UnPublish
    public static function draft($id)
    {
        // Default post yang terpublish -> publish == 1
        $post = self::get_post_id($id);
        if ($post->publish == 1) {
            $post->publish = 0;
            $post->save();
            return true;
            // Post menjadi draft
        } else {
            $post->publish = 1;
            $post->save();
            return false;
            // Post menjadi publish
        }
    }

    // Search Post
    public static function search($request)
    {
        $post_title = urlencode($request['search']);
        $post = PostModel::where('post_title', 'like', '%' . $post_title . '%')->paginate(10);
        return $post;
    }
}
