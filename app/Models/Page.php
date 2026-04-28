<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    protected $table = 'pages';

    protected $fillable = [
        'title', 
        'description',
        'content',
        'slug',
        'status'
    ];

    function getStatus()
    {
        if ($this->status == 1) {
            return true;
        } else {
            return false;
        }
    }

}