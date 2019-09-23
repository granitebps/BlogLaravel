<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'message';
    protected $guarded = ['created_at', 'updated_at'];
    protected $primaryKey = 'msg_id';
}
