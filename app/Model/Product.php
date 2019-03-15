<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ProductImage;
use App\Model\Category;
class Product extends Model
{
    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }
}
