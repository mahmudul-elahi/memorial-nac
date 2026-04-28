<?php
            
namespace App\Models;
            
use Illuminate\Database\Eloquent\Model;
            
class Detail extends Model
{

   /**
   * The table associated with the model.
   *
   * @var string
   */
   protected $table = 'details';

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
   protected $fillable = [
      'sex',
      'birth_date', 
      'death_date',
      'funeral_date',
      'funeral_place',
      'item_id'
   ];

}