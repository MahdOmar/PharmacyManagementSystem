<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
   
    Protected $dateFormat = 'Y-m-d';
    public function medicine()
    {
        return $this->belongsTo('App\Models\Medicine','Product_id','id');
    }
}
