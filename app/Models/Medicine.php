<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    public function sale()
    {
    return $this->hasMany('App\Models\Sale','Product_id','id');
    }

}
