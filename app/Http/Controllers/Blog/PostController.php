<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SubsciberEmail;
use App\Models\Blog\CategoryModel;
use App\Models\Blog\EmailModel;
use App\Models\Blog\PostModel;
use App\Models\Blog\TagModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Menampilkan List Post
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            // Search Post
            $data['post'] = PostModel::where('post_title', 'like', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);;
        } else {
            $data['post'] = PostModel::orderBy('created_at', 'desc')->paginate(10);
        }
        $data['title'] = 'Post List';
        return view('admin.post.index')->with($data);
    }

    // Menampilkan halaman membuat post
    public function create()
    {
        $data['category'] = CategoryModel::orderBy('category_name', 'desc')->get();
        $data['tag'] = TagModel::orderBy('tag_name')->get();
        $data['title'] = 'Create Post';
        return view('admin.post.create')->with($data);
    }

    // Proses membuat post
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_title' => 'required|string|max:191',
            'post_content' => 'required',
            'tag' => 'required',
            'category_id' => 'required',
            'featured' => 'required|image|max:2048'
        ]);

        foreach ($request->tag as $index => $item) {
            $tag_slug = str_slug($item);
            $tag = TagModel::firstOrCreate([
                'tag_name' => $item,
                'tag_slug' => $tag_slug
            ]);
            $tag_id[$index] = $tag->tag_id;
        }

        $featured = $request->featured;
        $featured_name = time() . $featured->getClientOriginalName();
        Storage::putFileAs('public/images/posts', $featured, $featured_name);

        $user = auth()->id();
        $post = PostModel::create([
            'post_title' => $request->post_title,
            'post_content' => $request->post_content,
            'post_slug' => str_slug($request->post_title),
            'featured' => $featured_name,
            'category_id' => $request->category_id,
            'user_id' => $user,
        ]);
        $post->tags()->sync($tag_id);

        // $subs = EmailModel::all();
        // foreach ($subs as $key => $value) {
        //     Mail::to($value->email)->send(new SubsciberEmail($post));
        // }

        notify()->success('Post Created');
        return redirect()->route('post.index');
    }

    // Menampilkan halaman edit post
    public function edit($id)
    {
        $data['post'] = PostModel::findOrFail($id);
        $data['tag_all'] = TagModel::all();
        $data['category'] = CategoryModel::all();
        $data['title'] = 'Edit Post';

        return view('admin.post.edit')->with($data);
    }

    // Proses edit post
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'post_title' => 'required',
            'post_content' => 'required',
            'tag' => 'required',
            'featured' => 'image|max:2048'
        ]);
        $post = PostModel::findOrFail($id);
        if ($request->hasFile('featured')) {
            $featured = $request->featured;
            $featured_name = time() . $featured->getClientOriginalName();
            $featured->move('storage/images/posts', $featured_name);
            // $featured->storeAs('public/images/posts', $featured_name);

            // Pada saat update image post, image lama akan terhapus
            File::delete('storage/images/posts/' . $post->featured);
            $post->featured = $featured_name;
            $post->save();
        }
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_slug = str_slug($request->post_title);
        $post->category_id = $request->category_id;

        foreach ($request->tag as $index => $item) {
            $tag_slug = str_slug($item);
            $tag = TagModel::firstOrCreate([
                'tag_name' => $item,
                'tag_slug' => $tag_slug
            ]);
            $tag_id[$index] = $tag->tag_id;
        }

        $post->tags()->sync($tag_id);
        $post->save();

        notify()->success('Post Updated');
        return redirect()->route('post.index');
    }

    // Fungsi hapus/trash post
    public function destroy($id)
    {
        $post = PostModel::findOrFail($id);
        $post->delete();
        notify()->success('Post Trashed');
        return redirect()->route('post.index');
    }

    // Menampilkan trashed post
    public function trashed()
    {
        $data['title'] = 'Trashed Post';
        $data['post'] = PostModel::onlyTrashed()->get();
        return view('admin.post.trashed')->with($data);
    }

    // Proses restore post
    public function restored($id)
    {
        PostModel::withTrashed()->where('post_id', $id)->restore();
        notify()->success('Post Restored');
        return redirect()->route('post.index');
    }

    // Menghapus post secara permanen
    public function killed($id)
    {
        $post = PostModel::onlyTrashed()->where('post_id', $id)->first();
        File::delete('storage/images/posts/' . $post->featured);
        $post->tags()->detach();
        $post->forceDelete();
        notify()->success('Post Permanently Deleted');
        return redirect()->route('post.trashed');
    }

    // Menyimpan Post Sebagai Publish / UnPublished
    public function drafted($id)
    {
        // Default post yang terpublish -> publish == 1
        $post = PostModel::findOrFail($id);
        if ($post->publish == 1) {
            $post->publish = 0;
            $post->save();
            notify()->success('Post Drafted');
            // Post menjadi draft
        } else {
            $post->publish = 1;
            $post->save();
            notify()->success('Post Published');
            // Post menjadi publish
        }
        return redirect()->route('post.index');
    }
}
