<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    use HasFactory;

    public function debits(){
        return $this->hasMany('App\Models\Debits', 'situation_id', 'id');
    }
    public function bills(){
        return $this->hasMany('App\Models\Bill', 'situation_id', 'id');  
    }
}
