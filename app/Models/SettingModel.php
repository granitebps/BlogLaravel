<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingModel extends Model
{
    protected $table = 'setting';
    protected $fillable = ['site_name', 'about'];

    // Untuk mengambil data setting
    public static function get_setting()
    {
        return SettingModel::first();
    }

    // Proses update setting
    public static function update_setting($request)
    {
        return self::get_setting()->update([
            'site_name' => $request['site_name'],
            'about' => $request['about']
        ]);
    }
}
