<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Models\Blog\PostModel;
use App\Models\Blog\CategoryModel;
use App\Models\Blog\TagModel;
use App\Models\Blog\ProfileModel;
use App\Models\Blog\MessageModel;
use App\Models\Blog\EmailModel;
use App\Models\Blog\PortfolioModel;
use App\Http\Controllers\Controller;
use App\Models\Blog\User;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Menampilkan halaman dashboard admin
    public function index()
    {
        $data['post'] = PostModel::orderBy('post_title', 'desc')->get();
        $data['message'] = MessageModel::where('readed', 0)->get();
        $data['subs'] = EmailModel::all();
        $data['title'] = 'Dashboard';
        return view('admin.home')->with($data);
    }

    // Menampilkan halaman utama
    public function welcome()
    {
        $tag = TagModel::inRandomOrder()->take(5)->get();
        $category = CategoryModel::all();
        $post = PostModel::where('publish', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $random = PostModel::inRandomOrder()->take(6)->get();
        $featured = PostModel::inRandomOrder()->get();
        return view('welcome', compact("tag", 'category', 'post', 'random', 'featured'));
    }

    // Menampilkan halaman per post
    public function show($slug)
    {
        $tag = TagModel::inRandomOrder()->take(5)->get();
        $category = CategoryModel::all();
        $post = PostModel::where('post_slug', $slug)->first();
        $random = PostModel::inRandomOrder()->take(6)->get();

        $next_post_temp = PostModel::where('post_id', '>', $post->post_id)->min('post_id');
        $next_post = PostModel::find($next_post_temp);
        $prev_post_temp = PostModel::where('post_id', '<', $post->post_id)->max('post_id');
        $prev_post = PostModel::find($prev_post_temp);
        return view('show', compact(['tag', 'category', 'post', 'random', 'next_post', 'prev_post']));
    }

    // Menampilkan halaman per category
    public function category($slug)
    {
        $tag = TagModel::inRandomOrder()->take(5)->get();
        $category = CategoryModel::all();
        $category_name = CategoryModel::where('category_slug', $slug)->first();
        $post = $category_name->post()->paginate(10);
        $random = PostModel::inRandomOrder()->take(6)->get();
        return view('category', compact(['tag', 'category', 'category_name', 'post', 'random']));
    }

    // Menampilkan halaman per tag
    public function tag($slug)
    {
        $tag = TagModel::inRandomOrder()->take(5)->get();
        $category = CategoryModel::all();
        $tag_name = TagModel::where('tag_slug', $slug)->first();
        $post = $tag_name->post()->paginate(10);
        $random = PostModel::inRandomOrder()->take(6)->get();
        return view('tag', compact(['tag', 'category', 'tag_name', 'post', 'random']));
    }

    // Menampilkan halaman hasil search
    public function search(Request $request)
    {
        $post = PostModel::where('post_title', 'like', "%$request->search%")->paginate(10);
        $tag = TagModel::inRandomOrder()->take(5)->get();
        $category = CategoryModel::all();
        $random = PostModel::inRandomOrder()->take(6)->get();
        return view('search', compact(['post', 'tag', 'category', 'random']));
    }

    // Menampilkan halaman about
    public function about()
    {
        $tag = TagModel::inRandomOrder()->take(5)->get();
        $category = CategoryModel::all();
        $random = PostModel::inRandomOrder()->take(6)->get();
        $profile = User::first();
        return view('about', compact(['tag', 'category', 'random', 'profile']));
    }

    // Menampilkan halaman contact
    public function contact()
    {
        $tag = TagModel::inRandomOrder()->take(5)->get();
        $category = CategoryModel::all();
        $random = PostModel::inRandomOrder()->take(6)->get();
        $profile = User::first();
        return view('contact', compact(['tag', 'category', 'random', 'profile']));
    }

    // Proses user mengirim pesan kepada admin
    public function contact_email(Request $request)
    {
        MessageModel::create([
            'msg_name' => $request->name,
            'msg_email' => $request->email,
            'msg_body' => $request->message,
        ]);
        notify()->success('Pesan Telah Terkirim');
        return redirect()->route('home.contact');
    }

    // Proses user untuk subcribe
    public function subs(Request $request)
    {
        EmailModel::create([
            'email' => $request->subs
        ]);
        notify()->success('Anda Sudah Subscribe');
        return redirect()->back();
    }
}
