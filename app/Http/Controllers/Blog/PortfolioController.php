<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\PortfolioModel;
use Illuminate\Support\Facades\Session;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = PortfolioModel::get_portfolio();
        return view('admin.portfolio.index', compact('portfolio'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'portfolio_name' => 'required',
            'portfolio_desc' => 'required',
            'portfolio_url' => 'required',
            'portfolio_image' => 'required',
            'portfolio_image.*' => 'image|max:2048',
        ]);
        $request = $request->all();
        PortfolioModel::create_portfolio($request);

        Session::flash('success', 'Portfolio Created');
        return redirect()->route('portfolio.index');
    }

    public function edit($id)
    {
        $portfolio = PortfolioModel::get_portfolio_id($id);
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'portfolio_name' => 'required',
            'portfolio_desc' => 'required',
            'portfolio_url' => 'required',
            'portfolio_image' => 'image|max:2048'
        ]);
        if ($request->hasFile('portfolio_image')) {
            $image = $request->portfolio_image;
            $image_name = time() . $image->getClientOriginalName();
            $image->move('storage/images/portfolio', $image_name);
            // $image->storeAs('public/images/portfolio', $image_name);
            PortfolioModel::update_image($image_name, $id);
        }
        $request = $request->all();
        PortfolioModel::update_portfolio($request, $id);
        Session::flash('success', 'Portfolio Updated');
        return redirect()->route('portfolio.index');
    }

    public function destroy($id)
    {
        PortfolioModel::delete_portfolio($id);
        Session::flash('error', 'Portfolio Deleted');
        return redirect()->route('portfolio.index');
    }

    public function preview(Request $request)
    {
        // <a target="_blank" href="{{asset('storage/images/portfolio/'.$folder.'/'.$item)}}"><img src="{{asset('storage/images/portfolio/'.$folder.'/'.$item)}}" alt=""></a>
        $portfolio = PortfolioModel::get_portfolio_id($request->id);
        $image = explode(',', $portfolio->portfolio_image);
        $folder = str_replace(' ', '_', strtolower($portfolio->portfolio_name));
        $output = '
        <div id="tes-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        ';

        foreach ($image as $index => $file) {
            $path = asset('storage/images/portfolio/' . $folder . '/' . $file);
            $output .= '
                <div class="item active">
                    <a target="_blank" href="' . $path . '"><img src="' . $path . '" alt=""></a><br>
                </div>
            ';
        }

        $output .= '
        </div>
        </div>
        ';
        echo $output;
    }
}
