<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'likeable_type', 
        'likeable_id', 
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'likeable_id')->whereHas('category', function($q) {
            $q->where('status', 1);
        });
    }

}