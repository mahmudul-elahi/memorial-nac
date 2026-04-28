<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    protected $guarded = [];

    public function subcategory(){

        return $this->hasMany(Category::class, 'parent_id');

    }

    function getStatus()
    {
        if ($this->status == 1) {
            return true;
        } else {
            return false;
        }
    }

}