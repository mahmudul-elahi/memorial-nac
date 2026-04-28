<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessMessage extends Model
{
    protected $table = 'success_messages';

    protected $fillable = ['key', 'message'];

    public static function getMessage($key)
    {
        return self::where('key', $key)->value('message');
    }
}
