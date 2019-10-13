<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\MessageModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    // Menampilkan Pesan
    public function index()
    {
        $data['title'] = 'Message UnRead';
        $data['message'] = MessageModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.message.index')->with($data);
    }

    // Menampilkan halaman untuk membalas pesan
    public function reply($id)
    {
        $data['title'] = 'Reply Message';
        $data['message'] = MessageModel::findOrFail($id);
        return view('admin.message.reply')->with($data);
    }

    // Proses membalas pesan
    public function replied(Request $request, $id)
    {
        $pesan = MessageModel::findOrFail($id);
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
        // Default pesan yang belum terbaca -> readed == 0
        $msg = MessageModel::findOrFail($id);
        if ($msg->readed == 0) {
            $msg->readed = 1;
            $msg->save();

            notify()->success('Message Mark As Readed');
            // Pesan menjadi Terbaca/Readed
        } else {
            $msg->readed = 0;
            $msg->save();

            notify()->success('Message Mark As UnRead');
            // Pesan menjadi Belum Terbaca/UnReaded
        }
        return redirect()->route('message.index');
    }

    // Menghapus Pesan
    public function delete($id)
    {
        $msg = MessageModel::findOrFail($id);
        $msg->delete();

        notify()->success('Message Deleted');
        return redirect()->route('message.index');
    }
}
