<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserActivity extends Model
{
   protected $fillabe = [
  
      'entity_type','entity_id', 'old_value','modified_value','modify_by','column_name',
        
   ];
   
   public function entity()
   {
       return $this->morphTo();
   }
   public function modifiedBy()
   {
       return $this->belongsTo(User::class, 'modified_by');
   }

}
