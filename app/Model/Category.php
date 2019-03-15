<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Brand;
class Category extends Model
{
	public function parentName($id){

		if($id != null){
			$categoryParent =  Category::where('id',$id)->firstOrFail();
			return $categoryParent->name;
		}
		else{
			return "";
		}
	}
	public function parendId($id){

		if($id != null){
			$categoryParent =  Category::where('id',$id)->firstOrFail();
			return $categoryParent;
		}
		else{
			return "";
		}
	}

	public function childName($id){
		$childCategory =  Category::where('parent_id',$id)->get();
		if($childCategory != null){
			return $childCategory;
		}else{
			return "";
		}
	}

	public function parentName2(){
		$parentName = Category::where('parent_id',null);
		return $parentName;
	}

	public function checkParent($parent_id){
		if($parent_id == null)
		return $parent_id;
		else return false;
	}

	public function getChild($parent_id){
		return Category::where('parent_id',$parent_id)->get();
	}

	public function brands(){
		return $this->hasMany(Brand::class);
	}
}
