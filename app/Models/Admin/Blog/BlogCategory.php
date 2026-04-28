<?php

namespace App\Models\Admin\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
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

    public function posts()
    {
        return $this->hasMany(Post::class, "category_id", "id");
    }


}
