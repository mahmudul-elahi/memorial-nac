<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'name';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value'
    ];

    function getLogo()
    {
        return 'img/logo/' . $this::find('app_logo')->value;
    }

    function getCSS()
    {
        if (Setting::find('dir')->value == "rtl") {
            return "css/tabler.rtl.min.css";
        } else {
            return "css/tabler.min.css";
        }
    }
}
