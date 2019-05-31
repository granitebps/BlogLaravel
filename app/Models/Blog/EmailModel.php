<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class EmailModel extends Model
{
    protected $table = 'email';
    protected $primaryKey = 'email_id';
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

    // Menghapus subscriber
    public static function delete_subs($id)
    {
        $subs = EmailModel::find($id);
        $subs->delete();
    }
}
