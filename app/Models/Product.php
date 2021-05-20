<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\Models\ProductAttribute', 'product_id');
    }

    public function attributesImages()
    {
        return $this->hasMany('App\Models\ProductAttributeImage', 'product_id');
    }
}
