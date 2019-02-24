<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'message';
    protected $guarded = ['created_at', 'updated_at'];
    protected $primaryKey = 'msg_id';

    // Menampilkan semua pesan
    public static function get_message()
    {
        return MessageModel::orderBy('created_at', 'desc')->paginate(10);
    }

    // Menampilkan semua pesan yang belum dibaca
    public static function get_message_unread()
    {
        return MessageModel::where('readed', 0)->get();
    }

    // Menampilkan pesan per id
    public static function get_message_id($id)
    {
        return MessageModel::find($id);
    }

    // Proses user mengirim pesan kepada admin
    public static function send_message($request)
    {
        MessageModel::create([
            'msg_name' => $request['name'],
            'msg_email' => $request['email'],
            'msg_body' => $request['message']
        ]);
    }

    // Membuat Message Readed / UnRead
    public static function readed($id)
    {
        // Default pesan yang belum terbaca -> readed == 0
        $msg = self::get_message_id($id);
        if ($msg->readed == 0) {
            $msg->readed = 1;
            $msg->save();
            return true;
            // Pesan menjadi Terbaca/Readed
        } else {
            $msg->readed = 0;
            $msg->save();
            return false;
            // Pesan menjadi Belum Terbaca/UnReaded
        }
    }

    // Menghapus Pesan
    public static function delete_msg($id)
    {
        $msg = self::get_message_id($id);
        $msg->delete();
    }
}
