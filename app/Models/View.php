<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class View extends Model
{

    protected $table = 'views';

    protected $fillable = [
        'fingerprint', 
        'item_id', 
        'page_id', 
    ];

    /*
    * @fingerprint
    * @type = 'item_id', 'page_id'
    * @value = $id
    */
    public static function store($fingerprint, $type, $value)
    {
        return View::firstOrCreate([
            'fingerprint' => $fingerprint, 
            $type => $value       
            ],
        );
    }

}