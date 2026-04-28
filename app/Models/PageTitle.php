<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageTitle extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'page_titles';

    // Specify the fillable properties
    protected $fillable = [
        'page_identifier',
        'title',
        'subtitle',
    ];

    // Optionally, you can define timestamps if you want to manage created_at and updated_at manually
    public $timestamps = true; // This is true by default
}
