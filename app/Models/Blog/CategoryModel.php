<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Blog\PostModel;
use Illuminate\Support\Facades\File;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    protected $fillable = ['category_name', 'category_slug'];

    // Relasi One To Many dengan Post
    public function post()
    {
        return $this->hasMany('App\Models\PostModel', 'category_id', 'category_id');
    }

    // Menampilkan semua category
    public static function get_category()
    {
        return CategoryModel::all();
    }

    // Proses membuat category
    public static function create_category($request)
    {
        $category_name = $request['category_name'];
        $category_slug = str_slug($category_name);
        CategoryModel::create([
            'category_name' => $category_name,
            'category_slug' => $category_slug
        ]);
    }

    // Menampilkan category berdasarkan id
    public static function get_category_id($id)
    {
        return CategoryModel::find($id);
    }

    // Menampilkan category berdasarkan slug
    public static function get_category_slug($slug)
    {
        return CategoryModel::where('category_slug', $slug)->first();
    }

    // Proses update category
    public static function update_category($request, $id)
    {
        $category = self::get_category_id($id);
        $category_name = $request['category_name'];
        $category_slug = str_slug($category_name);
        $category->update([
            'category_name' => $category_name,
            'category_slug' => $category_slug
        ]);
    }

    // Proses hapus category
    public static function delete_category($id)
    {
        $category = self::get_category_id($id);
        foreach ($category->post as $row) {
            $post = PostModel::where('category_id', $id)->first();
            $post->tags()->detach();
            File::delete($row->featured);
            $row->forceDelete();
        }
        $category->delete();
    }
}
