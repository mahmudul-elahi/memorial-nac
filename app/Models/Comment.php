<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{

    protected $table = 'comments';

    protected $fillable = [
        'content', 
        'user_id', 
        'item_id', 
        'status'
    ];

    function scopeIsMyComment()
    {
        if (Auth::id() == $this->user_id) {
            return true;
        } else {
            return false;
        }
    }

    function getStatus()
    {
        if ($this->status == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function itemsFilter()
    {
        return $this->belongsTo(Item::class, 'item_id')->whereHas('category', function($q) {
            $q->where('status', 1);
        });
    }

}