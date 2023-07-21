<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model{
    use HasFactory;

    protected $fillable = ['id_user','id_product','qty','price','total','status'];

    public function product(){
        return $this->belongsTo('App\Models\Products', 'id_product');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
