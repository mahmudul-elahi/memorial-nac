<?php

namespace App\Models\Admin\Blog;

use App\Models\User;
use App\Models\Image;
use App\Models\Admin\Blog\BlogComment;
use App\Models\Admin\Blog\BlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $guarded = [];

    function getThumbnail()
    {
        if ($this->thumbnail()->exists()) {
            return '/img/posts/' . $this->id . '/' . $this->thumbnail->filename;
        } else {
            return '/img/components/no_images.jpg';
        }
    }

    function getStatus()
    {
        if ($this->status) {
            return true;
        } else {
            return false;
        }
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thumbnail()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }
}
