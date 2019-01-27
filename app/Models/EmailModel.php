<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailModel extends Model
{
    protected $table = 'email';
    protected $fillable = ['email'];

    // Proses user subscribe
    public static function subs($request)
    {
        EmailModel::create([
            'email' => $request['subs']
        ]);
    }

    // Menampilkan semua subscriber
    public static function get_subs()
    {
        return EmailModel::all();
    }
}
