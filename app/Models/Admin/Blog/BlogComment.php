<?php

namespace App\Models\Admin\Blog;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    function getStatus()
    {
        if ($this->status == 1) {
            return true;
        } else {
            return false;
        }
    }

    function isMyComment()
    {
        if (Auth::id() == $this->commented_by) {
            return true;
        } else {
            return false;
        }
    }

    public function commentedBy()
    {
        return $this->belongsTo(User::class, "commented_by", "id");
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
