<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    protected $table = 'products';
//protected $fillable = ['name', 'slug', 'price']; // Veritabanı işlemlerini İzin verilen stun adlari
protected $guarded = []; //'veritabanı işlemlerinin yapılmasını istemediğimiz stun adları'
}
