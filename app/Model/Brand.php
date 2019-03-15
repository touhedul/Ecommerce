<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Category;
class Brand extends Model
{
    public function category(){
    	return $this->belongsTo(Category::class);
    }
}
