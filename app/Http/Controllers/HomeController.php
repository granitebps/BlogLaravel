<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\CategoryModel;
use App\Models\TagModel;
use App\Models\ProfileModel;
use App\Models\MessageModel;
use App\Models\EmailModel;
use Illuminate\Support\Facades\Session;
use App\Models\PortfolioModel;

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
        $data['post'] = PostModel::get_post();
        $data['message'] = MessageModel::get_message_unread();
        $data['subs'] = EmailModel::get_subs();
        return view('admin.home', $data);
    }

    // Menampilkan halaman utama
    public function welcome()
    {
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $data['post'] = PostModel::get_post_publish();
        $data['random'] = PostModel::get_post_random();
        $data['featured'] = PostModel::get_post_featured();
        return view('welcome', $data);
    }

    // Menampilkan halaman per post
    public function show($slug)
    {
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $data['post'] = PostModel::get_post_slug($slug);
        $data['random'] = PostModel::get_post_random();

        $post = $data['post'];
        $next_post = PostModel::where('post_id', '>', $post->post_id)->min('post_id');
        $data['next_post'] = PostModel::get_post_id($next_post);
        $prev_post = PostModel::where('post_id', '<', $post->post_id)->max('post_id');
        $data['prev_post'] = PostModel::get_post_id($prev_post);
        return view('show', $data);
    }

    // Menampilkan halaman per category
    public function category($slug)
    {
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $category = CategoryModel::get_category_slug($slug);
        $data['post'] = $category->post()->paginate(10);
        $data['random'] = PostModel::get_post_random();
        return view('category', $data)->with('category_name', $category);
    }

    // Menampilkan halaman per tag
    public function tag($slug)
    {
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $tag = TagModel::get_tag_slug($slug);
        $data['post'] = $tag->post()->paginate(10);
        $data['random'] = PostModel::get_post_random();
        return view('tag', $data)->with('tag_name', $tag);
    }

    // Menampilkan halaman hasil search
    public function search(Request $request)
    {
        $request = $request->all();
        $data['post'] = PostModel::search($request);
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $data['random'] = PostModel::get_post_random();
        return view('search', $data);
    }

    // Menampilkan halaman about
    public function about()
    {
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $data['random'] = PostModel::get_post_random();
        return view('about', $data);
    }

    // Menampilkan halaman contact
    public function contact()
    {
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $data['random'] = PostModel::get_post_random();
        $data['profile'] = ProfileModel::get_profile();
        return view('contact', $data);
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
        $request = $request->all();
        EmailModel::subs($request);
        Session::flash('success', 'Anda Sudah Subscibe!!!');
        return redirect()->back();
    }

    // Menampilkan halaman portfolio
    public function portfolio()
    {
        $data['portfolio'] = PortfolioModel::get_portfolio();
        $data['tag'] = TagModel::get_tag();
        $data['category'] = CategoryModel::get_category();
        $data['random'] = PostModel::get_post_random();
        return view('portfolio', $data);
    }
}
