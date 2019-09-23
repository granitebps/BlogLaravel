<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class EmailModel extends Model
{
    protected $table = 'email';
    protected $primaryKey = 'email_id';
    protected $fillable = ['email'];
}
