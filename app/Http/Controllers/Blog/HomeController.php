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
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $post = PostModel::get_post_publish();
        $random = PostModel::get_post_random();
        $featured = PostModel::get_post_featured();
        return view('welcome', compact("tag", 'category', 'post', 'random', 'featured'));
    }

    // Menampilkan halaman per post
    public function show($slug)
    {
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $post = PostModel::get_post_slug($slug);
        $random = PostModel::get_post_random();

        $next_post_temp = PostModel::where('post_id', '>', $post->post_id)->min('post_id');
        $next_post = PostModel::get_post_id($next_post_temp);
        $prev_post_temp = PostModel::where('post_id', '<', $post->post_id)->max('post_id');
        $prev_post = PostModel::get_post_id($prev_post_temp);
        return view('show', compact(['tag', 'category', 'post', 'random', 'next_post', 'prev_post']));
    }

    // Menampilkan halaman per category
    public function category($slug)
    {
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $category_name = CategoryModel::get_category_slug($slug);
        $post = $category_name->post()->paginate(10);
        $random = PostModel::get_post_random();
        return view('category', compact(['tag', 'category', 'category_name', 'post', 'random']));
    }

    // Menampilkan halaman per tag
    public function tag($slug)
    {
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $tag_name = TagModel::get_tag_slug($slug);
        $post = $tag_name->post()->paginate(10);
        $random = PostModel::get_post_random();
        return view('tag', compact(['tag', 'category', 'tag_name', 'post', 'random']));
    }

    // Menampilkan halaman hasil search
    public function search(Request $request)
    {
        $request = $request->all();
        $post = PostModel::search($request);
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $random = PostModel::get_post_random();
        return view('search', compact(['post', 'tag', 'category', 'random']));
    }

    // Menampilkan halaman about
    public function about()
    {
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $random = PostModel::get_post_random();
        return view('about', compact(['tag', 'category', 'random']));
    }

    // Menampilkan halaman contact
    public function contact()
    {
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $random = PostModel::get_post_random();
        $profile = User::first();
        return view('contact', compact(['tag', 'category', 'random', 'profile']));
    }

    // Proses user mengirim pesan kepada admin
    public function contact_email(Request $request)
    {
        $request = $request->all();
        MessageModel::send_message($request);
        Session::flash('success', 'Pesan Telah Terkirim');
        return redirect()->route('home.contact');
    }

    // Proses user untuk subcribe
    public function subs(Request $request)
    {
        EmailModel::create([
            'email' => $request->subs
        ]);
        Session::flash('success', 'Anda Sudah Subscibe!!!');
        return redirect()->back();
    }

    // Menampilkan halaman portfolio
    public function portfolio()
    {
        $portfolio = PortfolioModel::get_portfolio();
        $tag = TagModel::get_random_tag();
        $category = CategoryModel::get_category();
        $random = PostModel::get_post_random();
        return view('portfolio', compact(['portfolio', 'tag', 'category', 'random']));
    }
}
