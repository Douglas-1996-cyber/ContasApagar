<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','situation_id','origin','value','due','ano','mes'];

    public function situation(){
        return $this->belongsTo('App\Models\Situation');
    }
    public function users(){
        return $this->belongsTo('App\Models\User');
    }

}
