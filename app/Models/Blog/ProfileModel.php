<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Blog\User;
use Illuminate\Support\Facades\Hash;

class ProfileModel extends Model
{
    protected $table = 'profile';
    protected $guarded = ['created_at', 'deleted_at'];

    // Relasi One to One dengan User
    public function user()
    {
        return $this->belongsTo('App\Models\Blog\User');
    }
}
