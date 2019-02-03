<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    // Menampilkan Pesan
    public function index()
    {
        $data['message'] = MessageModel::get_message();
        return view('admin.message.index', $data);
    }

    // Menampilkan halaman untuk membalas pesan
    public function reply($id)
    {
        $data['message'] = MessageModel::get_message_id($id);
        return view('admin.message.reply', $data);
    }

    // Proses membalas pesan
    public function replied(Request $request, $id)
    {
        $pesan = MessageModel::get_message_id($id);
        $data = array(
            'msg' => $request->msg,
            'email' => $pesan->msg_email,
            'body' => $pesan->msg_body,
            'name' => $pesan->msg_name
        );

        Mail::send('admin.message.msg', $data, function ($mail) use ($data) {
            $mail->to($data['email'], $data['name'])
                ->subject('Replied Message');
            $mail->from('granitebagas28@gmail.com', 'Website MyMind');
        });

        if (Mail::failures()) {
            Session::flash('error', 'Email Gagal Dikirim');
        }
        Session::flash('success', 'Email Berhasil Dikirim');
        return redirect()->route('message.index');
    }

    // Membuat pesan Terbaca atau Belum Terbaca
    public function readed($id)
    {
        // Default post yang terbaca -> readed == 1
        if (MessageModel::readed($id)) {
            Session::flash('success', 'Message Mark As Readed');
        } else {
            Session::flash('success', 'Message Mark As UnRead');
        }
        return redirect()->route('message.index');
    }

    // Menghapus Pesan
    public function delete($id)
    {
        MessageModel::delete_msg($id);
        Session::flash('error', 'Message Deleted');
        return redirect()->route('message.index');
    }
}
