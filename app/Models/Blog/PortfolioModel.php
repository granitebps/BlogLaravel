<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class PortfolioModel extends Model
{
    protected $table = 'portfolio';
    protected $primaryKey = 'portfolio_id';
    protected $guarded = ['created_at', 'updated_at'];

    public static function get_portfolio()
    {
        return PortfolioModel::all();
    }

    public static function create_portfolio($request)
    {
        $portfolio_name = $request['portfolio_name'];
        $portfolio_desc = $request['portfolio_desc'];
        $portfolio_url = $request['portfolio_url'];
        $image = $request['portfolio_image'];
        $image_name = time() . $image->getClientOriginalName();
        $image->move('images/portfolio', $image_name);
        PortfolioModel::create([
            'portfolio_name' => $portfolio_name,
            'portfolio_desc' => $portfolio_desc,
            'portfolio_url' => $portfolio_url,
            'portfolio_image' => 'images/portfolio/' . $image_name,
        ]);
    }

    public static function get_portfolio_id($id)
    {
        return PortfolioModel::find($id);
    }

    public static function update_image($image_name, $id)
    {
        $portfolio = self::get_portfolio_id($id);
        $portfolio->portfolio_image = 'images/portfolio/' . $image_name;
        $portfolio->save();
    }

    public static function update_portfolio($request, $id)
    {
        $portfolio = self::get_portfolio_id($id);
        $portfolio->update([
            'portfolio_name' => $request['portfolio_name'],
            'portfolio_desc' => $request['portfolio_desc'],
            'portfolio_url' => $request['portfolio_url'],
        ]);
    }

    public static function delete_portfolio($id)
    {
        $portfolio = PortfolioModel::find($id);
        File::delete($portfolio->portfolio_image);
        $portfolio->delete();
    }
}
