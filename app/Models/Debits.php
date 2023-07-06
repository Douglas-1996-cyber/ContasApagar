<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debits extends Model
{
    protected $fillable = ['debtor_id','situation_id','value', 'due'];
    use HasFactory;

    public function debtor(){
        return $this->belongsTo('App\Models\Debtor');
    }

    public function situation(){
        return $this->belongsTo('App\Models\Situation');
    }
}
