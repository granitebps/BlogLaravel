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

    // Menampilkan semua tag
    public static function get_tag()
    {
        return TagModel::all();
    }

    // Proses membuat tag
    public static function create_tag($request)
    {
        $tag_name = $request['tag_name'];
        $tag_slug = str_slug($tag_name);
        TagModel::create([
            'tag_name' => $tag_name,
            'tag_slug' => $tag_slug
        ]);
    }

    // Menampilkan tag berdasarkan id
    public static function get_tag_id($id)
    {
        return TagModel::find($id);
    }

    // Menampilkan tag berdasarkan slug
    public static function get_tag_slug($slug)
    {
        return TagModel::where('tag_slug', $slug)->first();
    }

    // Proses update tag
    public static function update_tag($request, $id)
    {
        $tag = self::get_tag_id($id);
        $tag_name = $request['tag_name'];
        $tag_slug = str_slug($tag_name);
        $tag->update([
            'tag_name' => $tag_name,
            'tag_slug' => $tag_slug
        ]);
    }

    // Proses hapus tag
    public static function delete_tag($id)
    {
        $tag = self::get_tag_id($id);
        $tag->post()->detach();
        $tag->delete();
    }
}
