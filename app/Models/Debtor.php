<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'user_id'];
    protected $table = 'debtor';



public function debits(){
    return $this->hasMany('App\Models\Debits', 'debtor_id', 'id');
}

}