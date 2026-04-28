<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    // Specify the fields that can be mass assigned
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];
}
